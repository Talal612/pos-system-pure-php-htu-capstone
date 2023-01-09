<?php

namespace Core\Base;

use Core\Helpers\Helper;

/**
 * To  include the PHP HTML Template.
 */
class View
{

    /**
     * when create the instance (object) from the view class , the construct prepares the name of the view to include it .
     * @param string $view -> name of the template.
     * @param array $data -> data .
     */
    public function __construct(string $view, array $data = array())
    {
        $view = \str_replace('.', '/', $view);
        $data = (object) $data;

        //   include the header.
        include_once \dirname(__DIR__, 2) . "/resources/views/partials/header.php"; // includes the header for all the views


        //  include the view template.
        include_once \dirname(__DIR__, 2) . "/resources/views/$view.php";

        //  if not logged in do not include the footer.
        if (isset($_SESSION['user']))
            include_once \dirname(__DIR__, 2) . "/resources/views/partials/footer.php"; // include the footer for all the views
    }
}