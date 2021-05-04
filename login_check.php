<?php

$flag = 0;
$id = addslashes($_POST['id']);
$pw = addslashes($_POST['passwd']);

$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

// ID Check
$query = "SELECT * FROM board_member WHERE ID='$id';";
$result = mysqli_query($conn, $query);
if(!$result){
	$flag = 1;
}

if($flag == 0){
	while($row = mysqli_fetch_array($result)){
		$userpw = $row['pw'];

		if($userpw == $pw){
			$id = stripslashes($id);

			session_start();
			$_SESSION['session_id'] = $id;
		}
		else{
			$flag = 1;
		}
	}
}

if($flag == 0){
	include "success.php";
}else{
	include "fail.php";
}

?>
