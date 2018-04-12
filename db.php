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
if($_POST['action'] == 'checkLogin') {
	require_once('connection.php');
	session_start();
	$email = $_POST['email'];
	$passwd = $_POST['passwd'];
	$qry = "select name from registerUser where email_id = '$email'";
	$result = mysqli_query($db, $qry);
	if($result === false)
		die("Query $qry returned false!");
	$row1 = mysqli_fetch_row($result);
	$_SESSION['user_name'] = $row1[0];
	$query = "select * from user where email_id = '$email' and password = '$passwd'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$_SESSION['user'] = $email;
	$all_rows = array();
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
		$all_rows[] = $row;
	header("Content-type:application/json");
	echo json_encode($all_rows);
	mysqli_close($db);
}
if($_POST['action'] == 'getQuestion'){
	require_once('connection.php');
	$currentUser = $_POST['currentUser'];
	$query = "select question from level2 where email_id = '$currentUser'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$row = mysqli_fetch_row($res);
	header("Content-type:application/json");
	echo json_encode($row);
	mysqli_close($db);
}
if($_POST['action'] == 'checkLevel2') {
	require_once('connection.php');
	$currentUser = $_POST['currentUser'];
	$answer = $_POST['answer'];
	$query = "select * from level2 where email_id = '$currentUser' and answer = '$answer'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$all_rows = array();
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
		$all_rows[] = $row;
	header("Content-type:application/json");
	echo json_encode($all_rows);
	mysqli_close($db);
}
if($_POST['action'] == 'checkLevel3') {
	require_once('connection.php');
	$currentUser = $_POST['currentUser'];
	$string = $_POST['string'];
	$query = "select * from level3 where email_id = '$currentUser' and color_pattern = '$string";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$all_rows = array();
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
		$all_rows[] = $row;
	header("Content-type:application/json");
	echo json_encode($all_rows);
	mysqli_close($db);
}


?>
	
