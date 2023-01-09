<?php

use Core\Helpers\Helper; ?>
<div class="container mt-3 w-50 mb-5 pb-3  l-bg-blue-dark shadow-lg rounded ">

    <div class="row">
        <div class="text-center font-weight-bolder shadow-menu mb-3 mt-3 h4">
            Edit Product
        </div>
        <form action="/update-product" method="POST"  enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->product->id ?>">
            <label for="name" class="form-label font-weight-bolder">Image</label>

            <div class="form-group d-flex">
                <img width="50" class="rounded me-3 " src="<?= $data->product->image; ?>">
                <input class="form-control " type="file" name="image" value="" />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label font-weight-bolder">Name</label>
                <input name="name" type="text" value="<?= $data->product->name ?>" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label font-weight-bolder">Quantity</label>
                <input name="quantity" min=0 type="number" value="<?= $data->product->quantity ?>" class="form-control" id="quantity" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label font-weight-bolder">Price</label>
                <input name="price" type="text" min="1"  value="<?= $data->product->price ?>" class="form-control" id="price" required>
            </div>

            <div class="mb-3">
                <label for="cost" class="form-label font-weight-bolder">Cost</label>
                <input name="cost" type="text" min="1" value="<?= $data->product->cost ?>" class="form-control" id="cost" required>
            </div>

            <a href="/products" type="submit" class="btn btn-warning text-white mt-3 me-3 ">Back</a>
            <button type="submit" class="btn btn-success mt-3 ">Save</button>
        </form>
    </div>
</div>
