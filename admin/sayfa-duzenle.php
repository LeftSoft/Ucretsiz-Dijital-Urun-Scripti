<?php 
include 'header.php'; 

$sayfasor=$db->prepare("SELECT * FROM sayfa where sayfa_id=:id");
$sayfasor->execute(array(
  'id' => $_GET['sayfa_id']
  ));

$sayfacek=$sayfasor->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['sayfaduzenle'])) {
   if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
    

  $ayarkaydet=$db->prepare("UPDATE sayfa SET
    sayfa_baslik=:sayfa_baslik,
    sayfa_slug=:sayfa_slug,
    sayfa_aciklama=:sayfa_aciklama
    WHERE sayfa_id={$_POST['sayfa_id']}");
if(empty($_POST['sayfa_slug']))
{
 $slug = slug($_POST['sayfa_baslik']);
}
else
{
 $slug = slug($_POST['sayfa_slug']);
}
  $update=$ayarkaydet->execute(array(
    'sayfa_baslik' => $_POST['sayfa_baslik'],
    'sayfa_slug' => $slug,
    'sayfa_aciklama' => $_POST['sayfa_aciklama']
    ));

  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Sayfa Başarıyla Düzenlendi!\", \"success\");</script>";
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
            <h1>Sayfa Düzenle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Sayfa Düzenle</li>
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
                <label for="inputName">Sayfa Başlık</label>
                <input type="text" id="inputName" class="form-control" name="sayfa_baslik" value="<?php echo $sayfacek['sayfa_baslik']; ?>" required="" placeholder="Örnek: Şartlar & Koşullar">
              </div>
              <div class="form-group">
                <label for="inputName">Slug</label>
                <input type="text" id="inputName" class="form-control" name="sayfa_slug" value="<?php echo $sayfacek['sayfa_slug']; ?>" placeholder="Örnek: sartlar-ve-kosullar (Boş bırakırsanız sistem otomatik ekleyecektir.)">
              </div>
              <div class="form-group">
                <label for="inputName">Sayfa Açıklama</label>
                 <textarea  class="ckeditor" id="editor1" name="sayfa_aciklama"><?php echo $sayfacek['sayfa_aciklama']; ?></textarea>
                
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
            <input type="text" hidden name="sayfa_id" value="<?php echo $sayfacek['sayfa_id']; ?>">
               <div class="form-group">
             <div class="col-12">
              <a href="sayfa-listele" class="btn btn-secondary">Geri</a>
         <button type="submit" name="sayfaduzenle" class="btn btn-success float-right">Sayfa Düzenle</button>
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
