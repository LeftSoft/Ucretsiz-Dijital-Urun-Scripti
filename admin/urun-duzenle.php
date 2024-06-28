<?php include 'header.php'; 


$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
$urunsor->execute(array(
  'id' => $_GET['urun_id']
  ));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
$kategorisor=$db->prepare("SELECT * FROM kategori");
$kategorisor->execute();
if (isset($_POST['urunduzenle'])) {
if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
  
  if($_FILES['urun_resim']["size"] > 0)  { 

@$format=$_FILES["urun_resim"]["type"];

if($format == "image/jpeg" || $format == "image/png"){
    $uploads_dir = '../assets/images/product';
    @$tmp_name = $_FILES['urun_resim']["tmp_name"];
    @$name = $_FILES['urun_resim']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);
    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $refimgyol=substr($uploads_dir, 3)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $duzenle=$db->prepare("UPDATE urun SET
      kategori_id=:kategori_id,
      urun_isim=:baslik,
      urun_aciklama=:aciklama,
      urun_resim=:resimyol,
      urun_fiyat=:urun_fiyat
      WHERE urun_id={$_POST['urun_id']}");
    $update=$duzenle->execute(array(
      'kategori_id' => $_POST['kategori_id'],
      'baslik' => $_POST['urun_isim'],
      'aciklama' => $_POST['urun_aciklama'],
      'resimyol' => $refimgyol,
      'urun_fiyat' => $_POST['urun_fiyat']
      ));
    

    $urun_id=$_POST['urun_id'];

    if ($update) {

      $resimsilunlink=$_POST['urun_resim'];
      unlink("../$resimsilunlink");

      $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ürün başarıyla güncellendi!\", \"success\");</script>";
header("Refresh: 1; url=".$url);

    } else {

     $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
     echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
    }
}
 else{
      echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Resim Dosya Formatı Geçersiz (Jpeg,Jpg ve Png dosya uzantıları geçerlidir.)\", \"error\");</script>";
    }


  } else {

   $duzenle=$db->prepare("UPDATE urun SET
      kategori_id=:kategori_id,
      urun_isim=:baslik,
      urun_aciklama=:aciklama,
      urun_fiyat=:urun_fiyat
      WHERE urun_id={$_POST['urun_id']}");
    $update=$duzenle->execute(array(
      'kategori_id' => $_POST['kategori_id'],
      'baslik' => $_POST['urun_isim'],
      'aciklama' => $_POST['urun_aciklama'],
      'urun_fiyat' => $_POST['urun_fiyat']
      ));

    if ($update) {

     $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ürün başarıyla güncellendi!\", \"success\");</script>";
header("Refresh: 1; url=".$url);

    } else {
 $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
     echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
    }
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
            <h1>Düzenle - <?php echo $uruncek['urun_isim']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active"><?php echo $uruncek['urun_isim']; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="" method="POST" enctype="multipart/form-data" >
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">



            <div class="card-header">
              
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
<div class="form-group">
                <label>Yüklü Resim
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <a target="_blank" href="../<?php echo $uruncek['urun_resim']; ?>"><img width="300" src="../<?php echo $uruncek['urun_resim']; ?>"></a>
                </div>
              </div>
  <div class="form-group">
                <label>Resim Seç<span class="required">* (jpg,jpeg,png)</span></label>
                  <input type="file" id="first-name"  name="urun_resim"  class="form-control col-md-7 col-xs-12">
              </div>
              <div class="form-group">
                <label for="inputName">Ürün Adı</label>
                <input type="text" id="inputName" class="form-control" name="urun_isim" value="<?php echo $uruncek['urun_isim']; ?>" required="" placeholder="Örnek: key1,key2,key3">
              </div>
              <div class="form-group">
                 <label for="inputName">Ürün Açıklaması</label>
                

                  <textarea  class="ckeditor" id="editor1" name="urun_aciklama"><?php echo $uruncek['urun_aciklama']; ?></textarea>
                
              </div>
            <div class="form-group">
                <label for="inputStatus">Ürün Kategori</label>
                <select id="inputStatus" class="form-control custom-select" name="kategori_id" required="">
                    <option disabled selected>Kategori Seç</option>
                    <? while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ ?>
                  <option value="<? echo $kategoricek['kategori_id']; ?>" <? if($uruncek['kategori_id']==$kategoricek['kategori_id']){echo "selected";} ?>><? echo $kategoricek['kategori_isim']; ?></option>
                  <? }?>
                </select>
              </div>
              <script type="text/javascript">

               CKEDITOR.replace( 'editor1',

               {

                filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                forcePasteAsPlainText: true

              } 

              );

            </script>
             <div class="form-group">
                <label for="inputName">Ürün Fiyatı</label>
                
                <input type="number" class="form-control" value="<?php echo $uruncek['urun_fiyat']; ?>" name="urun_fiyat" placeholder="Örn: 60.99" required name="price" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$">
              </div>
             
            <input type="text" hidden name="urun_id" value="<?php echo $uruncek['urun_id']; ?>">
            <input type="hidden" name="urun_resim" value="<?php echo $uruncek['urun_resim'] ?>">
               <div class="form-group">
             <div class="col-12">
              <a href="urun-listele" class="btn btn-secondary">Geri</a>
         <button type="submit" name="urunduzenle" class="btn btn-success float-right">Key Düzenle</button>
        </div>
      </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      

</form>

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
