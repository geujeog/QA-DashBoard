<?php
$flag = 0;

include "session.php";
include "db.php";

$number = $_POST['number'];

$query = "SELECT * FROM board_list WHERE num='$number';";
$result = mysqli_query($conn, $query);
if($row = mysqli_fetch_array($result)){
	$user = $row['user'];
}else{
	$flag = 1;
}

if($user != $session){
	$flag = 1;
}else{
	$query = "delete  from board_list where num='$number';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		$flag = 1;
	}
}

if($flag == 0){
	include "success.php";
}else{
	include "fail.php";
}

?>
