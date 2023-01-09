<?php

namespace Core;

use Core\Base\View;
use Core\Helpers\Helper;

/**
 * Manages the routing process in the application
 */
class Router
{
    // Requests types

    // GET requests
    public static $get_routes = array();

    // POST requests
    public static $post_routes = array();

    // PUT requests
    public static $put_routes = array();

    // DELETE requests
    public static $delete_routes = array();


    /**
     * 1) get the REQUEST URI .
     * 2)  fill the array routes depending on what the REQUEST_METHOD we have .
     * 3) check if  the routes empty  and if the request uri not in the  routes  if true -> check if logged in or not if true redirect to the login page.
     * 4) prepare the controller name .
     * 5) render to the controller name .
     * @return void
     */
    public static function redirect(): void
    {

        $request = $_SERVER['REQUEST_URI'];
        $request = \explode("?", $request)[0];


        $routes = array();


        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $routes = self::$get_routes;
                break;

            case 'POST':
                $routes = self::$post_routes;
                break;
            case 'PUT':
                $routes = self::$put_routes;
                break;
            case 'DELETE':
                $routes = self::$delete_routes;
                break;
        }


        if (empty($routes) || !array_key_exists($request, $routes)) {

            if (empty($_SESSION['user'])) {
                Helper::redirect('/');
                exit;
            }
            http_response_code(404);
            new View('404'); // This page (Template) is in the views directory
            exit;
        }


        $controller_namespace = 'Core\\Controller\\';
        $class_arr = explode('.', $routes[$request]);
        $class_name = ucfirst($class_arr[0]);
        $class = $controller_namespace . $class_name;
        unset($_SESSION['SECTION']);
        $instence = new $class;


        if (count($class_arr) == 2) {
            call_user_func([$instence, $class_arr[1]]);
        }

        $instence->render();
    }

    /**
     * to fill the get_routes array , the index is the name of route and the value it the controller
     * @param $route
     * @param $controller
     * @return void
     */
    public static function get($route, $controller): void
    {
        self::$get_routes[$route] = $controller;
    }


    /**
     * to fill the post_routes array , the index is the name of route and the value it the controller
     * @param $route
     * @param $controller
     * @return void
     */
    public static function post($route, $controller): void
    {
        self::$post_routes[$route] = $controller;
    }


    /**
     * to fill the put_routes array , the index is the name of route and the value it the controller
     * @param $route
     * @param $controller
     * @return void
     */
    public static function put($route, $controller): void
    {
        self::$put_routes[$route] = $controller;
    }


    /**
     * to fill the delete_routes array , the index is the name of route and the value it the controller
     * @param $route
     * @param $controller
     * @return void
     */
    public static function delete($route, $controller): void
    {
        self::$delete_routes[$route] = $controller;
    }


}