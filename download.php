<?php
$file = "test.csv";
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file");
readfile($file);
exit;
?>