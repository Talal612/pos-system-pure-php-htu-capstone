<?php

use Core\Helpers\Helper; ?>
<div class="container mt-3 w-50 mb-5 pb-3 bg-info l-bg-blue-dark shadow-lg rounded   ">
    <div class="row ">
        <div class="text-center font-weight-bolder shadow-menu mb-3 mt-3 h4   ">

            Edit User
        </div>
        <form action="/setPassword" method="POST">
            <input type="hidden" name="id" value="<?= $_SESSION['user']['user_id'] ?>">
            <div class="mb-3">
                <label for="old_password" class="form-label font-weight-bolder">Old Password:</label>
                <input name="old_password" type="password"  value="" class="form-control" id="old_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label font-weight-bolder">New Password:</label>
                <input name="new_password" type="password" value="" class="form-control" id="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label font-weight-bolder">Confirm Password:</label>
                <input name="confirm_password" type="password" value="" class="form-control" id="confirm_password" required>
            </div>

            <a href="/users" type="submit" class="btn btn-warning text-white mt-3 me-3 ">Back</a>
            <button type="submit" class="btn btn-success mt-3 ">Save</button>
        </form>
    </div>
</div>