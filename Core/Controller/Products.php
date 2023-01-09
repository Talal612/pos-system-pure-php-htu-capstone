<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Product;


class products extends Controller
{
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->auth();
        $_SESSION["SECTION"] = 'products';

    }


    /**
     * Gets all the products.
     * Count all the products.
     * @return void
     *
     */
    public function index()
    {
        $this->permissions(['product:read']);
        $this->view = 'products.index';
        $product = new product; // new model product.
        $this->data['products'] = $product->get_all();
        $this->data['products_count'] = count($this->data['products']);
    }


    /**
     * Display the HTML form for Product Creation.
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['product:create']);
        $this->view = 'products.create';
    }






    /**
     * Create new Product .
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['product:create']);
        $product = new product();
        $filename = $_FILES["image"]["name"];
        if (!empty($filename)) {
            $tempname = $_FILES["image"]["tmp_name"];

            $folder = "././resources/images/product-images/" . $filename;

            $_POST['image'] = $folder;

            move_uploaded_file($tempname, $folder);
        }
        $product->create($_POST);
        Helper::redirect('/products');
    }






    /**
     * Display the HTML form for product edit
     *
     * @return void
     */
    public function edit()
    {
        $this->permissions(['product:read', 'product:update']);
        $this->view = 'products.edit';
        $product = new product();
        $isInt = Helper::isValidInteger($_GET['id']);
        if (!$isInt)
        {
            Helper::redirect('404');
        }

        $this->data['product'] = $product->get_by_id($_GET['id']);

    }





    /**
     * Updates the product
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['product:read', 'product:update']);
        $product = new Product();

        $filename = $_FILES["image"]["name"];
        if (!empty($filename)) {
            $tempname = $_FILES["image"]["tmp_name"];

            $folder = "././resources/images/product-images/" . $filename;

            $_POST['image'] = $folder;

            move_uploaded_file($tempname, $folder);
        }

        $product->update($_POST);
        $_SESSION["message-success"] = "You have successfully saved your data";
        Helper::redirect('/edit-product?id=' . $_POST['id']);
    }




    /**
     * Delete the product
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['product:read', 'product:update']);
        $product = new Product();
        $product->delete($_POST['id']);
        Helper::redirect('/products');
    }
}