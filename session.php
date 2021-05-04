<?php
session_start();
$session = $_SESSION['session_id'];

if(!isset($_SESSION['session_id'])){
	echo "<script> alert('Please login.'); </script>";
?>

	<html>
	<head>
		<title>Board</title>
	</head>
	<body>
		<div id='number'> -1 </div>
	</body>
	</html>

<?php
	exit();
}

?>
