<?php

use Core\Helpers\Helper; ?>
<div class="container mt-3 w-50 mb-5 pb-3 bg-info l-bg-blue-dark shadow-lg rounded  ">
    <div class="row">
        <div class="text-center font-weight-bolder shadow-menu mb-3 mt-3 h4   ">

            Create User
        </div>
        <form action="/store-user" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="displayName" class="form-label font-weight-bolder">Profile Image</label>
                <input class="form-control" type="file" name="image"/>
            </div>
            <div class="mb-3">
                <label for="displayName" class="form-label">Display Name</label>
                <input name="display_name" type="text" class="form-control" id="display_name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
                <label for="user-email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="user-email" required>
                <div  class="form-text text-white">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">User Name</label>
                <input name="username" type="text" class="form-control" id="username" required>
            </div>
            <label for="gender" class="form-label  d-block">Gender:</label>
            <div class="form-check form-check-inline mb-3">
                <input id="Male" class="form-check-input " type="radio" name="gender" >
                <label class="form-check-label" for="Male">Male</label>

            </div>
            <div class="form-check form-check-inline mb-3">
                <input id="Female" class="form-check-input " type="radio" name="gender" value="female">
                <label class="form-check-label" for="Female">Female</label>
            </div>
            <div class="mb-3">
                <label for="RoleSelect" class="form-label">Please Select a Role</label>
                <select id="RoleSelect" class="form-select" name="role">
                    <option selected="selected" value='admin'>Admin</option>
                    <option value="seller">Seller</option>
                    <option value="procurement">Procurement</option>
                    <option value="accountant">Accountant</option>
                </select>
            </div>
            <a href="/users" type="submit" class="btn btn-warning text-white mt-3 ">Back</a>
            <button type="submit" class="btn btn-success mt-3 ">Submit</button>
            <button type="reset" class="btn btn-danger mt-3  font-weight-bolder">Reset</button>
        </form>
    </div>
</div>