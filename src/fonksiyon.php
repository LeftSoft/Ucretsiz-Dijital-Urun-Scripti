<?php 
ob_start();
session_start();

function islemkontrol(){
    if (empty($_SESSION['kullanici_mail'])) {
        Header("Location:../../index.php");
        exit;
    }
}

function seo($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?',':','!','+','-');
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','','','','-','');
    $s = str_replace($tr,$eng,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('.', '', $s);
    $s = trim($s, '-');
    return $s;
}


?>