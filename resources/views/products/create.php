<?php

use Core\Helpers\Helper; ?>
<div class="container mt-3 w-50 mb-5 pb-3 bg-info l-bg-blue-dark shadow-lg rounded">
    <div class="row">
        <div class="text-center font-weight-bolder shadow-menu mb-3 mt-3 h4   ">

            Create Product
        </div>
        <form action="/create-product" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="displayName" class="form-label  font-weight-bolder"> Image</label>
                <input class="form-control rounded"  type="file" name="image" required  />
            </div>
            <div class="mb-3">
                <label for="displayName" class="form-label font-weight-bolder">Display Name</label>
                <input name="name" type="text" class="form-control" id="display_name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label font-weight-bolder " >Price</label>
                <input name="price" type="number" step="any" min="1" value="" class="form-control" id="price" required>
            <div class="mb-3">
                <label for="productQunatity" class="form-label font-weight-bolder">Qunatity</label>
                <input name="quantity" type="number" min="1" class="form-control" id="productQunatity" required>
            </div>
            <a href="/products" type="submit" class="btn btn-warning text-white mt-3 font-weight-bolder ">Back</a>
            <button type="submit" class="btn btn-success mt-3  font-weight-bolder">Create</button>
            <button type="reset" class="btn btn-danger mt-3  font-weight-bolder">Reset</button>
        </form>
    </div>
</div>