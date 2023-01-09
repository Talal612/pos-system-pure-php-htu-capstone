<?php

namespace Core\Helpers;

use Core\Model\User;

class Helper
{

    /**
     * redirect to the specific url (param).
     * @param string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }


    /**
     * get the  permission of user and check if it in the permission set or not
     * @param array $permissions_set
     * @return bool
     */
    public static function check_permission(array $permissions_set): bool
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }

        $user = new User;
        $assigned_permissions = $user->get_permissions();
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
                return false;
            }
        }
        return true;
    }


    /**
     * static Method to return the full url of static file given the file path.
     * @param string $path
     * @return string
     */
    public static function asset(string $path): string
    {
        return "http://" . $_SERVER['HTTP_HOST'] . '/resources/' . $path;
    }


    public static function isValidInteger($arg): bool
    {
        return intval($arg)  && intval($arg)>0;
    }


    /**
     * @param string $section_name
     * @return string
     */
    public static function isRouteActive(string $section_name): string
    {
        return $_SESSION["SECTION"] == $section_name;
    }


}