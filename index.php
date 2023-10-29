<?php
include_once __DIR__.'../libs/helpers.php';

if (isset($_SESSION['loggedin'])) {
  view('course.php', ['title' => 'Couse']);
}else {
}
