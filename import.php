<?php
	importCsv($argv);

	function importCsv($argv) {
		$file_name = $argv[1];
		$file = fopen($file_name, "r");
		if( $file ){
			$true_data = 0;
			$false_data = 0;
			while( $ret_csv = fgetcsv( $file, 256, "," ) ) {
				$ret = count( $ret_csv );
				for($i = 0; $i < $ret; $i++ ){
					// echo $ret_csv[$i] . "\n";
				}
				$email = $ret_csv[0];
				$pass = $ret_csv[1];
				// $exclusion = array('l', 'I', 'O', 1, 0);
				// if (strstr($email, '@backstore.jp') && strlen($email) == 21 && strlen($pass) == 8) {
				// }
				// if (preg_match('|^[a-zA-Z0-9/?-]+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]+$|', $email)) {
				// 	$email = $email;
				// }
				if (isValidEmail($email) == ture && isValidPassword($pass) == true) {
					$true_data++;
					// echo $email . ", " . $pass;
				} else {
					$false_data++;
					echo "NGリスト" . $email . ", " . $pass;
					echo("\n");
				}
			}
			echo "true:" . $true_data ."\n";
			echo "false:" . $false_data;
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

