<?php

namespace Core\Base; // namespace-> hierarchically labeled code block holding

use mysqli; // php built-in function for DB.
use function array_key_last; // php built-in function.
use function explode; // php built-in function.
use function get_class; // php built-in function.
use function strtolower; // php built-in function.


/**
 * Model Class (For Accessing the DB).
 */
class Model
{

    public $connection;
    protected $table;







    /**
     *  To Connect direct  the DB  &&  get the right table name when create instance (Object) .
     */
    public function __construct()
    {
        $this->connection(); // Connect to DB.
        $this->relate_table(); // get the table name.
    }






    /**
     *  To Connect the DB  &&  get the right table name.
     */

    protected function connection() : void
    {
        $servername = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        // For Create connection
        $this->connection = new mysqli($servername, $username, $password, $database);

        // For Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }








    /**
     * Protected method to get the table name.
     * @return void (Does not return anything).
     */
    protected function relate_table() : void
    {
        $table_name = get_class($this); // Returns the name of the class of an object.
        $table_name_arr = explode('\\', $table_name); //  breaks a string into an array by (\) .
        $class_name = $table_name_arr[array_key_last($table_name_arr)]; // get the last key in the array , ex: $table_name_arr[2].
        $final_class_name = strtolower($class_name) . "s"; // lower the name and concatenate with s .
        $this->table = $final_class_name;
    }





    /**
     *  to close the connection of the DataBase when the purpose of the class finish.
     */
    public function __destruct()
    {
        $this->connection->close();
    }


    /**
     * get all the columns in this table.
     * @return array ($data);
     */
    public function get_all(): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $this->table");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


    /**
     * filter the rows by the column and it values .
     * @param string $column
     * @param $value
     * @return array
     */
    public function filter(string $column, $value): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $this->table WHERE $column = $value");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


    /**
     * order the $column by   $order in  limit
     * @param string $column
     * @param int|null $limit
     * @param string $order
     * @return array
     */
    public function order_by(string $column, int $limit = null, string $order="DESC"): array
    {
        $data = array();
        $query = "SELECT * FROM  $this->table ORDER BY $column $order";
        if ($limit) {
            $query = $query . " LIMIT $limit;";
        }
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


    /**
     * count the rows in this table.
     * @return mixed
     */
    public function count()
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) count FROM $this->table"); // prepare the sql statement
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        return $result->fetch_object()->count;
    }


    /**
     * return all the rows where id == $id (param)
     * @param $id
     * @return object
     */
    public function get_by_id($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id =?"); // prepare the sql statement
        $stmt->bind_param('i', $id); // bind the params per data type
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        $stmt->close();
        return $result->fetch_object();
    }


    /**
     * delete the row who the id == $id (param)
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=?"); // prepare the sql statement
        $stmt->bind_param('i', $id); // bind the params per data type
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        $stmt->close();
        return $result;
    }


    /**
     * @param $data
     * @return void
     */
    public function create($data)
    {
        // Get dynamic keys' username , id , display_name
        // $keys: string
        // Get dynamic values corresponds to the key '$data->username','$data->display_name'
        // $values: string

        $keys = '';
        $values = '';
        $data_types = '';
        $value_arr = array();

        foreach ($data as $key => $value) {

            if ($key != array_key_last($data)) {
                $keys .= $key . ', ';
                $values .= "?, ";
            } else {
                $keys .= $key;
                $values .= "?";
            }

            switch ($key) {
                case 'id':
                case 'user_id':
                case 'transaction_id':
                case 'product_id':
                case 'user_transaction_id':
                case 'cart_id':
                    $data_types .= "i";
                    break;

                default:
                    $data_types .= "s";
                    break;
            }

            $value_arr[] = $value;  // append $value into the value_array foreach time.
        }

        // $stmt = $this->connection->prepare("INSERT INTO users (id, username, display_name , email , password , permission , ) VALUES (?,?,?,?,?,?)");


        $sql = "INSERT INTO $this->table ($keys) VALUES ($values)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr); // ...$value_arr == 'ahmad912', 'ahmad_ali', '3'
        $stmt->execute();
        $stmt->close();
    }


    /**
     * update the information by the id .
     * @param $data
     * @return void
     */
    public function update($data)
    {
        $set_values = '';
        $id = 0;

        foreach ($data as $key => $value) {
            if ($key == 'id') {
                $id = $value;
                continue;
            }
            if ($key != array_key_last($data)) {
                $set_values .= "$key='$value', ";
            } else {
                $set_values .= "$key='$value'";
            }
        }
        $sql = "UPDATE $this->table SET $set_values  WHERE id=$id";
        $this->connection->query($sql);
    }
}