<?php

use Core\Helpers\Helper; ?>
<div class="container mt-3 w-50 mb-5 pb-3 bg-info l-bg-blue-dark shadow-lg rounded   ">
    <div class="row ">
        <div class="text-center font-weight-bolder shadow-menu mb-3 mt-3 h4   ">

        Edit User
        </div>
        <form action="/update-user" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->user->id ?>">
            <div class="form-group d-flex">
                <img width="50" class="rounded me-3 " src="<?= $data->user->image; ?>">
                <input class="form-control " type="file" name="image" value="" />
            </div>

            <div class="mb-3">
                <label for="displayName" class="form-label font-weight-bolder">Display Name</label>
                <input name="display_name" type="text" value="<?= $data->user->display_name ?>" class="form-control required" id="display_name" required>
            </div>
            <div class="mb-3">
                <label for="user-email" class="form-label font-weight-bolder">Email address</label>
                <input name="email" type="email" value="<?= $data->user->email ?>" class="form-control" id="user-email" required>
                <div id="emailHelp" class="form-text text-white">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label font-weight-bolder">User Name</label>
                <input name="username" type="text" value="<?= $data->user->username ?>" class="form-control" id="username" required>

            </div>

            <label for="userName" class="form-label font-weight-bolder  d-block">Gender:</label>
            <div class="form-check form-check-inline mb-3">
                <input id="Male" class="form-check-input " type="radio" name="gender" value="male"
                    <?= ($data->user->gender == "male") ? "checked" : null ?>>
                <label class="form-check-label" for="Male">Male</label>

            </div>
            <div class="form-check form-check-inline mb-3">
                <input  id="Female" class="form-check-input " type="radio" name="gender" value="female"
                    <?= ($data->user->gender == "female") ? "checked" : null ?>>
                <label class="form-check-label" for="Female">Female</label>
            </div>
            <div class="mb-3">
                <label for="RoleSelect" class="form-label font-weight-bolder">Please Select a Role</label>
                <select id="RoleSelect" class="form-select" name="role" required>
                    <option value="Seller" <?= ($data->role == "Seller")? "selected" : null ?>>Seller</option>
                    <option value='Admin' <?= ($data->role == "Admin")? "selected" : null ?>>Admin </option>
                    <option value="Procurement" <?= ($data->role == "Procurement")? "selected" : null ?>>Procurement</option>
                    <option value="Accountant" <?= ($data->role == "Accountant")? "selected" : null ?>>Accountant</option>
                </select>
            </div>
            <a href="/users" type="submit" class="btn btn-warning text-white mt-3 me-3 ">Back</a>
            <button type="submit" class="btn btn-success mt-3 ">Save</button>
        </form>

    </div>


    </div>

    </div>
</div>