<?php

$num = 0;

include 'session.php';
include 'db.php';

$title = $_POST['title'];
$content = $_POST['content'];
$user = $_SESSION['session_id'];
$time = date("Y-m-d H:i:s");
$secret = $_POST['secret'];
$passwd = preg_replace("/\s+/", "", $_POST['passwd']);


if(empty($title) || empty($content)){
	$num = -1;
}

$temp = $_FILES['file']['name'];
echo("\r\n<br>title a: $title");
echo("\r\n<br>content a: $content");
echo("\r\n<br>file a: $temp");
echo("\r\n<br>secret a: $secret");
echo("\r\n<br>");
if(!empty($_FILES['file']['name']) && !empty($_FILES['file']['name'][0])){
	// echo("$_FILES['file']['name']")
	$total = count($_FILES['file']['name']);
}
else{
	$total = 0;
}
// echo("total: $total")


if(!empty($secret) && $secret == "true"){

	if(!empty($passwd)){
		if(!preg_match("/[0-9]{4}/", $passwd)){
			$num = -1;
		}
	}else{
		$num = -1;
	}
}
else if(empty($secret) || $secret == "false"){
	$secret = 'false';
	$passwd = '';
}
else{
	$num = -1;
}

#if open
if($num != -1){
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

		if($num != -1){
			include "fileupload.php";
		}
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
