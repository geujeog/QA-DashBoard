<html>
<head></head>
<body>
<div style='display:none;'>
	<form action='board_result.php' id='empty_form' method='POST'>
		<input type="text" name="board_number" value='-1'>
	</form>
</div>
</body>
</html>

<?php
session_start();

if(!isset($_SESSION['session_id'])){
	echo "<script> alert('Please log in.'); </script>";
	echo "<script> document.getElementById('empty_form').submit(); </script>";
}

?>
