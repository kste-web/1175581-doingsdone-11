<?php
$con = mysqli_connect('localhost', 'root', '', 'doingsdone');
mysqli_set_charset($con, "utf8");

if (!$con) {
	$error = mysqli_connect_error();
	$content = include_template('error.php', ['error' => $error]);
}