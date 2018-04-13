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
if($_POST['action'] == 'load') {
	require_once('connection.php');
	
	session_start();
	$currentUser = $_SESSION['user'];
	$query = "select * from inbox where to_id = '$currentUser' and trash = 0";
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
if($_POST['action'] == 'sentMails') {
	require_once('connection.php');
	
	session_start();
	$currentUser = $_SESSION['user'];
	$query = "select * from inbox where from_id = '$currentUser' and draft = 0";
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
if($_POST['action'] == 'drafts') {
	require_once('connection.php');
	
	session_start();
	$currentUser = $_SESSION['user'];
	$query = "select * from inbox where from_id = '$currentUser' and draft = 1";
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
if($_POST['action'] == 'trash') {
	require_once('connection.php');
	
	session_start();
	$currentUser = $_SESSION['user'];
	$query = "select * from inbox where to_id = '$currentUser' and trash = 1";
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
if($_POST['action'] == 'logout') {
	unset($_SESSION);
	session_destroy();
	session_write_close();
}
if($_POST['action'] == 'getMessage') {
	require_once('connection.php');
	$id = $_POST['id'];
	//$qry = "update table inbox set unread = 1 where id = '$id'";
	//$result = mysqli_query($db, $qry);
	//if($result === false)
	//	die("Query $qry returned false!");
	$query = "select * from inbox where id = '$id'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$row = mysqli_fetch_row($res);
	header("Content-type:application/json");
	echo json_encode($row);
	mysqli_close($db);
}
/*if($_POST['action'] == 'send') {
	require_once('connection.php');
	
	session_start();
	$to = $_POST['to'];
	$bcc = $_POST['bcc'];
	$subject = $_POST['subject'];
	$body = $_POST['body'];
	$attach = $_POST['attach'];
	$draft = $_POST['draft'];
	$trash = 0;
	$unread = 0;
	$archive = 0;
	$from = $_SESSION['user'];
	$from_name = $_SESSION['user_name'];
	$rec_date = date('Y-m-d');
	$rec_time = date("H:i:s");
	$query = "insert into inbox(to_id, from_id, subject, body, attach, trash, draft, archive, unread, from_name, rec_date, rec_time) values('$to', '$from', '$subject', '$body', $attach, $trash, $draft, $archive, $unread,'$from_name', '$rec_date', '$rec_time')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	mysqli_close($db);

}*/
if($_POST['action'] == 'deleteMail') {
	require_once('connection.php');
	$id = $_POST['id'];
	$query = "update inbox set trash = 1 where id = '$id'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
}
if($_POST['action'] == 'getFile') {
	require_once('connection.php');
	$id = $_POST['id'];
	$query = "select fileName from inbox where id = '$id'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$row = mysqli_fetch_row($res);
	$filename = $row[0];
	header("Location: login.php");	
	/*$path = 'uploads/'.$filename;
	
	if (file_exists($path) && is_readable($path)) {
	
		$size = filesize($path);
		header('Content-Type: application/octet-stream');
		header('Content-Length: '.$size);
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		$file = @ fopen($path, 'rb');
		if ($file)
		fpassthru($file);
		mysqli_close($db);
	}*/
}
if($_POST['action'] == 'checkContact') {
	require_once('connection.php');
	session_start();
	$id = $_POST['contact_id'];
	$user_id = $_SESSION['user'];
	$query = "select * from contacts where user_id = '$user_id' and contact_id = '$id'";
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
if($_POST['action'] == 'addContact') {
	require_once('connection.php');
	session_start();
	$id = $_POST['contact_id'];
	$user_id = $_SESSION['user'];
	
	$query = "insert into contacts(user_id, contact_id) values('$user_id', '$id')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
		mysqli_close($db);
	
}
if($_POST['action'] == 'displayContacts') {
	require_once('connection.php');
	session_start();
	$user_id = $_SESSION['user'];
	$query = "select * from contacts where user_id = '$user_id'";
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
if($_POST['action'] == 'setId') {
	require_once('connection.php');
	$id = $_POST['id'];
	$query = "select * from contacts where id = '$id'";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	$row = mysqli_fetch_row($res);
	header("Content-type:application/json");
	echo json_encode($row);
	mysqli_close($db);
}
if($_POST['action'] == 'search_name') {
	require_once('connection.php');

	session_start();
	$currentUser = $_SESSION['user'];
	$val = $_POST['val'];
	$type = $_POST['folder'];
	if($type == 'inbox')
		$query = "select * from inbox where to_id = '$currentUser' and from_name = '$val' and trash = 0";
	else if($type == 'sent')
		$query = "select * from inbox where from_id = '$currentUser' and from_name = '$val' and draft = 0";
	else if($type == 'drafts')
		$query = "select * from inbox where from_id = '$currentUser' and from_name = '$val' and draft = 1";
	else if($type == 'trash')
		$query = "select * from inbox where to_id = '$currentUser' and from_name = '$val' and trash = 1";
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
if($_POST['action'] == 'search_subject') {
	require_once('connection.php');

	session_start();
	$currentUser = $_SESSION['user'];
	$val = $_POST['val'];
	$type = $_POST['folder'];
	if($type == 'inbox')
		$query = "select * from inbox where to_id = '$currentUser' and subject = '$val' and trash = 0";
	else if($type == 'sent')
		$query = "select * from inbox where from_id = '$currentUser' and subject = '$val' and draft = 0";
	else if($type == 'drafts')
		$query = "select * from inbox where from_id = '$currentUser' and subject = '$val' and draft = 1";
	else if($type == 'trash')
		$query = "select * from inbox where to_id = '$currentUser' and subject = '$val' and trash = 1";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $type returned false!");
	$all_rows = array();
	while($row = mysqli_fetch_array($res, MYSQLI_ASSOC))
		$all_rows[] = $row;
	header("Content-type:application/json");
	echo json_encode($all_rows);
	mysqli_close($db);
}
?>	
