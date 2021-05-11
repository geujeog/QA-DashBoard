<?php
include "session.php";

$flag = 0;

$com_num = $_POST['number'];
$session = $_SESSION['session_id'];

$conn = mysqli_connect("localhost", "root", "(password)", "board");
if(!$conn) echo "DB not connect";

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
<body>
	<form action='modifyComment_check.php' method='POST'>
		<table>
		<tr><td> <input type='hidden' name='number' value="<?php echo $com_num; ?>" /> </td></tr>
		<tr><td> <textarea name='content'><?php echo $comment; ?></textarea> </td></tr>
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
