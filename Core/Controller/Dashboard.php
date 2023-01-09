<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Product;
use Core\Model\Transaction;
use Core\Model\User;


class Dashboard extends Controller
{

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->auth();
        $_SESSION["SECTION"] = 'home';

    }


    /**
     * Include the dashboard template .
     * Create new user model .
     * Create new  product model .
     * Create new Transaction model .
     * @return void
     *
     */
    public function getDashboard()
    {
        $this->permissions(['product:read', 'transaction:read']);
        $this->view = 'dashboard';

        $user = new User;
        $this->data['users'] = $user->get_all();
        $this->data['users_count'] = count($this->data['users']);

        $product = new Product;
        $this->data['products'] = $product->order_by('price', 5);
        $this->data['products_count'] =  $product->count();

        $transaction = new Transaction;
        $this->data['transactions_count'] = $transaction->count();
        $this->data['sales'] = $transaction->get_total_sales();
    }
}