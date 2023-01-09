<div class="container-fluid mt-5 ">

    <!-- Card stats -->
    <div class="row g-6 mb-6 ">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body l-bg-blue-dark">
                    <div class="row ">
                        <div class="col text-center">
                            <span class="h6 font-semibold  text-sm d-block mb-2">
                                <i class="fas fa-dollar-sign"></i>
                                Total Sales</span>
                            <span class="h1 font-bold mb-0"><?= ' &#36;'.round($data->sales) ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body l-bg-orange-dark">
                    <div class="row ">
                        <div class="col text-center">
                            <span class="h6 font-semibold  text-sm d-block mb-2">
                                <i class="fa-solid fa-credit-card"></i>
                                Total transactions</span>
                            <span class="h1 font-bold mb-0 "><?=$data->transactions_count?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body l-bg-orange-dark ">
                    <div class="row ">
                        <div class="col text-center">
                            <span class="h6 font-semibold  text-sm d-block mb-2">
                                <i class="fa-solid fa-boxes-stacked"></i>
                                Total Products </span>
                            <span class="h1 font-bold "><?= $data->products_count ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow border-0">
                <div class="card-body l-bg-blue-dark">
                    <div class="row ">
                        <div class="col text-center">
                            <span class="h6 font-semibold  text-sm d-block mb-2">
                                <i class="fa-solid fa-user"></i>
                                Total users</span>
                            <span class="h1 font-bold mb-0 "><?= $data->users_count ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border border-primary border-2 opacity-50 text-center w-75 mx-auto">


        <div class="h1 text-center w-75 mx-auto mt-2 mb-4 text-primary fw-bold    ">
            <i class="fas fa-dollar-sign "></i>
            TOP 5 Expensive Products
            <table class="table h5 mt-3 text-black ">
                <tbody class="fw-bold">


                <?php

                if (empty($data->products))
                    {?>
                         <td class="l-bg-orange w-25">No Product yet.</td>
                        <?php }
                else
                {

                      $index=1;
                     foreach ($data->products as $product) :?>
                         <tr class="shadow-lg">
                             <td  class="l-bg-blue-dark w-25  "><?=$index , '.',  $product->name?></td>
                    <td >
                        <img src="<?=$product->image?>" style="width: 10rem;" alt="ProductImage">
                    </td>
                </tr>



                <?php  $index++; endforeach ;} ?>
                </tbody>
            </table>
        </div>

    </div>