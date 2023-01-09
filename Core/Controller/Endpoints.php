<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Product;
use Core\Model\Transaction;
use Core\Model\Cart;
use Core\Helpers\Tests;
use Core\Model\user_transaction;
use Exception;

class Endpoints extends Controller
{
    use Tests;

    protected $request_body;
    protected $http_code = 200;

    protected $response_schema = array(
        "success" => true, // to provide the response status.
        "message_code" => "", // to provide message code for the front-end developer for a better error handling
        "body" => []
    );


    function __construct()
    {
        $this->request_body = (array) json_decode(file_get_contents("php://input")); // php://input is a read-only stream that allows you to read raw data from the request body.
    }


    /**
     * @return void
     */
    public function render()
    {
        header("Content-Type: application/json"); // changes the header information
        http_response_code($this->http_code); // set the HTTP Code for the response
        echo json_encode($this->response_schema); // convert the data to json format
    }

    /**
     * @return void
     *
     */
    function sell()
    {
        try {
            $product = new Product;

            $cart = new Cart;

            $available = $product->check_available_stock($this->request_body["item_id"], $this->request_body['quantity']);

            if (!($available))
            {
                throw new \Exception('Product not available');
            }

            $product->update_quantity($this->request_body["item_id"], $this->request_body['quantity']);

            $transaction = new Transaction;

            $cart->delete($this->request_body["cart_id"]);

            unset($this->request_body['cart_id']);
            $transaction->create($this->request_body);

            $this->response_schema['body'] = $transaction->get_latest_transaction();

            $user_transaction_info = array(
                'user_id' => $_SESSION['user']['user_id'],
                'transaction_id' => $this->response_schema['body']->id,
            );

            $user_transaction = new user_transaction;
            $user_transaction->create($user_transaction_info);

            $this->response_schema['message_code'] = "success";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 400;
        }
    }




    function add_to_cart()
    {
        try {
            $product = new Product;
            $cart = new Cart;
            $cart_item = $cart->get_cart_item($this->request_body['item_id'], $_SESSION['user']['user_id']);

            if ($this->request_body["item_quantity"] <= 0) {
                throw new \Exception('Quantity must be greater than 0');
            }

            if (!($cart_item)) { // add the cart for first time.

                $available = $product->check_available_stock($this->request_body["item_id"], $this->request_body["item_quantity"]);

                if (!($available)) {
                    throw new \Exception('Product not avaliable');
                }
                $this->request_body['seller_id'] = $_SESSION['user']['user_id'];
                $cart->create($this->request_body);
            } else {
                $quantity = $cart_item->item_quantity;
                $new_quantity = $quantity + $this->request_body['item_quantity'];

                $available = $product->check_available_stock($this->request_body["item_id"], $new_quantity);

                if (!($available)) {
                    throw new \Exception('Product not avaliable');
                }

                $this->request_body['id'] = $cart_item->id;
                $this->request_body['seller_id'] = $_SESSION['user']['user_id'];
                $this->request_body['item_quantity'] = $new_quantity;
                $cart->update($this->request_body);
                $this->response_schema['body'] = $cart->get_all();
                $this->response_schema['message_code'] = "success";
            }

        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 400;
        }
    }
}
