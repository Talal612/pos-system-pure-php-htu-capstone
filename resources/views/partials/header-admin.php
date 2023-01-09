<?php

use Core\Helpers\Helper; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php

if (strpos($_SERVER['SCRIPT_FILENAME'], 'login.php'))
    return;

?>

<body class="admin-view">


    <nav class="navbar navbar-expand-lg  bg-primary shadow-lg   ">
        <h4 class="mx-2 my-1 p-2  text-white rounded  " href="#"> <i class="fa-solid fa-store"></i> HTU-POS</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active mx-3 p-2  rounded text-white " href="/"> <i
                        class="fa fa-fw fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </div>

        </div>
        <div class="navbar-nav navbar-right text-white  ">
            <div class="dropdown">
                <a class=" me-5 mx-3 dropdown-toggle text-white text-decoration-none" href="#" role="button"
                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Admin User
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-id-badge"></i>
                            Role</a>
                    </li>
                    <li><a class="dropdown-item " href="#"><i class="fa-solid fa-address-card"></i>
                            My profile</a>
                    </li>
                    <li><a class="dropdown-item" href="./logout"">
                            <i class=" fa-solid fa-right-from-bracket">

                            </i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="admin-area" class="row ">
        <div class="col-2 admin-links shadow-lg   rounded  ">
            <ul class=" list-group list-group-flush mt-2 p-2  rounded text-white bg-primary   ">
                <?php if (Helper::check_permission(['post:read'])) : ?>
                <li class="list-group-item l-bg-orange-dark border-bottom ">
                    <a href="/posts"><i class="fa-solid fa-boxes-stacked"></i> Products</a>
                </li>

                <?php endif;
                if (Helper::check_permission(['post:create'])) :
                ?>
                <li class="list-group-item l-bg-green-dark border-bottom ">
                    <a href="/posts/create"><i class="fa-solid fa-box-open"></i> Create Product</a>
                </li>
                <?php endif;

                if (Helper::check_permission(['post:create'])) :
                ?>
                <li class="list-group-item l-bg-cherry border-bottom ">
                    <a href="/posts/create"><i class="fa-regular fa-file-invoice-dollar"></i> Transactions</a>
                </li>
                <?php endif;

                if (Helper::check_permission(['user:read'])) :
                ?>
                <li class="list-group-item l-bg-red-dark border-bottom ">
                    <a href="/users"><i class="fa-solid fa-users"></i> Users</a>
                </li>
                <?php endif;
                if (Helper::check_permission(['user:create'])) :
                ?>
                <li class="list-group-item bg-dark  border-bottom ">
                    <a href="/users/create"><i class="fa-solid fa-user"></i> Create User</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="col-10 admin-area-content">