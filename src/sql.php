<?php 
try {
	$db=new PDO("mysql:host=localhost;dbname=hatauaxk_flex;charset=utf8",'hatauaxk_flex','R1a2s3s4h5');
}
catch (PDOExpception $e) {
	echo $e->getMessage();
}
 ?>