<?php

include "session.php";

$number = $_POST['num'];
$file_upload = $_POST['file'];

$query = "SELECT file_save FROM file_list WHERE board_num=$number AND file_upload='$file_upload'";
$result = mysqli_query($conn, $query);

$tmp_file = "./upload/".$result;

header("Content-Type: Application/octet-stream");
header("Content-Disposition: attachment; filename=".$file_upload);
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($tmp_file));

$fp = fopen($tmp_file, "rb");

if (!fpassthru($fp)){
	fclose($fp);
}

?>
