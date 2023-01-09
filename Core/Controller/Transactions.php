<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Transaction;


class transactions extends Controller
{
    function __construct()
    {
        $this->auth();
        $_SESSION["SECTION"] = 'transactions';

    }

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    /**
     * Gets all Transactions
     *
     * @return void
     */
    public function index()
    {
        $this->permissions(['transaction:read', 'transaction:super']);
        $this->view = 'transactions.index';
        $transaction = new transaction; // new model transaction.
        $this->data['transactions'] = $transaction->order_by("created_at");
        $this->data['transactions_count'] = count($this->data['transactions']);
    }


    /**
     * Display the HTML form for transaction edit
     *
     * @return void
     */
    public function edit()
    {

        $this->permissions(['transaction:read', 'transaction:update']);
        $this->view = 'transactions.edit';
        $transaction = new transaction();
        $isInt = Helper::isValidInteger($_GET['id']);
        if (!$isInt) {
            Helper::redirect('404');
        }

        $this->data['transaction'] = $transaction->get_by_id($_GET['id']);
    }


    /**
     * redirect to edit transaction with the id .
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['transaction:read', 'transaction:update']);
        $transaction = new transaction();
        $old_quantity = $transaction->get_by_id($_POST['id'])->quantity;

        $base_price = $_POST['total'] / $old_quantity; // reverse calculation

        $_POST['total'] = $_POST['quantity'] * $base_price;

        $transaction->update($_POST);
        $_SESSION["message-success"] = "You have successfully saved your data";
        Helper::redirect('/edit-transaction?id=' . $_POST['id']);
    }


    /**
     * Delete the transaction
     * then redirect to the transactions page .
     * @return void
     */
    public function delete()
    {
        $this->permissions(['transaction:read', 'transaction:delete']);
        $transaction = new transaction();
        $transaction->delete($_POST['id']);
        $_SESSION["message-success"] = "You have successfully delete the transaction";

        if ($_SESSION['user']['role']=='Seller') {
            Helper::redirect('/cart');
            exit();
        }
        Helper::redirect('/transactions');
    }

}