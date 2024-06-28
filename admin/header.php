<?php 
ob_start();
session_start();
include '../src/sql.php';
include 'fonksiyon.php';
include '../src/fonksiyon.php';
if(empty($_SESSION['kullanici_mail']))
{
  header('Location: giris.php');
}
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
    ));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
$desteksor2=$db->prepare("SELECT * FROM destek where destek_durum=1 ORDER BY destek_sontarih DESC LIMIT 4");
$desteksor2->execute();
$desteksor=$db->prepare("SELECT * FROM destek where destek_durum=1");
$desteksor->execute();
$destekcek=$desteksor->rowCount();

$uri=end(explode('/', str_replace('.php', '', $_SERVER['REQUEST_URI'])));
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $ayarcek['ayar_title']; ?> | Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Ck Editör -->
  <!--<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>-->
   <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
   <script type="text/javascript">
     
     function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
   </script>
   <style type="text/css">
   .container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
  
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
  
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
  border-top-right-radius: 10px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
  border-top-right-radius: 10px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
   </style>
   
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item dropdown">
          <a class="btn btn-sm btn-success pull-left btn-site-prev" target="_blank" href="<? echo $ayarcek['ayar_url']; ?>"><i class="fa fa-eye"></i> Siteyi Görüntüle</a>
      </li>
     

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><? echo $destekcek; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <? while($destekcekk=$desteksor2->fetch(PDO::FETCH_ASSOC)){ 
            
            $desteksor3=$db->prepare("SELECT * FROM mesaj where destek_id={$destekcekk['destek_id']} ORDER BY mesaj_id DESC");
            $desteksor3->execute();
            $destekcek3=$desteksor3->fetch(PDO::FETCH_ASSOC);
            $kullanicisor=$db->prepare("SELECT * FROM kullanici where k_id={$destekcekk['kullanici_id']}");
            $kullanicisor->execute();
            $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
            
            
            ?>
          <a href="destek-listele?id=<? echo $destekcekk['destek_id']; ?>" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../assets/images/unknown.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <? echo $kullanicicek['k_isim']; ?>
                  
                </h3>
                <p class="text-sm"><?$detay = strip_tags($destekcek3['mesaj_text']);
                  $uzunluk = strlen($detay);
                  $limit = 20;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo $detay;?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <? echo timeConvert($destekcek3['mesaj_sontarih']); ?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <? } ?>
          <div class="dropdown-divider"></div>
          <a href="destek-listele" class="dropdown-item dropdown-footer">Mesajları Gör</a>
        </div>
      </li>
     
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $ayarcek['ayar_title']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
            <a href="index" class="nav-link <?php if($uri == '' || $uri == 'index'){ echo 'active';} else {echo '';} ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Anasayfa
              </p>
            </a>
          </li>

          <li class="nav-item <?php if($uri == 'urun-listele' || $uri == 'urun-ekle' || $uri == 'key-listele' || $uri=='hesap-listele') { echo 'menu-open';} else {echo '';} ?>">
            <a href="#" class="nav-link <?php if($uri == 'urun-listele'|| $uri == 'urun-ekle' || $uri == 'key-listele' || $uri=='hesap-listele'){ echo 'active';} else {echo '';} ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Ürünler
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="urun-listele" class="nav-link <?php if($uri == 'urun-listele'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ürün Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="urun-ekle" class="nav-link <?php if($uri == 'urun-ekle'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ürün Ekle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="key-listele" class="nav-link <?php if($uri == 'key-listele'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Key Ekle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="hesap-listele" class="nav-link <?php if($uri == 'hesap-listele'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hesap Ekle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="kategori-listele" class="nav-link <?php if($uri == 'kategori-listele'){ echo 'active';} else{echo '';} ?>">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
               Kategoriler
              </p>
            </a>
          </li>
           <li class="nav-item <?php if($uri == 'blog-listele' || $uri == 'blog-ekle') { echo 'menu-open';} else {echo '';} ?>">
            <a href="#" class="nav-link <?php if($uri == 'blog-listele' || $uri == 'blog-ekle'){ echo 'active';} else {echo '';} ?>">
              <i class="nav-icon fas fa-blog"></i>
              <p>
                Blog
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="blog-listele" class="nav-link <?php if($uri == 'blog-listele'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="blog-ekle" class="nav-link <?php if($uri == 'blog-ekle'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Ekle</p>
                </a>
              </li>
            
            </ul>
          </li>
           <li class="nav-item <?php if($uri == 'sayfa-listele' || $uri == 'sayfa-ekle') { echo 'menu-open';} else {echo '';} ?>">
            <a href="#" class="nav-link <?php if($uri == 'sayfa-listele' || $uri == 'sayfa-ekle'){ echo 'active';} else {echo '';} ?>">
              <i class="nav-icon fas fa-pager"></i>
              <p>
                Sayfalar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sayfa-listele" class="nav-link <?php if($uri == 'sayfa-listele'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sayfa Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sayfa-ekle" class="nav-link <?php if($uri == 'sayfa-ekle'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sayfa Ekle</p>
                </a>
              </li>
            
            </ul>
          </li>
          <li class="nav-item <?php if($uri == 'sss-listele' || $uri == 'sss-ekle') { echo 'menu-open';} else {echo '';} ?>">
            <a href="#" class="nav-link <?php if($uri == 'sss-listele' || $uri == 'sss-ekle'){ echo 'active';} else {echo '';} ?>">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                SSS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sss-listele" class="nav-link <?php if($uri == 'sss-listele'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SSS Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sss-ekle" class="nav-link <?php if($uri == 'sss-ekle'){ echo 'active';} else{echo '';} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SSS Ekle</p>
                </a>
              </li>
            
            </ul>
          </li>
          <? $desteklink="destek-listele?id=".$_GET["id"]; ?>
           <li class="nav-item">
            <a href="destek-listele" class="nav-link <?php if($uri == 'destek-listele' ||$uri == $desteklink){ echo 'active';} else{echo '';} ?>">
              <i class="nav-icon fa fa-ticket"></i>
              <p>
               Destek
              </p>
            </a>
          </li>
         
<li class="nav-item">
            <a href="genel-ayar" class="nav-link <?php if($uri == 'genel-ayar'){ echo 'active';} else{echo '';} ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Genel Ayarlar
              </p>
            </a>
          </li>
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>