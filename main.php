<html>
<head>
<title>Board Main</title>

<style>
body{
	height: 250px;
	display: flex;
	justify-content: center;
	align-items: center;
}

</style>
</head>
<body>
	<div style='font-size:30px;'>Main Page</div><br>

	<div>
		<div style='font-size:20px;'><a href="./signUp.php">JOIN</a><div>
		<br>
		<div style='font-size:20px;'><a href="./login.php">LOGIN</a></div>
	</div>

<?php
	session_start();
	$session = $_SESSION['session_id'];

	if(isset($session)){
?>
	<a href='./board.php'>BOARD</a>
<?php
	}
?>

</body>
</html>
