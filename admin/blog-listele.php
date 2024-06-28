<?php include 'header.php'; 
$urunsor2=$db->prepare("SELECT * FROM blog");
$urunsor2->execute();
if ($_GET['blogsil']=="ok") {

 if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
  
  $sil=$db->prepare("DELETE from blog where blog_id=:blog_id");
  $kontrol=$sil->execute(array(
    'blog_id' => $_GET['blog_id']
    ));
   $sil=$db->prepare("DELETE from blog where blog_id=:blog_id");
  $kontrol=$sil->execute(array(
    'blog_id' => $_GET['blog_id']
    ));
  if ($kontrol) {
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Blog başarıyla silindi!\", \"success\");</script>";
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
            <h1>Blog Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Blog Listesi</li>
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
                    <th>Resim</th>
                    <th>Başlık</th>
                    <th>Görüntülenme</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($blogcek=$urunsor2->fetch(PDO::FETCH_ASSOC)) {
                  $say++?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                  <td><center><a target="_blank" href="../<?php echo $blogcek['blog_resim'] ?>"><img width="50" src="../<?php echo $blogcek['blog_resim'] ?>"></a></center></td>
                 <td><?php echo strip_tags($blogcek['blog_baslik']); ?></td>
                 <td><?php echo strip_tags($blogcek['blog_views']); ?></td>
                 <td><center><a href="blog-duzenle.php?blog_id=<?php echo $blogcek['blog_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
               <td><center><a href="?blog_id=<?php echo $blogcek['blog_id']; ?>&blogsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
