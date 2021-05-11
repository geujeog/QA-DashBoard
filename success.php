<?php

$refer = $_SERVER["HTTP_REFERER"];

if($refer == 'login.php' || $refer == 'signUp.php' || $refer == 'main.php' || $refer == 'signUp_check.php' || $refer=='login_check.php'){
	$url = "main.php";
}
else if($refer == 'board.php' || $refer == 'document.php' || $refer == 'modifyDocument.php' || $refer == 'deleteDocument_check.php'){
	$url = "board.php";
}
else{
	$url = "main.php";
}

?>

<html>
<head>
	<title>Result</title>
	<meta http-equiv="refresh" content="3; url=<?php echo $url; ?>">
</head>
<body>
	<p id='result'> Success </p>
</body>
</html>

