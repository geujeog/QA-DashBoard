<?php
include 'session.php';

//error_reporting( E_ALL );
//ini_set( "display_errors", 1 );

$number = $_POST['number'];
$num = $number;
$title = $_POST['title'];
$content = $_POST['content'];
$session = $_SESSION['session_id'];

$flag = 0;

$secret = $_POST['secret'];
$passwd = preg_replace("/\s+/", "", $_POST['passwd']);


if(!empty($secret) && $secret == "true"){

	if(!empty($passwd)){
		if(!preg_match("/[0-9]{2}/", $passwd)){
			$flag = 1;
		}
	}else{
		$flag = 1;
	}
}
else if(empty($secret)){
	$secret = 'false';
	$passwd = '';
}
else{
	$flag = 1;
}

#if open
if($flag != 1){

$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

$query = "SELECT * FROM board_list WHERE num='$number';";
$result = mysqli_query($conn, $query);
if($row = mysqli_fetch_array($result)){
	$user = $row['user'];
}else{
	$flag = 1;
}

if($flag != 1){
if($session == $user){
	$query = "UPDATE board_list SET title='$title', content='$content', secret=$secret, passwd='$passwd' WHERE num=$number;";
	$result = mysqli_query($conn, $query);
	if(!$result){
		$flag = 1;
	}

	if($flag != 1){
		include "fileupload.php";
	}

}else{
	$flag = 1;
}
}
} #if close

if($flag == 0){
	include 'success.php';
}else{
	include 'fail.php';
}



?>
