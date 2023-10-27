<?php
include_once '../connection/connection.php';
include_once '../model/Course.php';
include_once '../dao/CourseDAO.php';

$course = new Course();
$courseDao = new CourseDAO();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CRUD Simples PHP</title>
    <style>
        .menu,
        thead {
            background-color: #bbb !important;
        }

        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light menu">
        <div class="container">
            <a class="navbar-brand" href="#">
                CRUD PHP POO
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="app/controller/CourseController.php" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <label>Name</label>
                    <input type="text" name="name" value="" autofocus class="form-control" require />
                </div>
                <div class="col-md-5">
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
                    <button class="btn btn-primary" type="submit" name="create">Cadastrar</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
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
                            <td><?= $course->getStatus()?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $course->getId() ?>">
                                    Editar
                                </button>
                                <a href="app/controller/CourseController.php?del=<?= $course->getId() ?>">
                                <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>