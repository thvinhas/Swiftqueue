<?php
include_once '../connection/connection.php';
include_once '../model/Course.php';
include_once '../dao/CourseDAO.php';

$course = new Course();
$courseDao = new CourseDAO();

include_once './includes/header.php';
?>
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Form</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="app/controller/CourseController.php" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <label>Name</label>
                    <input type="text" name="name" value="" autofocus class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Start Date</label>
                    <input type="date" name="startDate" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>End Date</label>
                    <input type="date" name="endDate" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="A">Active</option>
                        <option value="I">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <br>
                    <button type="submit" class="btn btn-primary" name="create">Submit form <i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Table</h5>
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
                    <th>Id</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Active</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courseDao->read() as $course) : ?>
                    <tr>
                        <td><?= $course->getId() ?></td>
                        <td><?= $course->getName() ?></td>
                        <td><?= $course->getStartDate() ?></td>
                        <td><?= $course->getEndDate() ?></td>
                        <?php if($course->getStatus() == "A"){ ?>
                        <td><span class="badge badge-active">Active</span></td>
                        <?php }else {?>
                            <td><span class="badge badge-danger">Inactive</span></td>
                        <?php }?>
                        <td class="text-center">
                            <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $course->getId() ?>">
                                Edit
                            </button>
                            <a href="app/controller/CourseController.php?del=<?= $course->getId() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Delete</button>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editar><?= $course->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="app/controller/CourseController.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Name</label>
                                                <input type="text" name="name" value="<?= $course->getName() ?>" class="form-control" require />
                                            </div>
                                            <div class="col-md-7">
                                                <label>Start Date</label>
                                                <input type="date" name="startDate" value="<?= $course->getStartDate() ?>" class="form-control" require />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>End Date</label>
                                                <input type="date" name="endDate" value="<?= $course->getEndDate() ?>" class="form-control" require />
                                            </div>
                                            <div class="col-md-3">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <?php if ($course->getStatus() == 'A') : ?>
                                                        <option value="A">Active</option>
                                                        <option value="I">Inactive</option>
                                                    <?php else : ?>
                                                        <option value="I">Inactive</option>
                                                        <option value="A">Active</option>
                                                    <?php endif ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <br>
                                                <input type="hidden" name="id" value="<?= $course->getId() ?>" />
                                                <button class="btn btn-primary" type="submit" name="edit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once './includes/footer.php'; ?>