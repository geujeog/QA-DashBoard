<?php
$flag = 0;
include "session.php";
include "db.php";

$number = $_GET['number'];
$input_passwd = $_POST['passwd'];
$comment = $_POST['content'];
$show = 0;


// echo("number: $number");
if($flag != -1){
$query = "SELECT * FROM board_list WHERE num='$number';";
$result = mysqli_query($conn, $query);
if($result){
	if($row = mysqli_fetch_array($result)){
		$title = $row['title'];
		$content = $row['content'];
		$user = $row['user'];
		$secret = $row['secret'];
		$passwd = $row['passwd'];
	}else{
		$flag = -1;
	}
}else{
	$flag = -1;
}
}
// echo("flag: $flag");


if($flag != -1){

	// Secret Exist
	if($secret == 1){

		// Password doesn't Exist
		if(!isset($input_passwd)){
?>

<html>
<head>
	<title>Document</title>
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
	<form action='document.php?number=<?php echo $number; ?>' method='post'>
	Password : <input type='password' name='passwd' >
	<input type='hidden' name='content' value='<?php echo $comment;?>'>
	<input type='submit' value='submit' >
	</form>

<?php 
		}else{ // password Exist

			// correct
			if($passwd == $input_passwd){
				$show = 1;
			}else{ // fail
				$flag = -1;
			}
		}
	}else{
		$show = 1;
	}
}

if($flag == 0 && $show == 1){

	if(!empty($comment)){
		$time = date("Y-m-d H:i:s");
		$query = "INSERT INTO comment_list(board_num, user, comment, time) VALUES ('$number', '$session', '$comment', '$time');";
		$result = mysqli_query($conn, $query);

		if(!$result){
			$flag = -1;
		}
	}

?>
	<br><br><br>
	<div style='width: 500px; margin: 0 auto;'>
	<h3 style='font-size:30px; text-align: center; border: 3px solid gold; border-radius:0.4em; margin: 0 auto; '>&nbsp; <?php echo $number; ?> &nbsp;</h3><br>
	<div style='margin: 0 auto; font-size: 18px;'> TITLE | &nbsp;&nbsp;<span id='title' class='c' style='font-size: 20px;'><?php echo $title; ?></span></div><br>
	<div style='margin: 0 auto; font-size: 18px;'> CONTENT | &nbsp;&nbsp;<span id='content' class='c' style='font-size: 20px; '><?php echo $content; ?></span></div><br>
	<div style='margin: 0 auto; font-size: 17px;'> FILE | 

<script>
	function download(formId) {
		var form = document.getElementById(formId);
		form.submit();
	}
</script>
<?php
	$query = "SELECT * from file_list where board_num=$number;";
	$result = mysqli_query($conn, $query);

	while($row = mysqli_fetch_array($result)){
		$file_upload = $row['file_upload'];
		$file_save = $row['file_save'];

		$tmp_file = "./upload/".$file_save;

		if(file_exists($tmp_file)){

?>

	<div style='display:none'>
		<form id='form_<?php echo $file_upload; ?>' action='fileDownload.php' method='GET'>
				<input type='hidden' value='<?php echo $number; ?>' name='number' />
				<input type='hidden' value='<?php echo $file_upload; ?>' name='file'>
		</form>
	</div>
	<a href="javascript:download('form_<?php echo $file_upload; ?>');"><span id='file_<?php echo $file_upload; ?>'><?php echo $file_upload;?></span></a>

<?
		}else{
			$flag = -1;
		}
	}


	if($flag != -1){
		if($session == $user){
?>
	<br><br>
	<div>
	<form method='POST'>
		<div style='display:none;'><input name='number' value='<?php echo $number;?>' > </div>
		<div>
			<button type="submit" formaction='modifyDocument.php'>Modify</button>
			<button type="submit" formaction='deleteDocument_check.php'>Delete</button>
		</div>
	</form>
	</div>

<?php
		}
	}
?>
	</div>
<br><hr><br>

	<form action='document.php?number=<?php echo $number; ?>' method='post'>
		<div> 
		comment : <input type='text' name='content' />
		<input type='submit' value='submit'/>
		</div>
	</form>
<?php

	$query = "SELECT * FROM comment_list WHERE board_num='$number' ORDER BY num DESC;";
	$result = mysqli_query($conn, $query);

	if(!$result){
		$flag = -1;
	}else{

	$count = 1;
	while($row = mysqli_fetch_array($result)){
		$com_num = $row['num'];
		$com_user = $row['user'];
		$com_comment = $row['comment'];
		$com_time = $row['time'];

?>

	<div> <b id='number'><?php echo $count; ?></b> <span><?php echo $com_user; ?></span> <span><?php echo $com_comment; ?></span> <span><?php echo $com_time; ?></span></div>
<?php
			if($session == $com_user){
?>
	<form method='POST'>
		<div style='display:none;'><input name='number' value='<?php echo $com_num;?>' > </div>
		<div>
			<button type="submit" formaction='modifyComment.php'>Modify</button>
			<button type="submit" formaction='deleteComment_check.php'>Delete</button>
		</div>
	</form>
<?
		}

		$count++;
	}
	}
}
if($flag == -1){
	include "fail.php";
}
?>
</div>
</body>
</html>
