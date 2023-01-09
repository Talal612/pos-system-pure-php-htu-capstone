<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Users extends Controller
{
    function __construct()
    {
        $this->auth();
        $_SESSION["SECTION"] = 'users';
    }

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    /**
     * Gets all users
     *
     * @return void
     */
    public function index()
    {
        $this->permissions(['user:read']);
        $this->view = 'users.index';
        $user = new User; // new model user.
        $this->data['users'] = $user->get_users_with_role();
        $this->data['users_count'] = count($this->data['users']);
    }

    /**
     * Store (Create) new User
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['user:create']);
        $user = new User();
        $usernameUsed = $user->get_by_username($_POST['username']);
        if ($usernameUsed) {
            $_SESSION["message-error"] = "Username is used ! (" . $_POST['username'] . ")";
            Helper::redirect('/create-user');

        }
        $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);

        $filename = $_FILES["image"]["name"];

        if (!empty($filename)) {
            $tempname = $_FILES["image"]["tmp_name"];

            $folder = "././resources/images/users-images/" . $filename;

            $_POST['image'] = $folder;

            move_uploaded_file($tempname, $folder);
        }
        $permissions = null;
        switch ($_POST['role']) {
            case 'admin':
                $permissions = User::ADMIN;
                break;
            case 'seller':
                $permissions = User::SELLER;
                break;
            case 'procurement':
                $permissions = User::PROCURMENT;
                break;
            case 'accountant':
                $permissions = User::ACCOUNTANT;
                break;
        }
        unset($_POST['role']);
        $_POST['permissions'] = serialize($permissions);
        $user->create($_POST);
        $_SESSION["message-success"] = "You have successfully create new user";
        Helper::redirect('/users');
    }

    /**
     * Display the HTML form for User creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['user:create']);
        $this->view = 'users.create';
    }

    /**
     * Edit  User Info.
     *
     * @return void
     */
    public function edit()
    {

        $isInt = Helper::isValidInteger($_GET['id']);
        if (!$isInt) {
            Helper::redirect('404');
        }


        $this->permissions(['user:read', 'user:update']);
        $this->view = 'users.edit';

        $user = new User();

        $this->data['user'] = $user->get_by_id($_GET['id']);
        $permissions = $user->get_permissions($_GET['id']);


        // process role
        $role = null;
        switch ($permissions) {
            case User::ADMIN:
                $role = "Admin";
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
        }
        $this->data['role'] = $role;
    }


    /**
     * @return void
     * to view the user Profile page
     */
    public function userProfile()
    {

        $this->view = 'users.userProfile';
        $user = new User();

        $this->data['user'] = $user->get_by_id($_SESSION['user']['user_id']);
        $permissions = $user->get_permissions();
        // process role
        $role = null;
        switch ($permissions) {
            case User::ADMIN:
                $role = "Admin";
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
        }
        $this->data['role'] = $role;
    }

    /**
     * Delete the User
     * then redirect to the users page .
     * @return void
     */
    public function delete()
    {
        $this->permissions(['user:read', 'user:delete']);
        $user = new User();
        $user->delete($_POST['id']);
        $_SESSION["message-success"] = "You have successfully delete the user";
        Helper::redirect('/users');
    }


    /**
     * Change the password template .
     *
     * @return void
     */
    public function changePassword()
    {
        $this->view = 'users.changePassword';
    }

    /**
     * Updates the User info .
     *
     * @return void
     */
    public function setPassword()
    {

        $user = new User();
        $logged_user = $user->get_by_id($_POST['id']);

        if (!\password_verify($_POST['old_password'], $logged_user->password)) {
            $_SESSION["message-error"] = "Old password is wrong !"; // push notifications.
            Helper::redirect('/changePassword?id=' . $_POST['id']);
            exit();

        }
        if (!($_POST["new_password"] == $_POST["confirm_password"])) {
            $_SESSION["message-error"] = "Password and confirm password does not match !"; // push notifications.
            Helper::redirect('/changePassword');
            exit();
        }
        $post_info = [
            "id" => $_POST['id'],
            "password" => \password_hash($_POST["new_password"], \PASSWORD_DEFAULT)
        ];

        $user->update($post_info);
        $_SESSION["message-success"] = "You have Updated  your password";
        Helper::redirect('/edit-user?id=' . $_POST['id']);
    }

    /**
     * Updates the User info .
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['user:read', 'user:update']);
        $user = new User();
        $usernameUsed = $user->get_by_username($_POST['username']);
        if ($usernameUsed && ($usernameUsed->id != $_POST['id'])) {
            $_SESSION["message-error"] = "Username is used ! (" . $_POST['username'] . ")";
            Helper::redirect('/edit-user?id=' . $_POST['id']);

        }

        $filename = $_FILES["image"]["name"];

        if (!empty($filename)) {
            $tempname = $_FILES["image"]["tmp_name"]; // file stored on the web server’s hard disk in the system temporary file directory.

            $folder = "././resources/images/users-images/" . $filename;

            $_POST['image'] = $folder;

            move_uploaded_file($tempname, $folder);
        }

        // process role
        $permissions = null;
        switch ($_POST['role']) {
            case 'Admin':
                $permissions = User::ADMIN;
                break;

            case 'Seller':
                $permissions = User::SELLER;
                break;
            case 'Procurement':
                $permissions = User::PROCURMENT;
                break;
            case 'Accountant':
                $permissions = User::ACCOUNTANT;
                break;
        }
        unset($_POST['role']);
        $_POST['permissions'] = serialize($permissions);
        $user->update($_POST);
        $_SESSION["message-success"] = "You have successfully saved your data";
        Helper::redirect('/edit-user?id=' . $_POST['id']);
    }

    /**
     * Updates the User info .
     *
     * @return void
     */
    public function updateProfile()
    {
        $user = new User();

        $filename = $_FILES["image"]["name"];

        if (!empty($filename)) {
            $tempname = $_FILES["image"]["tmp_name"]; // file stored on the web server’s hard disk in the system temporary file directory.

            $folder = "././resources/images/users-images/" . $filename;

            $_POST['image'] = $folder;

            move_uploaded_file($tempname, $folder);
        }

        $user->update($_POST);
        $_SESSION["message-success"] = "You have successfully saved your data";
        Helper::redirect('/user_account');
    }


    /**
     * @return void
     * clear the session and redirect to login page.
     */
    public function logout()
    {
        \session_destroy();
        \session_unset();
        \setcookie('user_id', '', time() - 3600);
        Helper::redirect('/');
    }

}

