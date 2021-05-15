<?php
include "session.php";
include "db.php";

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

<style>
body{
width: 500px;
margin: 0 auto;
}

a{ text-decoration: none; }
</style>

<body>
<br><br>
<h2 style='font-size: 30px; text-align: center; border: 3px solid gold; border-radius:0.4em; '>Board</h2>
<form action='writeDocument.php' style='aling: right;'>
	<input type='submit' value='write'>
</form>

<?php
$pp = 0;
while($row = mysqli_fetch_array($result)){
	$pp++;
	$number = $row['num'];
	$title = $row['title'];
?>

	<span><?php echo $pp; ?></span> &nbsp;&nbsp;&nbsp;<a id='title_<?php echo $number; ?>' href='document.php?number=<?php echo $number; ?>'><?php echo $title; ?></a>
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
