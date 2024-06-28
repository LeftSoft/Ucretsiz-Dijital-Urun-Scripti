<?php 
try {
	$db=new PDO("mysql:host=localhost;dbname=veritabanıadi;charset=utf8",'kullanıcıadı','şifre');
}
catch (PDOExpception $e) {
	echo $e->getMessage();
}
 ?>