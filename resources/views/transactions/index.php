<?php

use Core\Helpers\Helper; ?>


<div class="container mt-3 mb-1 ">

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">transactions (<?= $data->transactions_count ?>)
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
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data->transactions as $transaction) : ?>
                            <tr>
                                <td class="text-center text-muted"><?= $transaction->id ?></td>
                                <td>

                                    <div class="text-center ">
                                        <div class="widget-heading"><?= $transaction->item_id ?></div>
                                    </div>
                                </td>
                                <td>

                                    <div class="text-center ">
                                        <div class="widget-heading"><?= $transaction->quantity ?></div>
                                    </div>
                                </td>
                </div>
            </div>
            <td class="text-center text-capitalize "><?= $transaction->total ?></td>
            <td class="text-center">
                <div class=" "><?= $transaction->created_at ?></div>
            </td>
            <td class="text-center">
                <div class=" "><?= $transaction->updated_at ?></div>
            </td>

            <td class="text-center p-4">
                <form id="<?= 'deletetransactionForm-' . $transaction->id ?>" method="post" action="/delete-transaction">
                    <input type="hidden" name="id" value="<?php echo $transaction->id; ?>" />
                </form>
                <a class="btn btn-warning" href="<?= '/edit-transaction?id='. $transaction->id?>">
                    Edit
                </a>
                <button form="<?= 'deletetransactionForm-' . $transaction->id ?>" class="btn btn-danger  m-3" type="submit">
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