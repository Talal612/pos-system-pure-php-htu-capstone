<h1 class="d-flex justify-content-around mb-5">Users List (<?= $data->users_count ?>)</h1>

<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Display Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->users as $user) : ?>
            <tr>
                <td><?= $user->display_name ?></td>
                <td><a href="./user?id=<?= $user->id ?>" class="btn btn-primary">Check User</a></td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>



<div class="container mt-3">
    <h1>Users info.</h1>
    <h2><?= $data->users_count ?></h2>
    <table class="table">
        <thead>
            <tr>
                <th>Display Name</th>
                <th>User Name</th>
                <th>Password</th>
                <th>Email</th>
                <th>Created On</th>
                <th>Updated on</th>
            </tr>
        </thead>
        <?php foreach ($data->users as $user) : ?>
        <tbody>
            <tr>
                <td><?= $user->display_name ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->password ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->created_at ?></td>
                <td><?= $user->updated_at ?></td>

            </tr>
        </tbody>
        <?php endforeach; ?>
        <!-- <tr class="table-primary">
            <td>Primary</td>
            <td>Joe</td>
            <td>joe@example.com</td>
        </tr>
        <tr class="table-success">
            <td>Success</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>
        <tr class="table-danger">
            <td>Danger</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr class="table-info">
            <td>Info</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
        <tr class="table-warning">
            <td>Warning</td>
            <td>Refs</td>
            <td>bo@example.com</td>
        </tr>
        <tr class="table-active">
            <td>Active</td>
            <td>Activeson</td>
            <td>act@example.com</td>
        </tr>
        <tr class="table-secondary">
            <td>Secondary</td>
            <td>Secondson</td>
            <td>sec@example.com</td>
        </tr>
        <tr class="table-light">
            <td>Light</td>
            <td>Angie</td>
            <td>angie@example.com</td>
        </tr>
        <tr class="table-dark">
            <td>Dark</td>
            <td>Bo</td>
            <td>bo@example.com</td>
        </tr>
        </tbody> -->
    </table>
</div>