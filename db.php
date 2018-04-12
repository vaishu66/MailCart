<?php
if($_POST['action'] == 'adduser') {
	require_once('connection.php');
	session_start();

	$email = $_POST['email'];
	$name = $_POST['fname'].$_POST['lname'];
	$gender = $_POST['gender'];
	$alt_email = $_POST['alt_email'];
	$passwd = $_POST['passwd'];
	$query = "insert into user values('$email', '$passwd')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$query = "insert into registerUser values('$email', '$name', '$gender', '$alt_email')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$_SESSION['user'] = $email;
	$_SESSION['user_name'] = $name;
	$query = "select * from registerUser";
	$val = mysqli_query($db, $query);
	if(!$val) 
		die('Could not get data');
	header("Content-type:application/json");
	$resString = "{\"Success\": \"True\"}";
	echo $resString;
	mysqli_close($db);

}
if($_POST['action'] == 'addLevel2') {
	require_once('connection.php');
	$currentUser = $_POST['currentUser'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$query = "insert into level2 values('$currentUser', '$question', '$answer')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
}
if($_POST['action'] == 'addLevel3') {
	require_once('connection.php');
	$currentUser = $_POST['currentUser'];
	$string = $_POST['string'];
	$query = "insert into level3 values ('$currentUser', '$string')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
}

?>
	
