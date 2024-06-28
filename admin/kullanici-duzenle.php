<?php 
include 'header.php'; 

$kullanici_sor=$db->prepare("SELECT * FROM kullanici where k_id=:id");
$kullanici_sor->execute(array(
  'id' => $_GET['k_id']
  ));

$kullanici_cek=$kullanici_sor->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['kullaniciduzenle'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE kullanici SET
    k_isim=:k_isim,
    k_mail=:k_mail,
    k_adres=:k_adres,
    k_sehir=:k_sehir,
    k_posta=:k_posta,
    k_tel=:k_tel
    WHERE k_id={$_POST['k_id']}");
  $update=$ayarkaydet->execute(array(
    'k_isim' => $_POST['k_isim'],
    'k_mail' => $_POST['k_mail'],
    'k_adres' => $_POST['k_adres'],
    'k_sehir' => $_POST['k_sehir'],
    'k_posta' => $_POST['k_posta'],
    'k_tel' => $_POST['k_tel']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Kullanıcı Başarıyla Düzenlendi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);

  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
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
            <h1>Kullanıcı Düzenle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kullanıcı Düzenle</li>
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
                <label for="inputName">Kullanıcı İsim</label>
                <input type="text" id="inputName" class="form-control" name="k_isim" value="<?php echo $kullanici_cek['k_isim']; ?>" required="">
              </div>
             <div class="form-group">
                <label for="inputName">Kullanıcı Mail</label>
                <input type="mail" id="inputName" class="form-control" name="k_mail" value="<?php echo $kullanici_cek['k_mail']; ?>" required="">
              </div>
                <div class="form-group">
                <label for="inputName">Kullanıcı Adres</label>
                <input type="text" id="inputName" class="form-control" name="k_adres" value="<?php echo $kullanici_cek['k_adres']; ?>" required="">
              </div>
                <div class="form-group">
                <label for="inputName">Kullanıcı Şehir</label>
                <input type="text" id="inputName" class="form-control" name="k_sehir" value="<?php echo $kullanici_cek['k_sehir']; ?>" required="">
              </div>
                <div class="form-group">
                <label for="inputName">Kullanıcı Posta</label>
                <input type="text" id="inputName" class="form-control" name="k_posta" value="<?php echo $kullanici_cek['k_posta']; ?>" required="">
              </div>
                <div class="form-group">
                <label for="inputName">Kullanıcı Tel</label>
                <input type="text" id="inputName" class="form-control" name="k_tel" value="<?php echo $kullanici_cek['k_tel']; ?>" required="">
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
              </div>
            <input type="text" hidden name="k_id" value="<?php echo $kullanici_cek['k_id']; ?>">
               <div class="form-group">
             <div class="col-12">
              <a href="kullanici-listele" class="btn btn-secondary">Geri</a>
         <button type="submit" name="kullaniciduzenle" class="btn btn-success float-right">Kullanıcı Düzenle</button>
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