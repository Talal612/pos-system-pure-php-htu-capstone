<?php

use Core\Helpers\Helper; ?>
<div class="container mt-3 w-50 mb-5 pb-3  l-bg-blue-dark shadow-lg rounded">
    <div class="row">
        <div class="text-center font-weight-bolder shadow-menu mb-3 mt-3 h4">
            Edit Transaction
        </div>
        <form action="/update-transaction" method="POST">
            <input type="hidden" name="id" value="<?= $data->transaction->id ?>">
            <div class="mb-3">
                <label for="item_id" class="form-label">Prodcut id</label>
                <input name="item_id" type="text" readonly value="<?= $data->transaction->item_id ?>" class="form-control" id="item_id">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input name="quantity" min=1 type="number" value="<?= $data->transaction->quantity ?>" class="form-control" id="quantity">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input name="total" readonly type="text" value="<?= $data->transaction->total ?>" class="form-control" id="total">
            </div>

            <a href="/transactions" type="submit" class="btn btn-warning text-white mt-3 ">Back</a>
            <button type="submit" class="btn btn-primary mt-3 ">Save</button>
        </form>
    </div>
</div>