<?php
include "session.php";

$com_num = $_POST['number'];

$flag = 0;

$conn = mysqli_connect("localhost", "root", "(password)", "board");
if(!$conn) echo "DB not connect";

$query = "SELECT * FROM comment_list WHERE num='$com_num';";
$result = mysqli_query($conn, $query);
if($row = mysqli_fetch_array($result)){
	$com_user = $row['user'];
}else{
	$flag = 1;
}

if($com_user != $session){
	$flag = 1;
}else{
	$query = "delete from comment_list where num='$com_num';";
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
