<?php
include_once '../model/User.php';
include_once '../dao/UserDAO.php';

$user = new User();
$userDao = new UserDAO();
include_once './inc/header.php';
?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Add User</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="../controller/UserController.php" class="form" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <label>Name</label>
                    <input type="text" name="name" value="" autofocus class="form-control" require />
                </div>

                <div class="col-md-3">
                    <label>Username</label>
                    <input type="text" name="username" value="" class="form-control" require />
                </div>

                <div class="col-md-3">
                    <label>Password</label>
                    <input type="password" name="password" value="" class="form-control" require />
                </div>

                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary" name="create">Submit <i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">All User</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userDao->read() as $user) : ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td><?= $user->getName() ?></td>
                        <td><?= $user->getUsername() ?></td>
                        <td class="text-center">
                            <button class="btn  btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $user->getId() ?>">
                            Edit
                            </button>
                            <a href="../controller/UserController.php?del=<?= $user->getId() ?>">
                                <button class="btn  btn-danger btn-sm " type="button">Delete</button>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="edit<?= $user->getId() ?>">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/UserController.php" class="form" method="POST">
                                    <div class="modal-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Name</label>
                                                <input type="text" name="name" value="<?= $user->getName() ?>" class="form-control" require />
                                            </div>
                                            <div class="col-md-3">
                                                <label>Username</label>
                                                <input type="text" name="username" value="<?= $user->getUsername() ?>" class="form-control" require />
                                            </div>
                                            <div class="col-md-3">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" require />
                                            </div>
                                            <div class="col-md-2">
                                                <br>
                                                <input type="hidden" name="id" value="<?= $user->getId() ?>" />
                                                <button class="btn btn-primary" type="submit" name="edit">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
</div>

<?php
include_once './inc/footer.php'; ?>