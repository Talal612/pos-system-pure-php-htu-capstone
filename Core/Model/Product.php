<?php

namespace Core\Model;

use Core\Base\Model;

class Product extends Model
{


    /**
     * Check the available stock of given product before
     * any selling action
     * @param int $id
     * @param int $quantity
     * @return bool
     */
    public function check_available_stock(int $id, int $quantity): bool
    {
        $product = $this->get_by_id($id);
        return $quantity <= $product->quantity;
    }


    /**
     * update the quantity of this  product id .
     * past quantity - new  quantity
     * @param int $id
     * @param int $quantity
     * @return void
     */
    public function update_quantity(int $id, int $quantity): void
    {
        $product = $this->get_by_id($id);
        $info = array(
            "id" => $product->id,
            "quantity" => $product->quantity,
        );
        $info["quantity"] = $info["quantity"] - $quantity;
        $this->update($info);
    }
}
