<?php

$prevPage = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);

if($total != 0){
	if($num != -1){
		for($key=0; $key<$total; $key++){
		//foreach($_FILES['file']['name'] as $key => $val){

			if($num == -1) break;
			if(!is_uploaded_file($_FILES['file']['tmp_name'][$key])){
				echo '1111';
				$num = -1;
			}

			if($num == -1) break;
			if($_FILES['file']['size'][$key] > 0 /*& $_FILES['file']['size'][$key] >= 5242880*/){
				$file_upload = $_FILES['file']['name'][$key];
				$file_tmp = explode('.', $file_upload);

				$file_type = $file_tmp[1];
				$file_save = $file_tmp[0]."_".$num."_".date("YmdHis",time());
				str_replace($file_save, " ", "");
				//$file_save = $file_save.$file_type;
			}else{
				echo '2222';
				$num = -1;
			}

			if($num != -1){
				if(!file_exists("./upload/".$file_save)){
					$check = move_uploaded_file($_FILES['file']['tmp_name'][$key], "./upload/".$file_save);
					if(!$check){
						echo '3333';
						$num = -1;
					}
				
					if($num != -1){
						$query = "INSERT INTO file_list(board_num, file_upload, file_save) VALUES ('$num', '$file_upload', '$file_save')";
						$result = mysqli_query($conn, $query);
						if(!$result){
							echo '4444';
							$num = -1;
						}
					}
				}else{
					$file_save = $file_save."_".date("YmdHis",time())."_".$key;
					$check = move_uploaded_file($_FILES['file']['tmp_name'][$key], "./upload/".$file_save);
					if(!$check){
						echo '5555';
						$num = -1;
					}
			
					if($num != -1){
						$query = "INSERT INTO file_list(board_num, file_upload, file_save) VALUES ('$num', '$file_upload', '$file_save')";

						$result = mysqli_query($conn, $query);
						if(!$result){
							echo '6666';
							$num = -1;
						}
					}
				}
			}
		}
	}
}


?>
