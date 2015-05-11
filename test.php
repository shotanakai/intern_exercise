<?php 
	main();	
	function main() {
		$num = 2;
		$data = create_data($num);
		var_dump($data);
		export_csv($data);
	}

	function create_data($num) {
		$limit = 8;
		$ar1 = range('a', 'z');
		$ar2 = range('A', 'Z');
		$ar3 = range(0, 9);
		$ar_all = array_merge($ar1, $ar2, $ar3);
		$exclusion = array('l', 'I', 'O', 1, 0);
		$pass_nums = array_diff($ar_all, $exclusion);
		$data = array();
		for ($i=0; $i < $num; $i++) {
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
		return $data;
	}

	function export_csv($data) {
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
?>