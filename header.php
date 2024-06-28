<?php 

date_default_timezone_set('Europe/Istanbul');
$uri=end(explode('/', str_replace('.php', '', $_SERVER['REQUEST_URI'])))."1";
function timeConvert ( $zaman ){
	$zaman =  strtotime($zaman);
	$zaman_farki = time() - $zaman;
	$saniye = $zaman_farki;
	$dakika = round($zaman_farki/60);
	$saat = round($zaman_farki/3600);
	$gun = round($zaman_farki/86400);
	$hafta = round($zaman_farki/604800);
	$ay = round($zaman_farki/2419200);
	$yil = round($zaman_farki/29030400);
	if( $saniye < 60 ){
		if ($saniye == 0){
			return "az önce";
		} else {
			return $saniye .' saniye önce';
		}
	} else if ( $dakika < 60 ){
		return $dakika .' dakika önce';
	} else if ( $saat < 24 ){
		return $saat.' saat önce';
	} else if ( $gun < 7 ){
		return $gun .' gün önce';
	} else if ( $hafta < 4 ){
		return $hafta.' hafta önce';
	} else if ( $ay < 12 ){
		return $ay .' ay önce';
	} else {
		return $yil.' yıl önce';
	}
}

if ($uri!="index1" && $uri!="1") {

ob_start();
session_start();
include 'src/sql.php';
include 'src/fonksiyon.php';
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
    ));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
$visitor_ip=$_SERVER['REMOTE_ADDR'];
 ?>
<? 

if(isset($_SESSION["shoppingCart"]))
{
$shoppingCart = $_SESSION["shoppingCart"];
$total_count = $shoppingCart["summary"]["total_count"];
$total_price = $shoppingCart["summary"]["total_price"];
$shopping_products = $shoppingCart["products"];


}
else
{
    $total_count = 0;
    $total_price = 0.0;
}
?>
<!DOCTYPE html>

<html lang="tr">
    <head>
        <base href="<? echo $ayarcek["ayar_url"]; ?>">
         <style type="text/css">
            .image{
                height: 49px;
                width: 177px;
            }

        </style>
         <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo strip_tags($ayarcek['ayar_title']); ?></title>
        <meta name="description" content="<?php echo strip_tags($ayarcek['ayar_description']); ?>">
        <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
        
         <meta property="og:site_name" content="HexGame"/>
        <? if(!empty($_GET['urun_id'])){ 
        $urunsor33=$db->prepare("SELECT * FROM urun where urun_id=:id");
        $urunsor33->execute(array(
          'id' => $_GET['urun_id']
          ));
        $uruncek33=$urunsor33->fetch(PDO::FETCH_ASSOC);
        
        
        ?>
        <meta property="og:title" content="<?php echo $uruncek33['urun_isim']; ?>"/>
        <meta property="og:description" content="<?php echo strip_tags(trim(html_entity_decode($uruncek33['urun_aciklama'], ENT_QUOTES, 'UTF-8'), "\xc2\xa0")); ?>"/>
        <meta property="og:url" content="<? echo 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>"/>
        <meta property="og:image" content="<?php echo $ayarcek['ayar_url'].$uruncek33['urun_resim']; ?>"/>
        <meta property="og:image:width" content="750"/>
        <meta property="og:image:height" content="422"/>
        <? }
        if($_GET['id'])
        {
            $urunsor22=$db->prepare("SELECT * FROM kategori where kategori_id=:id");
            $urunsor22->execute(array(
              'id' => $_GET['id']
              ));
            
            $uruncek22=$urunsor22->fetch(PDO::FETCH_ASSOC);
        ?>
         <meta property="og:title" content="<?php echo $uruncek22['kategori_isim']; ?>"/>
         <meta property="og:url" content="<? echo 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>"/>
        <? }
        if($_GET['blog_id'])
        {
            $urunsor44=$db->prepare("SELECT * FROM blog where blog_id=:id");
            $urunsor44->execute(array(
              'id' => $_GET['blog_id']
              ));
            
            $uruncek44=$urunsor44->fetch(PDO::FETCH_ASSOC);
        ?>
        <meta property="og:title" content="<?php echo $uruncek44['blog_baslik']; ?>"/>
        <meta property="og:description" content="<?php echo strip_tags($uruncek44['blog_aciklama']); ?>"/>
        <meta property="og:url" content="<? echo 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>"/>
        <meta property="article:published_time" content="<?php echo strip_tags($uruncek44['blog_tarih2']); ?>"/>
        <meta property="og:image" content="<?php echo $ayarcek['ayar_url'].$uruncek44['blog_resim']; ?>"/>
        <meta property="og:image:width" content="750"/>
        <meta property="og:image:height" content="422"/>
        
        <? }?>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="css2.css?family=Montserrat:wght@500;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="<?php echo $ayarcek['ayar_favicon'] ?>">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/custom-select.css">
        <link rel="stylesheet" href="assets/css/lightcase.css">
        <? 
        echo $ayarcek['ayar_google'];
        echo $ayarcek['ayar_canli'];
        ?>
        <link rel="stylesheet" href="swiper@6.8.0/swiper-bundle.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/circle.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>
        <script src='assets/js/custom.js'></script>
        <script  language="JavaScript">
