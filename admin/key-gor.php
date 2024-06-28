<?php include 'header.php'; 

$keysor=$db->prepare("SELECT * FROM anahtar where urun_id=:id");
$keysor->execute(array(
  'id' => $_GET['urun_id']
  ));
if ($_GET['keysil']=="ok") {

 if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
  
  $sil=$db->prepare("DELETE from anahtar where key_id=:key_id");
  $kontrol=$sil->execute(array(
    'key_id' => $_GET['urun_id']
    ));
  
  if ($kontrol) {
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Key başarıyla silindi!\", \"success\");</script>";
header("Refresh: 1; url=".$url);

  } else {
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
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
            <h1>Key Ekle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Key Ekle</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($keycek=$keysor->fetch(PDO::FETCH_ASSOC)) {$say++?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                  <td><?php echo $keycek['key_text'] ?></td>
                 <td><center><a href="key-duzenle.php?key_id=<?php echo $keycek['key_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
               <td><center><a href="?urun_id=<?php echo $keycek['key_id']; ?>&keysil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
        
          </tr>



          <?php  }

          ?>
                 
                  </tfoot>
                </table>
                 <div class="col-12">
              <a href="key-listele" class="btn btn-secondary">Geri</a>
         
        </div>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include 'footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'js.php'; ?>
</body>
</html>
