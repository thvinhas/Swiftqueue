<?php
include_once '../model/User.php';
include_once '../dao/UserDAO.php';
include_once '../../libs/helpers.php';
session_start();

$user = new User();
$userDao = new UserDAO();
$d = filter_input_array(INPUT_POST);

if (isset($_POST['create'])) {
  $user->setName($d['name']);
  $user->setUsername($d['username']);
  $user->setPassword($d['password']);

  if ($userDao->create($user)) {
    redirect_to(
      'user.php',
    );
  }
} elseif (isset($_POST['edit'])) {
  $user->setId($d['id']);
  $user->setName($d['name']);
  $user->setUsername($d['username']);
  $user->setPassword($d['password']);
  if ($userDao->update($user)) {
    redirect_to(
      'user.php',
    );
  }
} elseif (isset($_GET['del'])) {
  $user->setId($_GET['del']);
  if ($userDao->delete($user)) {
    if (is_user_logged_in()) {
      unset($_SESSION['loggedin'], $_SESSION['id']);
      session_destroy();

      redirect_to(
        'login.php',
      );
    } else {
      redirect_to(
        'user.php',
      );
    }
  }
} elseif (isset($_POST['Login'])) {

  $user = $userDao->findUser($d['username']);
  if (password_verify($d['password'], $user['password'])) {

    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $user['name'];
    $_SESSION['id'] = $user['id'];
    redirect_to(
      'course.php',
    );
  } else {
    // Incorrect password
    echo 'Incorrect username and/or password!';
  }
} elseif (isset($_POST['Logout'])) {

  if (is_user_logged_in()) {
    unset($_SESSION['loggedin'], $_SESSION['id']);
    session_destroy();

    redirect_to(
      'login.php',
    );
  }
} else {
  header("Location: ../../");
}

function is_user_logged_in(): bool
{
  return isset($_SESSION['loggedin']);
}
