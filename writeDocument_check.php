<?php
include 'session.php';

$num = 0;

$title = $_POST['title'];
$content = $_POST['content'];
$user = $_SESSION['session_id'];
$time = date("Y-m-d H:i:s");
$secret = $_POST['secret'];
$passwd = preg_replace("/\s+/", "", $_POST['passwd']);


if(!empty($secret) && $secret == "true"){

	if(!empty($passwd)){
		if(!preg_match("/[0-9]{2}/", $passwd)){
			$num = -1;
		}
	}else{
		$num = -1;
	}
}
else if(empty($secret)){
	$secret = 'false';
	$passwd = '';
}
else{
	$num = -1;
}

#if open
if($num != -1){
	
$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";


// DB store
$query = "INSERT INTO board_list(title, content, user, time, secret, passwd) VALUES ('$title', '$content', '$user', '$time', $secret, '$passwd')";

$result = mysqli_query($conn, $query);
if(!$result){
	$num = -1;
}
else{
	$query = "SELECT * FROM board_list WHERE title='$title' AND time='$time';";
	$result = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		$num = $row['num'];
	}
	else{
		$num = -1;
	}

	include "fileupload.php";
}

} #if close
 
?>

<html>
<head>
	<title>Write Document Result</title>
</head>
<body>
	<div id='number'> <?php echo $num; ?> </div>
</body>
</html>
