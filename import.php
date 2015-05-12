<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	move_file($_FILES["upfile"]);
	function move_file($upfile) {
		if ( $_FILES['upfile']['error'] == UPLOAD_ERR_OK ) {
		    $upload_file = "csv_files/" . $_FILES["upfile"]["name"];
		    if ( move_uploaded_file( $_FILES["upfile"]['tmp_name'], $upload_file ) ){
    			importCsv($upload_file);
		    }
		}
	}
	function importCsv($upfile) {
		$file_name = $upfile;
		$file = fopen($file_name, "r");
		if( $file ){
			$true_data = 0;
			$false_data = 0;
			while( $ret_csv = fgetcsv( $file, 256, "," ) ) {
				$ret = count( $ret_csv );
				for($i = 0; $i < $ret; $i++ ){
				}
				$email = $ret_csv[0];
				$pass = $ret_csv[1];
				if (isValidEmail($email) == ture && isValidPassword($pass) == true) {
					$true_data++;
				} else {
					$false_data++;
					echo "NGリスト" . $email . ", " . $pass;
					echo "<br>";
				}
			}
			echo "true:" . $true_data ."\n";
			echo "false:" . $false_data;
			echo "<br>";
			echo '<a href="import.html">戻る</a>';
		}
		fclose($file);
	}

	function isValidEmail($email) {
		if (strstr($email,"@") === "@backstore.jp") {
			$explode_email = explode("@", $email);
			if (ctype_alnum($explode_email[0])) {
				if (strlen($explode_email[0]) == 8) {
					return ture;
				}
			}
		}
		return false;
	}

	function isValidPassword($pass) {
		if (strlen($pass) != 8) {
			return false;
		}
		if (ctype_alnum($pass) == false) {
			return false;
		}
		$array = str_split($pass);
		$exclusion = array('l', 'I', 'O', '1', '0');
		$check_flag = 0;
		foreach ($array as $key) {
			if (in_array($key, $exclusion) == true) {
				return false;
			}
		}
		return true;
	}
?>
</body>
</html>
