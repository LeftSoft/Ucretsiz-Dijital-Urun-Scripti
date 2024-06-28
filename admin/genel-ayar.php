<?php include 'header.php'; 


if (isset($_POST['genelkaydet'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE ayar SET
    ayar_title=:ayar_title,
    ayar_description=:ayar_description,
    ayar_keywords=:ayar_keywords,
    ayar_footer=:ayar_footer,
    ayar_tel=:ayar_tel
    WHERE ayar_id=0");

  $update=$ayarkaydet->execute(array(
    'ayar_title' => $_POST['ayar_title'],
    'ayar_description' => $_POST['ayar_description'],
    'ayar_keywords' => $_POST['ayar_keywords'],
    'ayar_footer' => $_POST['ayar_footer'],
    'ayar_tel' => $_POST['ayar_tel']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ayarlar Başarıyla Düzenlendi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);

  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
  }
  
}


if (isset($_POST['sosyalkaydet'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE ayar SET
    ayar_facebook=:ayar_facebook,
    ayar_twitter=:ayar_twitter,
    ayar_instagram=:ayar_instagram
    WHERE ayar_id=0");

  $update=$ayarkaydet->execute(array(
    'ayar_facebook' => $_POST['ayar_facebook'],
    'ayar_twitter' => $_POST['ayar_twitter'],
    'ayar_instagram' => $_POST['ayar_instagram']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ayarlar Başarıyla Düzenlendi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);

  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
  }
  
}

if (isset($_POST['odemekaydet'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE ayar SET
    ayar_api=:ayar_api,
    ayar_secret=:ayar_secret,
    ayar_komisyon=:ayar_komisyon
    WHERE ayar_id=0");

  $update=$ayarkaydet->execute(array(
    'ayar_api' => $_POST['ayar_api'],
    'ayar_secret' => $_POST['ayar_secret'],
    'ayar_komisyon' => $_POST['ayar_komisyon']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ayarlar Başarıyla Düzenlendi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);

  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
  }
  
}

if (isset($_POST['reckaydet'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE ayar SET
    ayar_googlekey=:ayar_googlekey,
    ayar_googlesecret=:ayar_googlesecret
    WHERE ayar_id=0");

  $update=$ayarkaydet->execute(array(
    'ayar_googlekey' => $_POST['ayar_googlekey'],
    'ayar_googlesecret' => $_POST['ayar_googlesecret']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ayarlar Başarıyla Düzenlendi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);

  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
  }
  
}

if (isset($_POST['headerkaydet'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE ayar SET
    ayar_google=:ayar_google,
    ayar_canli=:ayar_canli
    WHERE ayar_id=0");

  $update=$ayarkaydet->execute(array(
    'ayar_google' => $_POST['ayar_google'],
    'ayar_canli' => $_POST['ayar_canli']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ayarlar Başarıyla Düzenlendi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);

  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
  }
  
}

if (isset($_POST['gorselkaydet'])) {
if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
  
  if($_FILES['ayar_logo']["size"] > 0 || $_FILES['ayar_favicon']["size"] > 0)  { 

@$format=$_FILES["ayar_logo"]["type"];
@$format2=$_FILES["ayar_favicon"]["type"];




if($_FILES['ayar_logo']["size"] > 0){
if($format == "image/jpeg" || $format == "image/png"){
    $uploads_dir = '../assets/images';
    @$tmp_name = $_FILES['ayar_logo']["tmp_name"];
    @$name = $_FILES['ayar_logo']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);
    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $refimgyol=substr($uploads_dir, 3)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $duzenle=$db->prepare("UPDATE ayar SET
      ayar_logo=:resimyol
      WHERE ayar_id=0");
    $update=$duzenle->execute(array(
      'resimyol' => $refimgyol
      ));
    
    if ($update) {

      $resimsilunlink=$_POST['ayar_logo'];
      unlink("../$resimsilunlink");

      $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Logo başarıyla güncellendi!\", \"success\");</script>";
header("Refresh: 1; url=".$url);

    } else {

     $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
     echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız. AyarLogo\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
    }
}
 else{
      echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Resim Dosya Formatı Geçersiz (Jpeg,Jpg ve Png dosya uzantıları geçerlidir.)\", \"error\");</script>";
    }
}






 if($_FILES['ayar_favicon']["size"] > 0)
{
if($format2 == "image/jpeg" || $format2 == "image/png"){
    $uploads_dir = '../assets/images';
    @$tmp_name = $_FILES['ayar_favicon']["tmp_name"];
    @$name = $_FILES['ayar_favicon']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);
    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $refimgyol=substr($uploads_dir, 3)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $duzenle=$db->prepare("UPDATE ayar SET
      ayar_favicon=:resimyol
      WHERE ayar_id=0");
    $update=$duzenle->execute(array(
      'resimyol' => $refimgyol
      ));
    
    if ($update) {

      $resimsilunlink=$_POST['ayar_favicon'];
      unlink("../$resimsilunlink");

      $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Favicon başarıyla güncellendi!\", \"success\");</script>";
header("Refresh: 1; url=".$url);

    } else {

     $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
     echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız. Favicon\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
    }
}
 else{
      echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Resim Dosya Formatı Geçersiz (Jpeg,Jpg ve Png dosya uzantıları geçerlidir.)\", \"error\");</script>";
    }
}




 if($_FILES['ayar_favicon']["size"] > 0 && $_FILES['ayar_logo']["size"] > 0)
{
if($format2 == "image/jpeg" || $format2 == "image/png" && $format == "image/jpeg" || $format == "image/png"){
    $uploads_dir = '../assets/images';
    @$tmp_name = $_FILES['ayar_favicon']["tmp_name"];
    @$name = $_FILES['ayar_favicon']["name"];
    @$tmp_name2 = $_FILES['ayar_logo']["tmp_name"];
    @$name2 = $_FILES['ayar_logo']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);
    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $refimgyol=substr($uploads_dir, 3)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $refimgyol2=substr($uploads_dir, 3)."/".$benzersizad.$name2;
    @move_uploaded_file($tmp_name2, "$uploads_dir/$benzersizad$name");

    $duzenle=$db->prepare("UPDATE ayar SET
      ayar_favicon=:resimyol,
      ayar_logo=:resimyol2
      WHERE ayar_id=0");
    $update=$duzenle->execute(array(
      'resimyol' => $refimgyol,
      'resimyol2' => $refimgyol2
      ));
    
    if ($update) {

      $resimsilunlink=$_POST['ayar_favicon'];
      $resimsilunlink2=$_POST['ayar_logo'];
      unlink("../$resimsilunlink");
      unlink("../$resimsilunlink2");
      $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Logo ve Favicon başarıyla güncellendi!\", \"success\");</script>";
header("Refresh: 1; url=".$url);

    } else {

     $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
     echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız. Herikisi\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
    }
}
 else{
      echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Resim Dosya Formatı Geçersiz (Jpeg,Jpg ve Png dosya uzantıları geçerlidir.)\", \"error\");</script>";
    }

}


}
else
{
  echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Hiçbir resim yüklemediniz.\", \"error\");</script>";
}
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Genel Ayarlar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Genel Ayarlar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card card-primary">
            <div class="card-header">

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
           <div class="card-body">
            
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Genel Ayarlar</a>
                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Görsel Ayarlar</a>
                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Sosyal Ağlar</a>
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Google / Canlı Destek</a>
                  <a class="nav-link" id="vert-tabs-recaptcha-tab" data-toggle="pill" href="#vert-tabs-recaptcha" role="tab" aria-controls="vert-tabs-recaptcha" aria-selected="false">Google reCaptcha</a>
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-odeme" role="tab" aria-controls="vert-tabs-odeme" aria-selected="false">Ödeme Ayarları</a>
                  <a class="nav-link" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-admin" role="tab" aria-controls="vert-tabs-admin" aria-selected="true">Şifre Değişikliği</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
<form action="" method="POST" enctype="multipart/form-data" >
                     <div class="form-group">
                <label for="inputName">Site Adı</label>
                <input type="text" id="inputName" class="form-control" name="ayar_title" value="<?php echo $ayarcek['ayar_title']; ?>" required="" placeholder="Site Adı">
              </div>
              <div class="form-group">
                <label for="inputName">Site Açıklaması</label>
                <input type="text" id="inputName" class="form-control" name="ayar_description" value="<?php echo $ayarcek['ayar_description']; ?>" required="" placeholder="Site Açıklaması">
              </div>
              <div class="form-group">
                <label for="inputName">Anahtar Kelime</label>
                <input type="text" id="inputName" class="form-control" name="ayar_keywords" value="<?php echo $ayarcek['ayar_keywords']; ?>" required="" placeholder="Anahtar Kelime">
              </div>
               <div class="form-group">
                <label for="inputName">Footer Bilgi</label>
                <input type="text" id="inputName" class="form-control" name="ayar_footer" value="<?php echo $ayarcek['ayar_footer']; ?>" required="" placeholder="Copyright LeftSoft">
              </div>
 <div class="form-group">
                <label for="inputName">Telefon Numarası</label>
                <input type="text" id="inputName" class="form-control" name="ayar_tel" value="<?php echo $ayarcek['ayar_tel']; ?>" placeholder="Telefon Numarası">
              </div>
                     <div class="col-12">
         
           <button type="submit" name="genelkaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
</form>

                  </div>

                  <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
<form action="" method="POST" enctype="multipart/form-data" >

                    <div class="form-group">
                <label>Yüklü Resim (Logo)
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <a target="_blank" href="../<?php echo $ayarcek['ayar_logo']; ?>"><img width="300" src="../<?php echo $ayarcek['ayar_logo']; ?>"></a>
                </div>
              </div>
              <div class="form-group">
                <label>Logo Seç<span class="required">* (jpg,jpeg,png)</span></label>
                  <input type="file" id="first-name"  name="ayar_logo"  class="form-control col-md-7 col-xs-12">
              </div>


              <div class="form-group">
                <label>Yüklü Resim (Favicon)
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <a target="_blank" href="../<?php echo $ayarcek['ayar_favicon']; ?>"><img width="50" src="../<?php echo $ayarcek['ayar_favicon']; ?>"></a>
                </div>
              </div>
              <div class="form-group">
                <label>Favicon Seç<span class="required">* (jpg,jpeg,png)</span></label>
                  <input type="file" id="first-name"  name="ayar_favicon"  class="form-control col-md-7 col-xs-12">
              </div>
                    <div class="col-12">
         
          <button type="submit" name="gorselkaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
        </form>
                  </div>
                  <?
                $adminsor=$db->prepare("SELECT * FROM yonetici where kullanici_id=147");
                $adminsor->execute();
                $admincek=$adminsor->fetch(PDO::FETCH_ASSOC);
                  if(isset($_POST['adminkaydet']))
                  {
                      if(!empty($_POST['kullanici_mail']) && !empty($_POST['kullanici_password']) && !empty($_POST['kullanici_password2']))
                      {
                      if($_POST['kullanici_password']==$_POST['kullanici_password2'])
                      {
                       $ayarkaydet=$db->prepare("UPDATE yonetici SET
                        kullanici_mail=:kullanici_mail,
                        kullanici_password=:kullanici_password
                        WHERE kullanici_id=147");
                      $update=$ayarkaydet->execute(array(
                        'kullanici_mail' => $_POST['kullanici_mail'],
                        'kullanici_password' => md5($_POST['kullanici_password'])
                        ));
                    
                      if ($update) {
                    
                        echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Bilgiler Başarıyla Güncellendi!\", \"success\");</script>";
                        header("Refresh: 1; url=".$url);
                    
                      } else {
                    
                        echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
                        header("Refresh: 1; url=".$url);
                      }
                      }
                      else
                      {
                         echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Oluşturduğunuz şifreler birbiriyle uyuşmuyor.\", \"error\");</script>";
                        header("Refresh: 1; url=".$url);
                      }
                      }
                      else
                      {
                          echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Lütfen boş alanları doldurunuz.\", \"error\");</script>";
                        header("Refresh: 1; url=".$url);
                      }
                      
                  }
                  
                  ?>
                  <div class="tab-pane fade" id="vert-tabs-admin" role="tabpanel" aria-labelledby="vert-tabs-admin-tab">
                    <form action="" method="POST">
                     <div class="form-group">
                <label for="inputName">Admin Mail</label>
                <input type="mail" id="inputName" class="form-control" name="kullanici_mail" value="<? echo $admincek['kullanici_mail']; ?>" placeholder="Mail">
              </div>
              <div class="form-group">
                <label for="inputName">Admin Şifre</label>
                <input type="password" id="inputName" class="form-control" name="kullanici_password" placeholder="Şifre">
              </div>
               <div class="form-group">
                <label for="inputName">Admin Şifre Tekrar</label>
                <input type="password" id="inputName" class="form-control" name="kullanici_password2" placeholder="Şifre Tekrar">
              </div>
                     <div class="col-12">
         <button type="submit" name="adminkaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
        </form>
                  </div>
                  
                  <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                    <form action="" method="POST" enctype="multipart/form-data" >
                     <div class="form-group">
                <label for="inputName">Facebook</label>
                <input type="text" id="inputName" class="form-control" name="ayar_facebook" value="<?php echo $ayarcek['ayar_facebook']; ?>" placeholder="Facebook">
              </div>
              <div class="form-group">
                <label for="inputName">Twitter</label>
                <input type="text" id="inputName" class="form-control" name="ayar_twitter" value="<?php echo $ayarcek['ayar_twitter']; ?>" placeholder="Twitter">
              </div>
               <div class="form-group">
                <label for="inputName">Instagram</label>
                <input type="text" id="inputName" class="form-control" name="ayar_instagram" value="<?php echo $ayarcek['ayar_instagram']; ?>" placeholder="Instagram">
              </div>
                     <div class="col-12">
         <button type="submit" name="sosyalkaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
        </form>
                  </div>
                  
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                      <form action="" method="POST" enctype="multipart/form-data" >
                      <div class="form-group">
                        <label>Google Analytics Kodu</label>
                        <textarea class="form-control" name="ayar_google" placeholder="Google Analytics Kodu"><?php echo $ayarcek['ayar_google']; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Canlı Destek Kodu</label>
                        <textarea class="form-control" name="ayar_canli" placeholder="Canlı Destek Kodu"><?php echo $ayarcek['ayar_canli']; ?></textarea>
                      </div>
                     <div class="col-12">
         
          <button type="submit" name="headerkaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
                  </div>
                  </form>
                  <div class="tab-pane fade" id="vert-tabs-recaptcha" role="tabpanel" aria-labelledby="vert-tabs-recaptcha-tab">
                    <form action="" method="POST">
                     <div class="form-group">
                <label for="inputName">Site KEY (Anahtar)</label>
                <input type="text" id="inputName" class="form-control" name="ayar_googlekey" value="<?php echo $ayarcek['ayar_googlekey']; ?>" placeholder="Site KEY">
              </div>
              <div class="form-group">
                <label for="inputName">Site SECRET (Gizli Anahtar)</label>
                <input type="text" id="inputName" class="form-control" name="ayar_googlesecret" value="<?php echo $ayarcek['ayar_googlesecret']; ?>" placeholder="Site SECRET">
              </div>
               <div class="form-group">
                <label for="inputName">Google reCaptcha API: </label><a href="https://www.google.com/recaptcha/admin" target="_blank"> https://www.google.com/recaptcha/admin</a>
              </div>
                     <div class="col-12">
         <button type="submit" name="reckaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
        </form>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-odeme" role="tabpanel" aria-labelledby="vert-tabs-odeme-tab">
                    <form action="" method="POST" enctype="multipart/form-data" >
                      <div class="form-group">
                        <label>Shopier Api Key</label>
                        <textarea class="form-control" name="ayar_api" placeholder="Merchant ID - HASH"><?php echo $ayarcek['ayar_api']; ?></textarea>
                      </div>
                      
                      <div class="form-group">
                        <label>Shopier Secret Key</label>
                        <textarea class="form-control" name="ayar_secret" placeholder="Merchant Key - BayiID"><?php echo $ayarcek['ayar_secret']; ?></textarea>
                      </div>
                       <div class="form-group">
                        <label>Shopier Entegrasyon: </label><a href="https://www.shopier.com/m/apiaccess.php" target="_blank"> https://www.shopier.com/m/apiaccess.php</a>
                      </div>
                      <div class="form-group">
                        <label>Komisyon</label>
                        <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>
                  <input type="text" class="form-control" name="ayar_komisyon" placeholder="Komisyon olmasını istemiyorsanız 0 olarak bırakın." value="<? echo $ayarcek['ayar_komisyon']; ?>">
                </div>
                        
                      </div>
                     <div class="col-12">
         
          <button type="submit" name="odemekaydet" class="btn btn-success float-right">Kaydet</button>
        </div>
        </form>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
           
          </div>
          <!-- /.card -->
        </div>
        
      </div>
     
    </section>
    <!-- /.content -->
  </div>
  <?php include 'footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
