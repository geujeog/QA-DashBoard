<?php
include "session.php";
include "db.php";

$number = $_GET['number'];
$flag = 0;

$query = "SELECT * FROM board_list WHERE num='$number';";
$result = mysqli_query($conn, $query);
if($result){
	if($row = mysqli_fetch_array($result)){
		$secret = $row['secret'];
	}
}else{
	$flag = 1;
}

if($flag == 0){
	if($secret == 0){
	echo $secret;

?>

<html>
<head>
	<!--<meta http-equiv="refresh" content="0; url='document.php?number=<?php echo $number;?>'">-->
</head>
<body>
<?php
	}else{
?>
	<!--<form action='docuent.php?number=<?php echo $number; ?>' method='post'>
		<input type='password' name='passwd' />
		<input type='submit' value='submit' />
	</form>-->
<?php
	}
}
?>
</body>
</html>
