<?php

use Core\Helpers\Helper;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href='<?php echo Helper::asset("css/styles.css") ?>'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<?php


if (substr($_SERVER['REQUEST_URI'], -1) == '/')
    return;

?>

<body>
<div id="sidebar" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <i class="fa-solid fa-shop me-2"></i>
            <h3 class="fw-semibold logo-src ms-3 mb-3 ">POS</h3>
            <div class="header__pane ml-auto">
                <div>
                    <i id="header-toggler" class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button id="hamburger-toggler" type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">

                <ul class="header-menu nav">
                    <li <?php if ($_SESSION['user']['role'] == 'Admin'){ ?> class="nav-item">
                        <a href="/dashboard" class="d-flex text-decoration-none">
                            <i class="fa-solid fa-house mt-2 me-2"></i>
                            <h4 class="fw-semibold">Home</h4>
                        </a>
                    </li <?php } ?>>

                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg ">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">

                            <div class="widget-content-left d-flex  ml-1 header-user-info ">
                                <div class="widget-content-right header-user-info ml-1">
                                    <div id="btn-account" class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                           class="p-2 btn d-flex ">
                                            <img width="50" class="rounded-circle"
                                                 src="<?= $_SESSION['user']['image'] ?>" alt="profile-image">
                                            <div class="mt-2 ms-2">
                                                <h5 class="fw-bold  "><?= $_SESSION['user']['display_name'] ?>
                                                </h5>
                                            </div>
                                            <i class="fa fa-angle-down mt-3"></i>
                                        </a>
                                        <div role="menu" id="dropdown-account-toggler" aria-hidden="true"
                                             class="dropdown-menu dropdown-menu-right">
                                            <a href="/user_account" type="button" tabindex="0"
                                               class="dropdown-item">
                                                <i class="fa-solid fa-image-portrait me-1"></i>
                                                User Account</a>
                                            <a href="/logout" class="dropdown-item">
                                                <i class="fa-solid fa-right-from-bracket me-1"></i>
                                                Logout</a>
                                            <h6 tabindex="-1" class="dropdown-header text-center badge bg-primary">
                                                <i class="fa-solid fa-id-card-clip"></i>

                                                <?= $_SESSION['user']['role'] ?>
                                            </h6>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div>
                    <i class="fa-solid fa-shop"></i>
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                    <span>
                        <button type="button"
                                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">

                        <li class="app-sidebar__heading">
                            <i class="fa-solid fa-gauge"></i>
                            Dashboards
                        </li>

                        <li <?php if ($_SESSION['user']['role'] == 'Admin'){ ?>>
                            <a href="/"
                               class=" text-nowrap <?= Helper::isRouteActive("home") ? "active" : null ?> ">
                                <i class="metismenu-icon fa-solid fa-file-invoice "></i>
                                Informative Dashboard
                            </a>
                        </li <?php } ?>>

                        <li <?php if ($_SESSION['user']['role'] == 'Admin' || $_SESSION['user']['role'] == 'Seller') { ?>>
                            <a href="/sellingDashboard"
                               class=" text-nowrap <?= Helper::isRouteActive("selling-dashboard") ? "active" : null ?> ">
                                <i class="metismenu-icon fa-solid fa-duotone fa-sack-dollar "></i>
                                Selling dashboard
                            </a>
                        </li <?php } ?>>

                        <li <?php if ($_SESSION['user']['role'] == 'Admin' || $_SESSION['user']['role'] == 'Procurement') { ?>>
                            <a href="/products"
                               class=" text-nowrap <?= Helper::isRouteActive("products") ? "active" : null ?> ">
                                <i class=" metismenu-icon fa-solid fa-light fa-box-open"></i>
                                Stock Management
                            </a>
                        </li <?php } ?>>

                        <li <?php if ($_SESSION['user']['role'] == 'Admin' || $_SESSION['user']['role'] == 'Accountant') { ?>>
                            <a href="/transactions"
                               class=" text-nowrap <?= ($_SESSION['SECTION'] == "transactions") ? "active" : null ?> ">
                                <i class="metismenu-icon fa-solid fa-arrow-right-arrow-left"></i>
                                Transactions Management
                            </a>
                        </li <?php } ?>>

                        <li <?php if ($_SESSION['user']['role'] == 'Admin'){ ?>>
                            <a href="/users"
                               class=" text-nowrap <?= ($_SESSION['SECTION'] == "users") ? "active" : null ?> ">
                                <i class="metismenu-icon fa-solid fa-users"></i>
                                User’s Management
                            </a>
                        </li <?php } ?>>

                </div>
            </div>
        </div>
        <div class="app-main__outer">