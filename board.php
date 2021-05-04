<?php
include "session.php";

$conn = mysqli_connect("localhost", "root", "spdlxm10301", "board");
if(!$conn) echo "DB not connect";

$category = $_GET['category'];
$search = $_GET['search'];

if($category=='title' && isset($search)){
	$query = "SELECT * FROM board_list WHERE title like '%$search%' ORDER BY num DESC;";
}
else if($category=='content' && isset($search)){
	$query = "SELECT * FROM board_list WHERE content like '%$search%' ORDER BY num DESC;";
}
else{
	$query = "SELECT * FROM board_list ORDER BY num DESC;";
}

$result = mysqli_query($conn, $query);
?>

<html>
<head>
	<title>Board</title>
</head>
<body>

<form action='writeDocument.php'>
	<input type='submit' value='write'>
</form>


<?php
while($row = mysqli_fetch_array($result)){
	$number = $row['num'];
	$title = $row['title'];
?>

	<a id='title_<?php echo $number; ?>' href='document.php?number=<?php echo $number; ?>'><?php echo $title; ?></a>
	<hr>
<?php

}

?>

<form action='board.php' method='GET'>
	<select name='category'>
		<option value='title'>title</option>
		<option value='content'>content</option>
	</select>
	<input type='text' name='search'>
	<input type='submit' value='submit'>
</form>


</body>
</html>
