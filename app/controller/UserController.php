<?php
include_once '../model/User.php';
include_once '../dao/UserDAO.php';

$user = new User();
$userDao = new UserDAO();

$d = filter_input_array(INPUT_POST);

if (isset($_POST['create'])) {
  $user->setName($d['name']);
  $user->setUsername($d['username']);
  $user->setPassword($d['password']);

  $userDao->create($user);
  header("Location: ../../");
} elseif (isset($_POST['edit'])) {
  $user->setId($d['id']);
  $user->setName($d['name']);
  $user->setUsername($d['username']);
  $user->setPassword($d['password']);
  $userDao->update($user);
  header("Location: ../../");
} elseif (isset($_GET['del'])) {
  $user->setId($_GET['del']);
  $userDao->delete($user);
  header("Location: ../../");
} else {
  header("Location: ../../");
}
