<?php

namespace Core\Base; // namespace-> hierarchically labeled code block holding

use Core\Helpers\Helper; // alias to a Helper  .
use Core\Model\User; // alias to a User Model .

abstract class Controller
{

    protected $view = null;
    protected $data = array();


    /**
     * Abstract method to force the programmer to declare the render method when inheriting from this class.
     */
    abstract public function render();




    /**
     * to view(display) the requested page.
     * @return void void does not return anything.
     */
    protected function view() :void
    {
        new View($this->view, $this->data);
        $_SESSION['message-success'] = ""; // Unset message after displaying it.
        $_SESSION['message-error'] = ""; // Unset message after displaying it.
    }




    /**
     * Check if the user has the assigned permissions.
     *  1) collect the user permissions from the DataBase.
     *  2) Get permissions from session
     *  4)  check if the user has all the permissions_set
     *  3) check  if any of the permission sets are not assigned to the user, redirect to the dashboard .
     * @param array $permissions_set
     * @return void  does not return anything.
     */
    protected function permissions(array $permissions_set) : void
    {
        $this->auth();
        $assigned_permissions = $_SESSION['user']['permissions'];
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
                Helper::redirect('/user_account');
            }
        }
    }

    /**
     *  Check the SESSION user if not exist to redirect the user to the login page.
     *  Protected method , can only be call (used) by this class and  any classes that derive from it .
     * @return void  does not return anything. does not return anything.
     */
    protected function auth() : void
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/');
        }
    }


}