<?php
include_once '../model/Course.php';
include_once '../dao/CourseDAO.php';

$course = new Course();
$courseDao = new CourseDAO();

// include_once '../../libs/helpers.php';

include_once './inc/header.php';
?>
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Add Course</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="../controller/CourseController.php" class="form" method="POST" onsubmit="return validateForm(this)">
            <div class="row">
                <div class="col-md-3">
                    <label>Course Name</label>
                    <input type="text" name="name" value="" autofocus class="form-control" required />
                </div>
                <div class="col-md-2">
                    <label>Start Date</label>
                    <input type="date" name="startDate" value="" class="form-control" required />
                </div>
                <div class="col-md-2">
                    <label>End Date</label>
                    <input type="date" name="endDate" value="" class="form-control" required />
                </div>
                <div class="col-md-2">
                    <label>Time</label>
                    <select name="time" class="form-control">
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                        <option value="Evening">Evening</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="A">Active</option>
                        <option value="I">Inactive</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary" name="create">Submit<i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header header-elements-inline">

        <h5 class="card-title">Courses</h5>
        <div class="header-elements">
                <!-- Create the drop down filter -->
                <div class="category-filter lin">
                    <select id="categoryFilter" class="form-control">
                        <option value="">Show All</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

       
        </div>
    </div>
    <div class="card-body">

        <table class="table datatable-basic datatable-Filtered">
           
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Time</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courseDao->read() as $course) : ?>
                    <tr>
                        <td><?= $course->getId() ?></td>
                        <td><?= $course->getName() ?></td>
                        <td><?= $course->getStartDate() ?></td>
                        <td><?= $course->getEndDate() ?></td>
                        <td><?= $course->getTime() ?></td>
                        <?php if ($course->getStatus() == "A") { ?>
                            <td><span class="badge badge-success">Active</span></td>
                        <?php } else { ?>
                            <td><span class="badge badge-danger">Inactive</span></td>
                        <?php } ?>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editar<?= $course->getId() ?>">
                                Edit
                            </button>
                            <a href="../controller/CourseController.php?del=<?= $course->getId() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Delete</button>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editar<?= $course->getId() ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../controller/CourseController.php" name="editCourse" method="POST" onsubmit="return validateForm(this)">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Name</label>
                                                    <input type="text" name="name" value="<?= $course->getName() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Start Date</label>
                                                    <input type="date" name="startDate" value="<?= $course->getStartDate() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-2">
                                                    <label>End Date</label>
                                                    <input type="date" name="endDate" value="<?= $course->getEndDate() ?>" class="form-control" require />
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Time</label>
                                                    <select name="time" class="form-control">
                                                        <?php if ($course->getTime() == 'Morning') : ?>
                                                            <option value="Morning" selected>Morning</option>
                                                        <?php else : ?>
                                                            <option value="Morning" >Morning</option>
                                                        <?php endif ?>
                                                        <?php if ($course->getTime() == 'Afternoon') : ?>
                                                            <option value="Afternoon" selected>Afternoon</option>
                                                        <?php else : ?>
                                                            <option value="Afternoon" >Afternoon</option>
                                                        <?php endif ?>
                                                        <?php if ($course->getTime() == 'Evening') : ?>
                                                            <option value="Evening" selected>Evening</option>
                                                        <?php else : ?>
                                                            <option value="Evening" >Evening</option>
                                                        <?php endif ?>

                                                    </select>
                                                </div>
                                                <div class="col-md-2">
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
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $course->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="edit">Update</button>
                                                </div>
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