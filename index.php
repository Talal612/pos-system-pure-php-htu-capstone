<?php
session_start();

use Core\Router;
use Core\Model\User;



spl_autoload_register(function ($class_name) {

    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name); // \\ = \
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
});

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])) { // check if there is user_id cookie.
    // log in the user automatically
    $user = new User(); // get the user model
    $logged_in_user = $user->get_by_id($_COOKIE['user_id']); // get the user by id
    $_SESSION['user'] = array( // set up the user session that idecates that the user is logged in. 
        'username' => $logged_in_user->username,
        'display_name' => $logged_in_user->display_name,
        'user_id' => $logged_in_user->id,
        'is_admin_view' => true
    );
}



// For public access
Router::get('/', 'authentication.login'); // Display home.php
Router::post('/authenticate', 'authentication.validate'); // Display Dashboard.php



//  For access the dashborad .
Router::get('/dashboard', "dashboard.getDashBoard"); // Display Dashboard.php





// athenticated + permissions [user:read]
Router::get('/users', "users.index"); // list of users (HTML)
// Router::get('/user', "users.single"); // Displays single post (HTML)




//  FOR LOGOUT

Router::get('/logout', "Authentication.logout"); // Delete the user (PHP)


// var_dump(Router::$get_routes);
// echo " <br> ";
// var_dump(Router::$post_routes);
// echo " <br> ";
// var_dump(Router::$put_routes);
// echo " <br> ";
// var_dump(Router::$delete_routes);
// die();
Router::redirect();