<?php
session_start();

require_once "./config.php";

use Core\Model\User;
use Core\Router;

// alias to a Router .
// alias to a User Model.


/**
 * php built-in function
 * to require the RequiredController.
 * run when the Router class called.
 * It effectively creates a queue of autoload functions,
 * and runs through each of them in the order they are defined.
 */
spl_autoload_register(function ($class_name) {

    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name);
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
});


if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])) { // check if there is user_id cookie.
    // log in the user automatically
    $user = new User(); // get the user model
    $logged_in_user = $user->get_by_id($_COOKIE['user_id']); // get the user by his id.
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
        'is_admin_view' => true,
        'role' => $role,
        'gender' => $logged_in_user->gender
    );
}


// For public access
Router::get('/', 'authentication.login'); // Display home.php (Login page)
Router::post('/authenticate', 'authentication.validate'); // Authentication and Validation (php)


//  For access the dashboard .
Router::get('/dashboard', "dashboard.getDashboard"); // Display the Informative Dashboard .


//  For access the Selling dashboard .
Router::get('/sellingDashboard', "sellingDashboard.getDashboard"); // Display Selling Dashboard.
Router::get('/cart', "sellingDashboard.cart"); // Display the cart list .php
Router::post('/add-to-cart', "endpoints.add_to_cart"); // Add to cart .php
Router::post('/sell', "endpoints.sell"); // Add to cart .php


// authenticated + permissions [user:read]
Router::get('/users', "users.index"); // list of users table (HTML)
// authenticated + permissions [user:read,user:delete]
Router::post('/delete-user', "users.delete"); // Method to Delete the user (HTML)
// authenticated + permissions [user:read,user:update]
Router::get('/edit-user', "users.edit"); // Edit User info Form (HTML)
// authenticated + permissions [user:read,user:update]
Router::post('/update-user', "users.update"); // Update user Form (HTML)
// authenticated + permissions [user:read,user:update]
Router::post('/store-user', "users.store"); // Create user Form (HTML)
// authenticated + permissions [user:read,user:create]
Router::get('/create-user', "users.create"); // Create user Form (HTML)
// authenticated +  No Permissions to change the password or to enter the user Profile .
Router::get('/changePassword', "users.changePassword"); // Change Password Form (HTML)
Router::post('/setPassword', "users.setPassword"); // Change Password Form (HTML)
Router::get('/user_account', "users.userProfile");  // User profile page  (HTML)
Router::post('/update-profile', "users.updateProfile");  // User profile page  (HTML)


// authenticated + permissions [product:read]
Router::get('/products', "products.index"); // list of Products (HTML)
// authenticated + permissions [product:read,product:delete]
Router::post('/delete-product', "products.delete"); // delete Product (HTML)
// authenticated + permissions [product:read,product:update]
Router::get('/edit-product', "products.edit"); // Edit Product (HTML)
// authenticated + permissions [product:read,product:update]
Router::post('/update-product', "products.update"); // Update Product (HTML)
// authenticated + permissions [product:read,product:update]
Router::post('/create-product', "products.store"); // Store Product (HTML)
// authenticated + permissions [product:read,product:create]
Router::get('/create-product', "products.create"); // Create Product (HTML)


// authenticated + permissions [transaction:read]
Router::get('/transactions', "transactions.index"); // list of transactions table (HTML)
// authenticated + permissions [transaction:read,transaction:delete]
Router::post('/delete-transaction', "transactions.delete"); // Delete the transaction (HTML).
// authenticated + permissions [transaction:read,transaction:update]
Router::get('/edit-transaction', "transactions.edit"); // Edit the transaction (HTML)
// authenticated + permissions [transaction:read,transaction:update]
Router::post('/update-transaction', "transactions.update"); // Update the transaction (HTML)
// authenticated + permissions [transaction:read,transaction:update]


//  // Logout The User.
Router::get('/logout', "users.logout");


// For Redirect to the specific controller and it's method .
Router::redirect();