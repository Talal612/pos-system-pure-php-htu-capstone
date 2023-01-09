<?php

?>


<div class="container mt-3 mb-1 ">
    <div class="d-grid gap-2 col-6 mx-auto mb-2">
        <a type="button" href="/create-user" class="btn btn-warning text-dark text-decoration-none fw-bold">
            <i class="fa-solid fa-plus"></i>
            New User
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Users (<?= $data->users_count ?>)
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-5 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">CreatedOn</th>
                            <th class="text-center">UpdatedOn</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data->users as $user) : ?>
                        <tr>
                            <td class="text-center text-muted"><?= $user->id ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper ms-3 text-center">
                                        <div class="widget-content-left ">
                                            <div class="widget-content-left">
                                                <img width="50" alt="user_image" class="rounded-circle"
                                                     src="<?= $user->image ?>">
                                            </div>
                                        </div>
                            </td>
                            <td>

                                <div class="text-center ">
                                    <div class="widget-heading"><?= $user->display_name ?></div>
                                    <div class=" text-capitalize widget-subheading opacity-7">
                                        <?= $user->username ?>
                                    </div>
                                </div>
                            </td>
                </div>
            </div>
            <td class="text-center text-capitalize "><?= $user->email ?></td>
            <td class="text-center text-capitalize"><?= $user->gender ?></td>
            <td class="text-center">
                <div class="badge bg-warning text-dark"><?= $user->role ?></div>
            </td>
            <td class="text-center">
                <div class=" "><?= $user->created_at ?></div>
            </td>
            <td class="text-center">
                <div class=" "><?= $user->updated_at ?></div>
            </td>
            <td class="text-center p-4">
                <form id="<?= 'deleteUserForm-' . $user->id ?>" method="post" action="/delete-user">
                    <input type="hidden" name="id" value="<?php echo $user->id; ?>" />
                </form>
                <a class="btn btn-warning m-3" href="<?= '/edit-user?id=' . $user->id ?>">
                    <i class="fa-solid fa-user-pen"></i>
                </a>
                <button form="<?= 'deleteUserForm-' . $user->id ?>" class="btn btn-danger m-3" type="submit">
                    <i class="fa-solid fa-user-minus"></i>
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