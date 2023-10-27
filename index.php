<?php
// var_dump($_SESSION);exit;
  // header('Location: ./app/views/course.php');
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
	header('Location: ./app/views/course.php');
}else {
  header('Location: ./app/views/login.php');
}
