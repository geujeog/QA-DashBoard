<?php
include "session.php";
include "db.php";

$flag = 0;

$com_num = $_POST['number'];
$session = $_SESSION['session_id'];

$query = "SELECT * FROM comment_list WHERE num='$com_num';";
$result = mysqli_query($conn, $query);
if($row = mysqli_fetch_array($result)){
	$com_user = $row['user'];
	$comment = $row['comment'];
}else{
	$flag = 1;
}

if($session != $com_user){
	$flag = 1;
}



if($flag == 0){

?>

<html>
<head>
	<title>Modify Comment</title>
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
	<h3 style='font-size:30px; text-align: center; border: 3px solid gold; border-radius:0.4em; '>&nbsp; Modify Comment Page &nbsp;</h3>	
	<form action='modifyComment_check.php' method='POST'>
		<table>
		<tr><td> <input type='hidden' name='number' value="<?php echo $com_num; ?>" /> </td></tr>
		<tr>
		  <td> <textarea name='content' style='font-size: 18px; height: 100px; width: 450px;'><?php echo $comment; ?></textarea> </td>
		  <td> <input type='submit' value='submit' style='font-size: 17px;'/> </td>
		</tr>
		</table>
	</form>
	</div>
</body>
</html>


<?php

}
else{
	include "fail.php";
}

?>
