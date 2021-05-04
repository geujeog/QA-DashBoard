<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

if(isset($_FILES['file'])){

	if(($count = count($_FILES['file']['name']))>3){
		$num = -1;
	}

	if($num != -1){
		for($key=0; $key<$count; $key++){
//		foreach($_FILES['file']['name'] as $key => $val){

			if($num == -1) break;

			if(!is_uploaded_file($_FILES['file']['tmp_name'][$key])){
				$num = -1;
			}

			if($_FILES['file']['size'][$key] > 0 && $_FILES['file']['size'][$key] <= 5242880 && $num!= -1){
				$file_upload = $_FILES['file']['name'][$key];
				$file_tmp = explode('.', $file_upload);

				$file_type = $file_tmp[1];
				$file_save = $file_tmp[0]."_".$num."_".date("YmdHis",time());
			}else{
				$num = -1;
			}

			if($num != -1){
				if(!file_exists("./upload/".$file_save)){
					$check = move_uploaded_file($_FILES['file']['tmp_name'][$key], "./upload/".$file_save);
					if(!$check){
						$num = -1;
					}
				
					if($num != -1){
						$query = "INSERT INTO file_list(board_num, file_upload, file_save, file_type) VALUES ('$num', '$file_upload', '$file_save', '$file_type')";

						$result = mysqli_query($conn, $query);
						if(!$result){
							$num = -1;
						}
					}
				}else{
					$file_save = $file_save."_".date("YmdHis",time())."_".$key;
					$check = move_uploaded_file($_FILES['file']['tmp_name'][$key], "./upload/".$file_save);
					if(!$check){
						$num = -1;
					}
			
					if($num != -1){
						$query = "INSERT INTO file_list(board_num, file_upload, file_save, file_type) VALUES ('$num', '$file_upload', '$file_save', '$file_type')";

						$result = mysqli_query($conn, $query);
						if(!$result){
							$num = -1;
						}
					}
				}
			}
		}
	}
}


?>
