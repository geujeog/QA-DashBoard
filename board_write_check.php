<?php
include 'session.php';

$title = $_POST['title'];
$content = $_POST['content'];
$user = $_SESSION['session_id'];
 
$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

// ID Check
$query = "INSERT INTO board_list(title, content, user) VALUES ('$title', '$content', '$user')";

$result = mysqli_query($conn, $query);
if(!$result){
	echo "<script> alert('write fail'); history.back(); </script>";
}

$num = mysql_insert_id();
$query = "SELECT * FROM board_list WHERE num=$num";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_assoc($result);
	$title = $row['title'];
	$content = $row['content'];
}

?>
<html>
<head></head>
<body>
<div style='display:none;'>
	<form action='board_result.php' id='result_form' method='POST'>
	<input type="text" name="board_number" value='<?php echo $num ?>' />
	<input type="text" name="title" value='<?php echo $title ?>' />
	<input type="text" name="content"value='<?php echo $content?>' />
	</form>
</div>
</body>

<?php
echo "<script> document.getElementById('result_form').submit(); </script>";

?>
