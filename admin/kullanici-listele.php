<?php include 'header.php'; 
$kullanici_sor=$db->prepare("SELECT * FROM kullanici");
$kullanici_sor->execute();
if ($_GET['kullanicisil']=="ok") {

 if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: admin/giris.php");
        exit;
    }
  
  $sil=$db->prepare("DELETE from kullanici where k_id=:k_id");
  $kontrol=$sil->execute(array(
    'k_id' => $_GET['k_id']
    ));
    $kullanici_desteksor=$db->prepare("SELECT * FROM destek");
    $kullanici_desteksor->execute();
    $kullanici_mesajsor=$db->prepare("SELECT * FROM mesaj");
    $kullanici_mesajsor->execute();
    $kullanici_satissor=$db->prepare("SELECT * FROM satis");
    $kullanici_satissor->execute();
    while($kullanici_destekcek=$kullanici_desteksor->fetch(PDO::FETCH_ASSOC))
    {
    if($kullanici_destekcek['kullanici_id']==$_GET['k_id'])
    {
        $sil=$db->prepare("DELETE from destek where kullanici_id=:kullanici_id");
        $kontrol2=$sil->execute(array(
        'kullanici_id' => $_GET['k_id']
    ));
    }
    }
    while($kullanici_mesajcek=$kullanici_mesajsor->fetch(PDO::FETCH_ASSOC))
    {
    if($kullanici_mesajcek['kullanici_id']==$_GET['k_id'])
    {
        $sil=$db->prepare("DELETE from mesaj where kullanici_id=:kullanici_id");
        $kontrol3=$sil->execute(array(
        'kullanici_id' => $_GET['k_id']
    ));
    }
    }
    while($kullanici_satiscek=$kullanici_satissor->fetch(PDO::FETCH_ASSOC))
    {
    if($kullanici_satiscek['k_id']==$_GET['k_id'])
    {
        $sil=$db->prepare("DELETE from satis where k_id=:k_id");
        $kontrol3=$sil->execute(array(
        'k_id' => $_GET['k_id']
    ));
    }
    }
  if ($kontrol) {
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Kullanıcı Başarıyla Silindi!\", \"success\");</script>";
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
            <h1>Kullanıcı Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kullanıcı Listesi</li>
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
                    <th>Adı</th>
                    <th>Mail</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($kullanici_cek=$kullanici_sor->fetch(PDO::FETCH_ASSOC)) {
                  $say++?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td><?php echo $kullanici_cek['k_isim']; ?></td>
                 <td>
                <? echo $kullanici_cek['k_mail'];?> 
                </td>
                 <td><center><a href="kullanici-duzenle.php?k_id=<?php echo $kullanici_cek['k_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                 <td><center><a href="kullanici-sifre.php?k_id=<?php echo $kullanici_cek['k_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-key" aria-hidden="true"></i></button></a></center></td>
               <td><center><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal<? echo $say;?>" data-whatever="@mdo">Sil</button></center></td>
          </tr>
            
            <div class="modal fade" id="exampleModal<? echo $say; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<? echo $say; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kullanıcı silinsin mi?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div align="center" class="form-group">
              
            <label  for="recipient-name" class="col-form-label">Bütün bilgiler kalıcı olarak silinecektir. Kullanıcıyı silmek istediğinden emin misin?</label>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
        <a href="?k_id=<?php echo $kullanici_cek['k_id']; ?>&kullanicisil=ok"><button class="btn btn-danger">Sil</button></a>
      </div>
    </div>
  </div>
</div>


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