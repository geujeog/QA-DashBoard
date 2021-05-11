<?php
include 'session.php';
?>

<html>
<head>
<title>Write Document</title>
</head>
<body>
	<form action='writeDocument_check.php' method='post' enctype='multipart/form-data'>
		<p> Title : <input type='text' name='title'/> 
		<p> Contents : <input type='text' name='content'/>
		<p> File Upload : <input type='file' name='file[]' multiple/>
		<p> secret <input type='checkbox' name='secret' value='true'> <input type='password' name='passwd' placeholder='password can be used only four digits.'>
		<p> <input type='submit' value='submit'>
	</form>

</body>
</html>
