<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>BackStore</title>
</head>
<body>
<?php
	validation($_POST['num']);
	function validation($num) {
		if (ctype_digit($num) == false) {
			echo "正の整数を入力してください";
			echo "<br>";
			echo '<a href="test.html">戻る</a>';
			return false;
		}
		if ($num > 200) {
			echo "一度に生成できるのは200件までです";
			echo "<br>";
			echo '<a href="test.html">戻る</a>';
		 	return false;
		}
		main($_POST['num']);
	}
	function main($num) {
		$data = createData($num);
		exportCsv($data);
	}

	function createData($num) {
		$ar1 = range('a', 'z');
		$ar2 = range('A', 'Z');
		$ar3 = range('0', '9');
		$ar_all = array_merge($ar1, $ar2, $ar3);
		$email_array = randomstring($ar_all, $num);
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
  		  	fputs($file, $str);
		  }
		}
		fclose($file);
		echo '<a href="download.php">データをダウンロード</a>';
		echo '<br>';
		echo '<a href="test.html">戻る</a>';
	}
?>
</body>
</html>