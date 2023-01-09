<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Authentication extends Controller
{
    private $user = null;


    /**
     * Authentication
     */
    function __construct()
    {
        if (isset($_SESSION['user'])) {
            Helper::redirect('/dashboard');
        }
    }


    /**
     * redirect to the specific view if not empty.
     * @return void
     *
     */
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }


    /**
     * Displays login form
     *
     * @return void
     */
    public function login()
    {
        $this->view = 'login';
    }


    /**
     * Login Validation
     * // if user doesn't exist, do not authenticate and redirect to the login page.
     *
     * @return void
     */
    public function validate()
    {

        $user = new User();
        $logged_in_user = $user->get_by_username($_POST['username']);

        if (!$logged_in_user) {
            $this->invalid_redirect();
        }

        if (!\password_verify($_POST['password'], $logged_in_user->password)) {
            $this->invalid_redirect();
        }

        if (isset($_POST['remember_me'])) {
            // DO NOT ADD USER ID TO THE COOKIES - SECURITY BREACH!!!!!
            \setcookie('user_id', $logged_in_user->id, time() + (86400 * 30)); // 86400 = 1 day (60*60*24)
        }


        $permissions = \unserialize($logged_in_user->permissions);
        switch ($permissions) {
            case User::ADMIN:
                $role = 'Admin';
                break;

            case User::SELLER:
                $role = 'Seller';
                break;
            case User::PROCURMENT:
                $role = 'Procurement';
                break;
            case User::ACCOUNTANT:
                $role = 'Accountant';
                break;
            default:
                $role = 'Undefined';
        };
        $_SESSION['user'] = array(
            'username' => $logged_in_user->username,
            'display_name' => $logged_in_user->display_name,
            'image' => $logged_in_user->image,
            'user_id' => $logged_in_user->id,
            'permissions' => $permissions,
            'role' => $role,
            'gender' => $logged_in_user->gender
        );


        Helper::redirect('/dashboard');
    }


    /**
     * to redirect to login page. with error message.
     * @return void
     */
    private function invalid_redirect()
    {
        $_SESSION['error'] = "Invalid Username or Password";
        Helper::redirect('/');
        exit();
    }


}