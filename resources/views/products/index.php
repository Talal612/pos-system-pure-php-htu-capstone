<?php

use Core\Helpers\Helper; ?>


<div class="container mt-3 mb-1 ">
    <div class="d-grid gap-2 col-6 mx-auto mb-2">
        <a type="button" href="/create-product" class="btn btn-warning text-dark text-decoration-none fw-bold">
            <i class="fa-solid fa-plus"></i>
            New Product
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">products (<?= $data->products_count ?>)
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Cost</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Created On</th>
                                <th class="text-center">Updated On</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data->products as $product) : ?>
                            <tr>
                                <td class="text-center text-muted"><?= $product->id ?></td>
                                <td>

                                    <div class="text-center ">
                                        <div class="widget-heading"><?= $product->name ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper ms-3 text-center">
                                            <div class="widget-content-left ">
                                                <div class="widget-content-left">
                                                    <img width="50" class="rounded-circle" src="<?= $product->image ?>">
                                                </div>
                                            </div>
                                </td>

                </div>
            </div>
            <td class="text-center text-capitalize"><?= $product->cost ?></td>

            <td class="text-center text-capitalize "><?= $product->price ?></td>
            <td class="text-center text-capitalize"><?= $product->quantity ?></td>
            <td class="text-center">
                <div class=" "><?= $product->created_at ?></div>
            </td>
            <td class="text-center">
                <div class=" "><?= $product->updated_at ?></div>
            </td>

            <form id="<?= 'deleteproductForm-' . $product->id ?>" method="post" action="/delete-product">
                <input type="hidden" name="id" value="<?php echo $product->id; ?>" />
            </form>

            <form id="<?= 'editproductForm-' . $product->id ?>" method="get" action="/edit-product">
                <input type="hidden" name="id" value="<?php echo $product->id; ?>" />
            </form>

            <td class="text-center">
                <button type="submit" form="<?= 'editproductForm-' . $product->id ?>"
                    class="btn btn-primary m-3 px-3 ">Edit</button>
                <button form="<?= 'deleteproductForm-' . $product->id ?>" class="btn btn-danger   m-3" type="submit">
                    Delete
                </button>
            </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
</div>


</div>
</div>