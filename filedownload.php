<?php

include "session.php";

$number = $_GET['num'];
$file_upload = $_GET['file'];

$conn = mysqli_connect("localhost", "root", "(password)", "board");
if(!$conn) echo "DB not connect";

$query = "SELECT file_save FROM file_list WHERE board_num=$number AND file_upload='$file_upload';";
$result = mysqli_query($conn, $query);
echo $query."<br>";

if($result){

	if($row = mysqli_fetch_array($result)){
		$file_save = $row['file_save'];
	}else{
		echo '-1';
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
