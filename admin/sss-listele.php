<?php include 'header.php'; 
$ssssor=$db->prepare("SELECT * FROM sss");
$ssssor->execute();
if ($_GET['ssssil']=="ok") {

 if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
  
  $sil=$db->prepare("DELETE from sss where sss_id=:sss_id");
  $kontrol=$sil->execute(array(
    'sss_id' => $_GET['sss_id']
    ));

  if ($kontrol) {
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"SSS başarıyla silindi!\", \"success\");</script>";
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
            <h1>SSS Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">SSS Listesi</li>
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
                    <th>SSS Başlık</th>
                    <th>SSS Açıklama</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($ssscek=$ssssor->fetch(PDO::FETCH_ASSOC)) {
                  $say++?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td><?php echo $ssscek['sss_baslik'] ?></td>
                 <td><?php $detay = $ssscek['sss_aciklama'];
                  $uzunluk = strlen($detay);
                  $limit = 50;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo strip_tags($detay); ?></td>
                 <td><center><a href="sss-duzenle.php?sss_id=<?php echo $ssscek['sss_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
               <td><center><a href="?sss_id=<?php echo $ssscek['sss_id']; ?>&ssssil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
          </tr>



          <?php  }

          ?>
                 
                  </tfoot>
                </table>
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
