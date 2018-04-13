
<?php
if(!(is_uploaded_file())) {
	require_once('connection.php');
	
	session_start();
	$to = $_POST['inputEmail1'];
	$bcc = $_POST['bcc'];
	$subject = $_POST['subject'];
	$body = $_POST['msg'];
	$attach = 0;
	if($to == "")
		$draft = 1;
	else
		$draft = 0;
	$trash = 0;
	$unread = 0;
	$archive = 0;
	$from = $_SESSION['user'];
	$from_name = $_SESSION['user_name'];
	$rec_date = date('Y-m-d');
	$rec_time = date("H:i:s");
	$query = "insert into inbox(to_id, from_id, subject, body, attach, trash, draft, archive, unread, from_name, rec_date, rec_time, fileName) values('$to', '$from', '$subject', '$body', $attach, $trash, $draft, $archive, $unread,'$from_name', '$rec_date', '$rec_time', '')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	mysqli_close($db);
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	require_once('connection.php');
	
	session_start();
	$fileName = $_FILES["fileToUpload"]["name"];
	$to = $_POST['inputEmail1'];
	$bcc = $_POST['bcc'];
	$subject = $_POST['subject'];
	$body = $_POST['msg'];
	$attach = 1;
	if($to == "")
		$draft = 1;
	else
		$draft = 0;
	$trash = 0;
	$unread = 0;
	$archive = 0;
	$from = $_SESSION['user'];
	$from_name = $_SESSION['user_name'];
	$rec_date = date('Y-m-d');
	$rec_time = date("H:i:s");
	$query = "insert into inbox(to_id, from_id, subject, body, attach, trash, draft, archive, unread, from_name, rec_date, rec_time, fileName) values('$to', '$from', '$subject', '$body', $attach, $trash, $draft, $archive, $unread,'$from_name', '$rec_date', '$rec_time','$fileName')";
	$res = mysqli_query($db, $query);
	if($res === false)
		die("Query $query returned false!");
	mysqli_close($db);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

header("Location: main.php");
?>

