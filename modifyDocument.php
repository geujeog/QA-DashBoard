<?php
include "session.php";

$flag = 0;

$number = $_POST['number'];
$session = $_SESSION['session_id'];

$conn = mysqli_connect("localhost", "root", "(password)", "board");
if(!$conn) echo "DB not connect";

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
<body>
	<form action='modifyDocument_check.php' method='POST'>
		<table>
		<tr><td> <input type='hidden' name='number' value="<?php echo $number; ?>" /> </td></tr>
		<tr><td> <textarea name='title'><?php echo $title; ?></textarea> </td></tr>
		<tr><td> <textarea name='content'><?php echo $content; ?></textarea> </td></tr>
		<tr><td> File Upload : <input type='file' name='file[]' multiple> </td></tr>
	
<?php
	if($secret == '1'){
?>
		<tr><td> secret <input type='checkbox' name='secret' value='true' checked></tr></td>
<?php 
	}else{
?>
		<tr><td> secret <input type='checkbox' name='secret' value='true'></tr></td>
<?php
	}
?>
		<tr><td> <input type='password' name='passwd' placeholder='password can be used only four digits.'> </td></tr>
		</table>
		<p> <input type='submit' value='submit' />
	</form>

</body>
</html>


<?php

}
else{
	include "fail.php";
}

?>
