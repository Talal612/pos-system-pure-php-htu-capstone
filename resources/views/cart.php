<div class="container mt-3 mb-5 ">

    <div>
        <a href="/sellingDashboard" type="submit" class="btn btn-warning text-white mb-2 ">Back</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card ">
                <div>
                    <div id="cart-count" class="card-header">cart(<?= $_SESSION['cart_count'] ?>)
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="shoppingTable">
                        <?php foreach ($data->shopping_cart as $item) : ?>
                            <tr id="<?= $item->item_id ?>">
                                <td class="text-center text-muted"><?= $item->item_id ?></td>
                                <td class="text-center text-capitalize"><?= $item->item_name ?></td>
                                <td class="text-center text-capitalize"><?= $item->item_price ?></td>
                                <td class="text-center text-capitalize"><?= $item->item_quantity ?></td>
                                <td class="text-center text-capitalize"><?= $item->item_quantity * $item->item_price ?></td>
                                <td class="text-center text-capitalize">
                                    <button class="btn btn-success" onclick="sell({
                                            cart_id: <?= $item->id ?>,
                                            item_id: <?= $item->item_id ?>,
                                            quantity: <?= $item->item_quantity ?>,
                                            total: <?= $item->item_quantity * $item->item_price ?>,

                                            })">Sell
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
    <hr class="container ">
    <div class="row">

        <div class="col-md-12">
            <div class="main-card mb-3 card ">
                <div class="">
                    <div id="transaction_total" class="card-header">
                        Daily Transactions (<?php $total_array = array_column($data->daily_transactions, 'total');
                        echo '$' . round(array_sum($total_array)) ?>)
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Transaction id</th>
                            <th class="text-center">Prodcut id</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Created On</th>
                            <th class="text-center">Updated On</th>
                        </tr>
                        </thead>
                        <tbody id="transactionTable">
                        <?php foreach ($data->daily_transactions as $transaction) : ?>
                            <tr>
                                <td class="text-center text-muted"><?= $transaction->transaction_id ?></td>
                                <td class="text-center text-capitalize"><?= $transaction->item_id ?></td>
                                <td class="text-center text-capitalize"><?= $transaction->quantity ?></td>
                                <td class="text-center text-capitalize"><?= $transaction->total ?></td>
                                <td class="text-center text-capitalize"><?= $transaction->created_at ?></td>
                                <td class="text-center text-capitalize"><?= $transaction->updated_at ?></td>
                                <td class="text-center p-4">
                                    <form id="<?= 'deletetransactionForm-' . $transaction->transaction_id ?>" method="post"
                                          action="/delete-transaction">
                                        <input type="hidden" name="id" value="<?php echo $transaction->transaction_id; ?>"/>
                                    </form>
                                    <a class="btn btn-warning" href="<?= '/edit-transaction?id=' . $transaction->transaction_id ?>">
                                        Edit
                                    </a>
                                    <button form="<?= 'deletetransactionForm-' . $transaction->transaction_id ?>"
                                            class="btn btn-danger  m-3" type="submit">
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

<script>
    function removeRow(item) {
        const row = $(`#${item.item_id}`);
        const count = $(`#cart-count`);
        const newCount = '<?= $_SESSION['cart_count'] - 1 ?>';
        count.html(`Cart ${newCount}`);

        row.remove();
    }

    function prependRow(item) {
        const table = $('#transactionTable');
        const sum = $(`#transaction_total`);

        const oldSum = '<?php $total_array = array_column($data->daily_transactions, 'total'); echo round(array_sum($total_array)) ?>';
        const newSum = Number(oldSum) + Number(item.total);
        sum.html(`Daily Transactions ($${newSum})`);
        table.prepend(`
            <tr>
                <td class="text-center">${item.id}</td>
                <td class="text-center">${item.item_id}</td>
                <td class="text-center">${item.quantity}</td>
                <td class="text-center">${item.total}</td>
                <td class="text-center">${item.created_at}</td>
                <td class="text-center">${item.updated_at}</td>
                <td class="text-center p-4">
                    <form id='deletetransactionForm-${item.id}' method="post" action="/delete-transaction">
                        <input type="hidden" name="id" value="${item.id}" />
                    </form>
                    <a class="btn btn-warning" href='/edit-transaction?id=${item.id}'>
                        Edit
                    </a>
                    <button form='deletetransactionForm-${item.id}' class="btn btn-danger  m-3" type="submit">
                        Delete
                    </button>
                </td>
            </tr>`
        )

    }

    function sell(item) {
        removeRow(item);
        $.ajax({
            type: "post",
            url: "/sell",
            data: JSON.stringify(item),
            success: function (response) {
                if (response.success) {
                    toastr.success(`Item sold`)
                    prependRow(response.body)
                } else {
                    toastr.error(response.message_code)
                }
            },
            error: function (e) {
                toastr.error(e.message)
            }
        });
    }
</script>