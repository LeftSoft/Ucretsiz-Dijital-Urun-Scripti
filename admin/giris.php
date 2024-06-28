<?php 

ob_start();
session_start();
include '../src/sql.php';
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
    ));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['admingiris'])) {

  $kullanici_mail=$_POST['kullanici_mail'];
  $kullanici_password=$_POST['kullanici_password'];

  $kullanicisor=$db->prepare("SELECT * FROM yonetici where kullanici_mail=:mail and kullanici_password=:password");
  $kullanicisor->execute(array(
    'mail' => $kullanici_mail,
    'password' => md5($kullanici_password)
    ));

  echo $say=$kullanicisor->rowCount();

  if ($say==1) {

    $_SESSION['kullanici_mail']=$kullanici_mail;
    header("Location:index");
    exit;



  } else {

    header("Location:giris.php?durum=no");
    exit;
  }
  

}
if(!empty($_SESSION['kullanici_mail']))

{
  header("Location: index");
}

 ?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $ayarcek['ayar_title']; ?> | Yönetim Paneli</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="giris" class="h1"><?php echo $ayarcek['ayar_title']; ?><br>Yönetim Paneli</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Erişim sağlamak için bilgileri girin.</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="kullanici_mail" placeholder="Mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="kullanici_password" placeholder="Şifre">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
         
          <!-- /.col -->
          <div class="col-12">

            <button type="submit" name="admingiris" class="btn btn-primary btn-block">Giriş Yap</button>
             <?php 

             if ($_GET['durum']=="no") {
             
             echo "<div align=\"center\">Kullanıcı Bulunamadı...</div>";

             } 

             ?>
          </div>
          <!-- /.col -->

          
        </div>
      </form>

    
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src=".dist/js/adminlte.min.js"></script>
</body>
</html>
