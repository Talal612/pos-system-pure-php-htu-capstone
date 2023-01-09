<?php

use Core\Helpers\Helper; ?>


<div class="container mt-2  ">


    <nav class="navbar bg-dark ">
        <div class="container-fluid d-flex justify-content-center ">
            <div>
                <a href="/cart">
                    <button class="l-bg-orange-dark font-weight-bolder text-center px-5 py-2 ">Cart</button>
                </a>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($data->products as $product) { ?>

                <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center ">

                    <div class="card d-flex justify-content-center fc-state-hover shadow-lg"
                         style="width: 15rem;height: 20rem">
                        <img class="card-img-top " style="width:12rem ;height: 12rem " src="<?= $product->image ?>">
                        <div class="">
                            <h6 class="card-title text-center"><?= $product->name ?></h6>
                        </div>
                        <div class="card-body text-center">
                            <?php if ($product->quantity == 0) { ?>
                            <div class=" alert alert-danger ">
                                Out of Stock !
                            </div>
                            <?php } else { ?>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-success mr-2" onclick="addToCart(
                                                {
                                                item_id: <?= $product->id ?>,
                                                item_name: '<?= $product->name ?>',
                                                item_price: <?= $product->price ?>,
                                                }
                                                )">
                                            <i class="fa-solid fa-cart-plus ">Cart</i>
                                        </button>

                                        <input type="number" min="1" value="1" max="<?= $product->quantity ?>" placeholder="Quantity"
                                               class="w-100" name="quantity" id="<?= $product->id ?>">
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>


            <?php } ?>
        </div>
    </div>


</div>

<script>
    function addToCart(product) {
        const item_quantity = $(`#${product['item_id']}`); // $('#34');
        product.item_quantity = Number(item_quantity.val());
        $.ajax({
            type: "post",
            url: "/add-to-cart",
            data: JSON.stringify(product),
            success: function (response) {
                if (response.success) {
                    toastr.success(`${product.item_name} added to cart`)
                } else {
                    toastr.error("you can't add to cart !")
                }
            },
            error: function (e) {
                toastr.error("you can't add to cart !")
            }
        });
    }
</script>