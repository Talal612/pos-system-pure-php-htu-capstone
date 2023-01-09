<?php

namespace Core\Model;

use Core\Base\Model;

class User extends Model
{

    const ADMIN = array(
        "product:read", "product:create", "product:update", "product:delete",
        "user:read", "user:create", "user:update", "user:delete",
        "transaction:read","transaction:create", "transaction:update", "transaction:delete",
        "cart:read", "cart:create", "cart:delete","transaction:super"
    );

    const SELLER = array(
        "transaction:read", "transaction:update", "transaction:delete",
        "cart:read", "cart:create", "cart:delete"
    );

    const PROCURMENT = array(
        "product:read", "product:create", "product:update", "product:delete"
    );

    const ACCOUNTANT = array(
        "transaction:read", "transaction:update", "transaction:delete",
        "transaction:super"
    );


    /**
     * get all users with their role .
     * @return array
     */
    public function get_users_with_role()
    {
        $users = $this->get_all();
        foreach ($users as $user) {
            $permissions = \unserialize($user->permissions);
            switch ($permissions) {

                case self::SELLER:
                    $user->role = "Seller";
                    break;

                case self::ADMIN:
                    $user->role = "Admin";
                    break;

                case self::PROCURMENT:
                    $user->role = "Procurement";
                    break;

                case self::ACCOUNTANT:
                    $user->role = "Accountant";
                    break;
                default:
                    $user->role = "Undefined";
            }
        }

        return $users;
    }


    /**
     * get all the rows where the username equal username (param) .
     * if no rows , return false (authenticate)
     * @param string $username
     * @return false
     */
    public function get_by_username(string $username)
    {
        $result = $this->connection->query("SELECT * FROM $this->table WHERE username='$username'");
        if ($result) { // if there is an error in the connection or if there is syntax error in the SQL.
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    /**
     * get the permission of the logged-in user.
     * @param int|null $id
     * @return array
     */
    public function get_permissions(int $id = null): array
    {
        $permissions = array();
        if ($id) {
            $user = $this->get_by_id($id);
        } else {
            $user = $this->get_by_id($_SESSION['user']['user_id']);
        }
        if ($user) {
            $permissions = \unserialize($user->permissions);
        }
        return $permissions;
    }
}