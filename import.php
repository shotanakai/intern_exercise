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
				if (is_valid_email($email) === ture && is_valid_password($pass) === true) {
					$true_data++;
					// echo $email . ", " . $pass;
				} else {
					$false_data++;
					echo "NGリスト" . $email . ", " . $pass;
					echo("\n");
				}
			}
			echo $true_data ."\n";
			echo $false_data;
		}
		fclose($file);
	}

	function is_valid_email($email) {
		if (strstr($email,"@") === "@backstore.jp") {
			$explode_email = explode("@", $email);
			if (ctype_alnum($explode_email[0])) {
				return ture;
			}
		}
		return false;
	}
	function is_valid_password($pass) {
		if (ctype_alnum($pass)) {
			$array = str_split($pass);
 			$exclusion = array('l', 'I', 'O', '1', '0');
 			if (in_array($array, $exclusion) === false) {
 				return true;
 			}
		}
		return false;
	}
?>

