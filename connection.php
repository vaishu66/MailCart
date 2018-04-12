<?php

global $connect;
$username = 'root';
$password = 'root';
$db = new mysqli('localhost', $username, $password, 'mail');

if ($db->connect_error) {
	$message = $db->connect_error;
	$connect = false;
}
else
	$connect = true;
?>
