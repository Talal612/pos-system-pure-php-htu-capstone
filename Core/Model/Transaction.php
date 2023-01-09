<?php

namespace Core\Model;

use Core\Base\Model;

class Transaction extends Model
{


    /**
     * get the total of sales in transaction table
     * @return mixed
     */
    public function get_total_sales()
    {
        // COALESCE ->  return the first NonNull value .
        $stmt = $this->connection->prepare("SELECT COALESCE(SUM(total), 0) totalSales FROM $this->table"); // prepare the sql statement
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        return $result->fetch_object()->totalSales;
    }


    /**
     * get the daily transaction of the logged-in user (INNER JOIN) .
     * @return array
     */
    public function get_daily_transactions(): array
    {
        $data = array();
        $seller_id = $_SESSION['user']['user_id'];
        $query = "SELECT * FROM $this->table tr INNER JOIN user_transactions ut on( ut.transaction_id = tr.id  AND ut.user_id= $seller_id) where date(created_at) = date(now()) ORDER BY created_at DESC";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


    /**
     * @return mixed
     * get the latest transaction to add it in the top of daily transaction table .
     */
    public function get_latest_transaction()
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table ORDER BY created_at DESC limit 1");
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        return $result->fetch_object();
    }


}