function penac(theURL,winName,features) {
    window.open(theURL,winName,features);
}

// -->
 </script>
 <script>
    $(document).ready(function () {
$("#btnSubmit").click(function () {
    setTimeout(function () { disableButton(); }, 0);
});

function disableButton() {
    $("#btnSubmit").prop('disabled', true);
}
});
</script>
  <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
       
        <header class="header style2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 d-flex d-lg-block justify-content-between align-items-center">
                        <a href="index" class="logo"><img class="image" src="<?php echo $ayarcek['ayar_logo']; ?>" alt=""></a>
                        <a href="index" class="logo-sticky"><img class="image" src="<?php echo $ayarcek['ayar_logo']; ?>" alt=""></a>
                        
                        <div class="menu-bar d-lg-none">
                            <i class="fas fa-bars"></i>
                            <i class="d-none fas fa-times"></i>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-menu-area">
                            <div class="d-lg-none text-right px-3">
                                <button class="close-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <ul class="menu d-lg-flex justify-content-lg-end align-items-center">
                                <li><a href="index">Anasayfa</a></li>
                                <li><a href="urunler">Ürünler</a></li>
                                <li><a href="blog">Blog</a></li>
                              
                                <li><a href="sepet"><i class="fas fa-shopping-cart"></i> Sepet <?php if($total_count!=0){ echo "("; }?><i class="cart"><?php if($total_count!=0){ echo $total_count; }?></i><?php if($total_count!=0){ echo " )"; }?></a></li>
                                
                                
                               
                                <li><ul class="nav navbar-nav navbar-right">
                                <?php if(empty($_SESSION['userkullanici_mail'])){ ?>
                                <li><a class="login button" href="giris">Giriş Yap</a></li>
                            <?php } else{?>
                                <li><a class="login button" href="hesabim">Hesabım</a></li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>


<?php }else{
ob_start();
session_start();
include 'src/sql.php';
include 'src/fonksiyon.php';
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
    ));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$visitor_ip=$_SERVER['REMOTE_ADDR'];
 ?>

<? 
if(isset($_SESSION["shoppingCart"]))
{
$shoppingCart = $_SESSION["shoppingCart"];
$total_count = $shoppingCart["summary"]["total_count"];
$total_price = $shoppingCart["summary"]["total_price"];
$shopping_products = $shoppingCart["products"];

}
else
{
    $total_count = 0;
    $total_price = 0.0;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<? echo $ayarcek["ayar_url"]; ?>">
        <style type="text/css">
            .image{
                height: 49px;
                width: 177px;
            }

        </style>
         <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $ayarcek['ayar_title']; ?></title>
        <meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
        <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
        <meta property="og:site_name" content="HexGame"/>
        <meta property="og:title" content="<?php echo $ayarcek['ayar_title']; ?>"/>
        <meta property="og:description" content="<?php echo $ayarcek['ayar_description'] ?>"/>
        <meta property="og:url" content="<?php echo $ayarcek['ayar_url'] ?>"/>
        <meta property="og:image" content="<?php echo $ayarcek['ayar_logo'] ?>"/>
        <meta property="og:image:width" content="750"/>
        <meta property="og:image:height" content="422"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="css2.css?family=Montserrat:wght@500;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="<?php echo $ayarcek['ayar_favicon'] ?>">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/custom-select.css">
        <link rel="stylesheet" href="assets/css/lightcase.css">
        <link rel="stylesheet" href="swiper@6.8.0/swiper-bundle.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/circle.css">
        <script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>
         <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       <style type="text/css">
.btn-2 {
    width: 50px;
    height: 50px;
    border: none;
    color: white;
    background-color: #0A7EED;
    cursor: pointer;
    border: -1px solid #4CAF50;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
 
.btn-2:hover {
    color: #0A7EED;
    background-color: #fff;
    border: -1px solid #4CAF50;
}
.form-rounded {
border-radius: 1rem;
}
      </style>
    </head>
    <body>

           
        <header class="header">
           
            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-4 d-flex d-lg-block justify-content-between align-items-center">
                        <a href="index" class="logo"><img class="image" src="<?php echo $ayarcek['ayar_logo']; ?>" alt=""></a>
                        
                        <div class="menu-bar d-lg-none">
                            <i class="fas fa-bars"></i>
                            <i class="d-none fas fa-times"></i>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-menu-area">
                            <div class="d-lg-none text-right px-3">
                                <button class="close-btn">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <ul class="menu d-lg-flex justify-content-lg-end align-items-center">
                               <li><a href="index">Anasayfa</a></li>
                                <li><a href="urunler">Ürünler</a></li>
                                <li><a href="blog">Blog</a></li>
                                
                                <li><a href="sepet"><i class="fas fa-shopping-cart"></i> Sepet <?php if($total_count!=0){ echo "("; }?><i class="cart"><?php if($total_count!=0){ echo $total_count; }?></i><?php if($total_count!=0){ echo " )"; }?></a></li>
                               
                               
                               
                                 <?php if(empty($_SESSION['userkullanici_mail'])){ ?>
                                <li><a class="login button" href="giris">Giriş Yap</a></li>
                            <?php } else{?>
                                <li><a class="login button" href="hesabim">Hesabım</a></li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          
        </header>

<?php } ?>