<?php
$flag = 0;
include 'session.php';
include "db.php";

$number = $_POST['number'];
$num = $number;
$title = $_POST['title'];
$content = $_POST['content'];
$session = $_SESSION['session_id'];

$secret = $_POST['secret'];
$passwd = preg_replace("/\s+/", "", $_POST['passwd']);

if(empty($title) || empty($content)){
	$flag = 1;
}

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
