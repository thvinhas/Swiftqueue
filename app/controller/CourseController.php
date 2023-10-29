<?php
include_once '../model/Course.php';
include_once '../dao/CourseDAO.php';
include_once '../../libs/helpers.php';

$course = new Course();
$courseDao = new CourseDAO();


$d = filter_input_array(INPUT_POST);

if (isset($_POST['create'])) {
  $course->setName($d['name']);
  $course->setTime($d['time']);
  $course->setEndDate($d['endDate']);
  $course->setStartDate(date('Y-m-d', strtotime($d['startDate'])));
  $course->setStatus($d['status']);

  if ($courseDao->create($course)) {
    redirect_to(
      'course.php',
    );
  }
} elseif (isset($_POST['edit'])) {
  $course->setId($d['id']);
  $course->setName($d['name']);
  $course->setTime($d['time']);
  $course->setEndDate($d['endDate']);
  $course->setStartDate($d['startDate']);
  $course->setStatus($d['status']);

  if ($courseDao->update($course)) {
    redirect_to(
      'course.php',
    );
  }
} elseif (isset($_GET['del'])) {
  $course->setId($_GET['del']);

  if ($courseDao->delete($course)) {
    redirect_to(
      'course.php',
    );
  }
} else {
  header("Location: ../../");
}
