<?php 
include_once '../connection/connection.php';
include_once '../model/Course.php';
include_once '../dao/CourseDAO.php';

$course = new Course();
$courseDao = new CourseDAO();


$d = filter_input_array(INPUT_POST);

if (isset($_POST['create'])) {
  $course->setName($d['name']);
  $course->setEndDate($d['endDate']);
  $course->setStartDate(date('Y-m-d', strtotime($d['startDate'])));
  $course->setStatus($d['status']);

  $courseDao->create($course);
  header("Location: ../../");

} elseif (isset($_POST['edit'])) {
  $course->setId($d['id']);
  $course->setName($d['name']);
  $course->setEndDate($d['endDate']);
  $course->setStartDate($d['startDate']);
  $course->setStatus($d['status']);

  $courseDao->update($course);
  header("Location: ../../");

} elseif (isset($_GET['del'])) {
  $course->setId($_GET['del']);


  $courseDao->delete($course);
  header("Location: ../../");
} else {
  header("Location: ../../");
}