<?php

$flag = 0;
$id = $_POST['id'];
$pw = $_POST['passwd'];


// Shield - BOF(maybe...)
if(strlen($id) > 25 || strlen($pw) > 25){
	echo "<script> alert('Please write less than 25 characters.'); </script>";
	echo "<script> window.location.replace('./board_join.php');  </script>";
}

// Shield - SQL Injection
//$id = addslashes(preg_replace("/\s+/", "", $id));
//$pw = addslashes(preg_replace("/\s+/", "", $pw));
$id = preg_replace("/\s+/", "", $id);
$pw = preg_replace("/\s+/", "", $pw);


$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

// ID Check
$query = "SELECT id FROM board_member WHERE ID='$id';";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)){
	$userid = $row['id'];

	// Requirement 1
	if($userid == $id){
		$flag = 1;
	}
}



// PW Check
if($flag == 0){

	// Requirement 2
	if(strlen($pw) < 9){
		$flag = 1;
	}
}

if($flag == 0){

	// Requirement 2,3
	if(!preg_match("/^(?=.*[a-zA-z])(?=.*[0-9])(?=.*[$~!@$!%*#^?&\\(\\)\-_=+]).{8,16}$/", $pw)){
		$flag = 1;
	}
	else{
		$query = "INSERT INTO board_member (id, pw) VALUES('$id', '$pw');";
		mysqli_query($conn, $query);
	}
}

if($flag == 0){
	include "success.php";
}else{
	include "fail.php";
}

?>
