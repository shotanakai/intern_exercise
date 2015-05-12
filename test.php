<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>BackStore</title>
</head>
<body>
<?php 
	main($argv);
	// inportCsv();
	function main($argv) {var_dump($argv);
		$num = $argv[1];
		var_dump($num);
		$data = createData($num);
		// $check_data = isUniqueArray($data);
		// var_dump($check_data);
		// if ($check_data == false) {
		// 	main();
		// }
		var_dump($data);
		exportCsv($data);
	}

	function createData($num) {
		$ar1 = range('a', 'z');
		$ar2 = range('A', 'Z');
		$ar3 = range('0', '9');
		$ar_all = array_merge($ar1, $ar2, $ar3);
		$email_array = randomstring($ar_all, $num);
		var_dump($email_array);
		$exclusion = array('l', 'I', 'O', '1', '0');
		$pass_nums = array_diff($ar_all, $exclusion);
		$pass_array = randomstring($pass_nums, $num);
		$data = array();
		for ($i=0; $i < $num; $i++) {			
			$email = $email_array[$i] . "@backstore.jp";
			$pass = $pass_array[$i];
			$user = array("email" => $email,
						  "pass" => $pass);
			array_push($data, $user);
		}
		return $data;
	}

	function randomstring($strings, $num) {
		$array = array();
		$limit = 8;
		while (true) {
			shuffle($strings);
			$rand_num = substr(implode($strings), 0, $limit);
			if (in_array($rand_num, $array) == false) {
				array_push($array, $rand_num);
			}
			if (count($array) == $num) {
				break;
			}
		}
		return $array;
	}

	function exportCsv($data) {
		$file = fopen("test.csv", "w");
		if( $file ){
		  foreach ($data as $user) {
		  	$str = $user["email"] . ',' . $user["pass"] . "\n";
  		  	// fputcsv($file, $str);
  		  	fputs($file, $str);
		  }
		}
		fclose($file);
	}

	function isUniqueArray ($data) {
		while (true) {
			foreach ($data as $user) {
			$email_array[] = $user["email"];
			$pass_array[] = $user["pass"];
			}
			$unique_email_array = array_unique($email_array);
			$unique_pass_array = array_unique($pass_array);
			if (count($unique_email_array) === count($email_array) && count($unique_pass_array) === count($pass_array)) {
			  break;
			} else {
				shuffle($ar_all);
				$rand_num = substr(implode($ar_all), 0, $limit);
				$email = $rand_num . "@backstore.jp";
				shuffle($pass_nums);
				$rand_num = substr(implode($pass_nums), 0, $limit);
				$pass = $rand_num;
				$user = array("email" => $email,
							  "pass" => $pass);
				array_push($data, $user);
			}
		}
	}

?>
</body>
</html>