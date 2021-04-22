<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$id = $_POST['id'];
$pw = $_POST['passwd'];

$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

// ID Check
$query = "SELECT id FROM board_member WHERE ID='$id';";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)){
	$userid = $row['id'];

	if($userid == $id){
		echo "<script> alert('Already exists ID.'); </script>";
		echo "<script> window.location.replace('./board_join_fail.php');  </script>";
		exit(0);
	}
}



// PW Check
if(strlen($pw) < 9){
	echo "<script> alert('Password must be at least 9 characters.'); </script>";
	echo "<script> history.back(); </script>";
}


if(!preg_match("/^(?=.*[a-zA-z])(?=.*[0-9])(?=.*[$`~!@$!%*#^?&\\(\\)\-_=+]).{8,16}$/", $pw)){
	echo "<script> alert('Password must contain at least one English, number and special character.'); </script>";
	echo "<script> window.location.replace('./board_join_fail.php'); </script>";
}
else{
	$query = "INSERT INTO board_member (id, pw) VALUES('$id', '$pw');";
	mysqli_query($conn, $query);
	echo "<script> alert('Join complete'); </script>";
	echo "<script> window.location.replace('./board_join_success.php'); </script>";
}
 
?>
