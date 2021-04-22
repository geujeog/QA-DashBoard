<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_POST['id'];
$pw = $_POST['passwd'];

$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

// ID Check
$query = "SELECT * FROM board_member WHERE ID='$id';";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)){
	$userpw = $row['pw'];

	//echo $userpw;

	if($userpw == $pw){
		echo "<script> alert('Login Success'); </script>";
		echo "<script> window.location.replace('./board_login_success.php');  </script>";
	}
	else{
		echo "<script> alert('Login Fail'); </script>";
		echo "<script> window.location.replace('./board_login_fail.php'); </script>";
	}
}


?>
