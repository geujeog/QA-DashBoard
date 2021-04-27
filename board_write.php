<?php
include 'session.php';
?>

<html>
<head>
<title>Board Write</title>
</head>
<body>
	<form action='board_write_check.php' method='POST'>
		<p> Title : <input type='text' name='title'> 
		<p> Contents : <input type='text' name='content'>
		<p> <input type='submit' value='submit'>
	</form>

</body>
</html>
