<?php include 'header.php'; 


$keysor=$db->prepare("SELECT * FROM hesap where urun_id=:id");
$keysor->execute(array(
  'id' => $_GET['urun_id']
  ));

$keycek=$keysor->fetch(PDO::FETCH_ASSOC);

$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
$urunsor->execute(array(
  'id' => $_GET['urun_id']
  ));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['hesapekle'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
    
  $degisken = $_POST['hesap_text'];
$bolunmus = explode(",", $degisken);

  $ayarkaydet=$db->prepare("INSERT INTO hesap SET
    urun_id=:urun_id,
    hesap_text=:hesap_text
    ");

for ($i=0; $i < count($bolunmus) ; $i++) { 
  
 
  $update=$ayarkaydet->execute(array(
    'urun_id' => $_POST['urun_id'],
    'hesap_text' => $bolunmus[$i]
    ));

}
  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Key Başarıyla Eklendi!\", \"success\");</script>";
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
            <h1><?php echo $uruncek['urun_isim']; ?></h1>
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
                <label for="inputName">Toplu Hesap Ekle</label>
                <input type="text" id="inputName" class="form-control" name="hesap_text" required="" placeholder="Örnek: kullanici:sifre,kullanici2:sifre2">
              </div>
            <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id']; ?>">
               <div class="form-group">
                
             <div class="col-12">
              <a href="hesap-listele" class="btn btn-secondary">Geri</a>
         <button type="submit" name="hesapekle" class="btn btn-success float-right">Hesap Ekle</button>
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
