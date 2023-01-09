<?php

namespace Core\Model;

use Core\Base\Model;

class Cart extends Model
{

    /**
     * To get the specific cart item where seller id is equal the seller id .
     * @param $id
     * @param $seller_id
     * @return mixed
     */
    public function get_cart_item($id, $seller_id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE seller_id = $seller_id and item_id =?"); // prepare the sql statement
        $stmt->bind_param('i', $id); // bind the params per data type
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        $stmt->close();
        return $result->fetch_object();
    }


}
