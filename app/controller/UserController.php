<?php
include_once '../model/User.php';
include_once '../dao/UserDAO.php';
session_start();

$user = new User();
$userDao = new UserDAO();
// var_dump($_POST);exit;
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
} elseif (isset($_POST['Login'])) {
  // var_dump('hue');exit;

  $user = $userDao->findUser($d['username']);
  if (password_verify($d['password'], $user['password'])) {
  // var_dump('hue');exit;

    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['id'] = $user['id'];
    header("Location: ../views/login.php");
  } else {
    // Incorrect password
    echo 'Incorrect username and/or password!';
  }
}elseif (isset($_POST['Logout'])) {
  // var_dump($_SESSION);exit;
  // var_dump(is_user_logged_in());exit;
  if (is_user_logged_in()) {
    unset($_SESSION['loggedin'], $_SESSION['id']);
    session_destroy();
    // var_dump('hue');exit;
    header("Location: ../views/login.php");
}
} else {
  header("Location: ../../");
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['loggedin']);
}