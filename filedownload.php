<?php

include "session.php";
include "db.php";
$number = $_GET['number'];
$file_upload = $_GET['file'];

$query = "SELECT file_save FROM file_list WHERE board_num=$number AND file_upload='$file_upload';";
$result = mysqli_query($conn, $query);
// echo $query."<br>";

if($result){

	if($row = mysqli_fetch_array($result)){
		$file_save = $row['file_save'];
	}else{
		header("HTTP/2.0 404 Not Found");
		exit();
	}

	$tmp_file = "./upload/".$file_save;
	
	header("Content-Type: Application/octet-stream");
	header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$file_upload));
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($tmp_file));

	$fp = fopen($tmp_file, "rb");

	if (!fpassthru($fp)){
		fclose($fp);
	}
}

?>
