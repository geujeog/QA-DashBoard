<?php
include 'session.php';
?>

<html>
<head>
<title>Write Document</title>
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
	<br><br><br><br><br><br>
	<h3 style='font-size:30px; text-align: center; border: 3px solid gold; border-radius:0.4em; '>&nbsp; Write Document Page &nbsp;</h3>
	<form action='writeDocument_check.php' method='post' enctype='multipart/form-data'>
		<p style='font-size: 19px;'> Title : <input type='text' name='title'/> 
		<p style='font-size: 19px;'> Contents : <input type='text' name='content'/>
		<p style='font-size: 18px;'> File Upload : <input type='file' name='file[]' multiple/>
		<p style='font-size: 18px;'> secret <input type='checkbox' name='secret' value='true'> <input type='password' name='passwd' placeholder='password can be used only four digits.'>
		<p> <input type='submit' value='submit' style='font-size: 17px;'>
	</form>
	</div>
</body>
</html>
