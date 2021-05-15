<?php
include "session.php";
include "db.php";

$flag = 0;

$number = $_POST['number'];
$session = $_SESSION['session_id'];

$query = "SELECT * FROM board_list WHERE num='$number';";
$result = mysqli_query($conn, $query);
if($row = mysqli_fetch_array($result)){
	$user = $row['user'];
	$title = $row['title'];
	$content = $row['content'];
	$secret = $row['secret'];
	$passwd = $row['passwd'];
}else{
	$flag = 1;
}

if($session != $user){
	$flag = 1;
}



if($flag == 0){

?>

<html>
<head>
	<title>Modify Document</title>
</head>
<style>
body{
	height: 250px;
	display: flex;
	justify-content: center;
	align-items: center;
}	
</style>
<body>
	
	<div style='width: 500px;'>
	<br><br><br><br><br><br><br><br>
	<h3 style='font-size:30px; text-align: center; border: 3px solid gold; border-radius:0.4em; '>&nbsp; Modify Document Page &nbsp;</h3>
	<div>
	<form action='modifyDocument_check.php' method='POST'>
		<table>
		<tr><td><input type='hidden' name='number' value="<?php echo $number; ?>" /> </td></tr>
		<tr><td><textarea name='title' style='width: 400px; height: 30px; font-size: 18px;'><?php echo $title; ?></textarea></td></tr>
		<tr><td><textarea name='content' style='width: 400px; height: 90px; font-size: 18px; '><?php echo $content; ?></textarea> </td></tr>
		<tr style='font-size: 18px;'><td> <br>File Upload : <input type='file' name='file[]' multiple> </td></tr>
	
<?php
	if($secret == '1'){
?>
		<tr style='font-size: 18px;'><td> secret <input type='checkbox' name='secret' value='true' checked></tr></td>
<?php 
	}else{
?>
		<tr style='font-size: 18px;'><td> secret <input type='checkbox' name='secret' value='true'></tr></td>
<?php
	}
?>
		<tr style='font-size: 18px;'><td> <input type='password' name='passwd' placeholder='password can be used only four digits.'> </td></tr>
		</table>
		<p> <input type='submit' value='submit' style='font-size: 17px; '/>
	</form>
	</div>
	</div>
</body>
</html>


<?php

}
else{
	include "fail.php";
}

?>
