<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Cart;
use Core\Model\Product;
use Core\Model\Transaction;
use Core\Model\User;


class SellingDashboard extends Controller
{

    function __construct()
    {
        $this->auth();
        $_SESSION['SECTION'] = 'selling-dashboard';
    }

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    /**
     * @return void
     * display the selling dashboard (HTML).
     */
    public function getDashboard()
    {
        $this->view = 'sellingDashboard';
        $product = new product;
        $this->data['products'] = $product->get_all();
    }


    /**
     * @return void
     * Display the cart (HTML).
     * filter by the user_id with the transaction_id .
     *  Count the carts.
     *  get daily transactions.
     */
   public function cart()
    {
        $this->view = 'cart';

        $cart= new Cart;
        $this->data['shopping_cart'] = $cart->filter("seller_id", $_SESSION['user']['user_id']);
        $_SESSION['cart_count'] = count($this->data['shopping_cart']);
        $transaction= new Transaction();
        $this->data['daily_transactions'] = $transaction->get_daily_transactions();

    }


}