<?php include 'header.php'; 
$urunsor=$db->prepare("SELECT * FROM urun");
$urunsor->execute();

if ($_GET['urunsil']=="ok") {
$urunsor2=$db->prepare("SELECT * FROM urun where urun_id={$_GET['urun_id']}");
$urunsor2->execute();
$uruncek2=$urunsor2->fetch(PDO::FETCH_ASSOC);
 if (empty($_SESSION['kullanici_mail'])) {
        Header("Location: giris.php");
        exit;
    }
    $kullanici_satissor=$db->prepare("SELECT * FROM satis");
    $kullanici_satissor->execute();
    while($kullanici_satiscek=$kullanici_satissor->fetch(PDO::FETCH_ASSOC))
    {
    if($kullanici_satiscek['urun_id']==$_GET['urun_id'])
    {
        $sil3=$db->prepare("DELETE from satis where urun_id=:urun_id");
        $kontrol5=$sil3->execute(array(
        'urun_id' => $_GET['urun_id']
    ));
    }
    
    }
     if ($kontrol5) {
     
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ürün Başarıyla Silindi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);
    //Header("Location:urun-listele.php?durum=ok");

  } 
  if($uruncek2['urun_anahtar']=="0"){
      $urunsor3=$db->prepare("SELECT * FROM anahtar where urun_id={$_GET['urun_id']}");
$urunsor3->execute();
$uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);
$sil=$db->prepare("DELETE from urun where urun_id=:urun_id");
  $kontrol=$sil->execute(array(
    'urun_id' => $_GET['urun_id']
    ));
      if(!empty($uruncek3["urun_id"])){
$sil2=$db->prepare("DELETE from anahtar where urun_id=:urun_id");
  $kontrol2=$sil2->execute(array(
    'urun_id' => $_GET['urun_id']
    ));
    
  if ($kontrol) {
     
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ürün Başarıyla Silindi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);
    //Header("Location:urun-listele.php?durum=ok");

  } else {
echo "<script type=\"text/javascript\">swal(\"Başarısız!\", \"Veritabanını kontrol edin!\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
    //Header("Location:urun-listele.php?durum=no");
  }

}


}
else if($uruncek2['urun_anahtar']=="1")
{
   $urunsor3=$db->prepare("SELECT * FROM hesap where urun_id={$_GET['urun_id']}");
$urunsor3->execute();
$uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);
$sil=$db->prepare("DELETE from urun where urun_id=:urun_id");
  $kontrol=$sil->execute(array(
    'urun_id' => $_GET['urun_id']
    ));
      if(!empty($uruncek3["urun_id"])){
$sil2=$db->prepare("DELETE from hesap where urun_id=:urun_id");
  $kontrol2=$sil2->execute(array(
    'urun_id' => $_GET['urun_id']
    ));
    
  if ($kontrol) {
      
echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Ürün Başarıyla Silindi!\", \"success\");</script>";
    header("Refresh: 1; url=".$url);
    //Header("Location:urun-listele.php?durum=ok");

  } else {
echo "<script type=\"text/javascript\">swal(\"Başarısız!\", \"Veritabanını kontrol edin!\", \"error\");</script>";
    header("Refresh: 1; url=".$url);
    //Header("Location:urun-listele.php?durum=no");
  }

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
            <h1>Ürün Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Ürün Listesi</li>
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
                    <th>Ürün Resim</th>
                    <th>Ürün Adı</th>
                    <th>Açıklama</th>
                    <th>Ürün Fiyatı</th>
                    <th>Görüntülenme</th>
                    <th>Toplam Satış</th>
                    <th>Durum</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                   <?php 

                $say=0;

                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td><center><a target="_blank" href="../<?php echo $uruncek['urun_resim'] ?>"><img width="60" src="../<?php echo $uruncek['urun_resim'] ?>"></a></center></td>
                 <td><?php echo $uruncek['urun_isim'] ?></td>
                 <td><?php $detay = $uruncek['urun_aciklama'];
                  $uzunluk = strlen($detay);
                  $limit = 25;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo strip_tags($detay);
                   ?></td>
                  <td><?php echo $uruncek['urun_fiyat'] ?>₺</td>
                  <td><?php echo $uruncek['urun_views'] ?></td>
                  <td><?php echo $uruncek['urun_satis'] ?></td>
                  <td><?php if($uruncek['urun_anahtar']=='0'){echo "Key Satışı";} else{echo "Hesap Satışı";}?></td>

            <td><center><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
            <td><center><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal<? echo $say;?>" data-whatever="@mdo">Sil</button></center></td>
          </tr>

    <div class="modal fade" id="exampleModal<? echo $say; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<? echo $say; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ürün silinsin mi?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div align="center" class="form-group">
              
            <label  for="recipient-name" class="col-form-label">Bütün bilgiler kalıcı olarak silinecektir. Ürünü silmek istediğinden emin misin?</label>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        
        <a href="?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger">Sil</button></a>
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
            <!-- /.card -->

          
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
