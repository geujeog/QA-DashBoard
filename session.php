<?php
session_start();
$session = $_SESSION['session_id'];

if(!isset($_SESSION['session_id'])){

	if(isset($num)){
		echo "<script> alert('Please login.'); </script>";
		$num = -1;
	}
	else if(isset($flag)){
		echo "<script> alert('Please login.'); </script>";
		$flag = -1;
	}
}
?>
