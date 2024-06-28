<?php include 'header.php'; 
$satis_sor=$db->prepare("SELECT * FROM satis");
$satis_sor->execute();
$satis_sor2=$db->prepare("SELECT * FROM satis where satis_tarih2");
$satis_sor2->execute();
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
            <h1>Satış Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Satış Listesi</li>
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
              <? if($_GET['s']!="bugun"){ ?>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ürün</th>
                    <th>Satın Alan</th>
                    <th>Tarih</th>
                    <th>Fiyat</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($satis_cek=$satis_sor->fetch(PDO::FETCH_ASSOC)) {
                  $say++;
                  $urun_sor=$db->prepare("SELECT * FROM urun where urun_id={$satis_cek['urun_id']}");
                 $urun_sor->execute();
                  $urun_cek=$urun_sor->fetch(PDO::FETCH_ASSOC);
                  $kullanici_sor=$db->prepare("SELECT * FROM kullanici where k_id={$satis_cek['k_id']}");
                 $kullanici_sor->execute();
                  $kullanici_cek=$kullanici_sor->fetch(PDO::FETCH_ASSOC);
                  ?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td><?php echo '<a href="'.$ayarcek['ayar_url'].'urun/'.seo($urun_cek["urun_isim"]).'/'.$urun_cek["urun_id"].'" target="_blank">'.$urun_cek['urun_isim'].'</a>'; ?></td>
                 <td><?php
                 if($satis_cek['k_id']!=0){
                 echo $kullanici_cek['k_isim'];
                 }
                 else
                 {
                     echo "Misafir Hesap";
                 }
                 /*
                 $detay = $ssscek['sss_aciklama'];
                  $uzunluk = strlen($detay);
                  $limit = 50;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo strip_tags($detay); 
                  */
                  ?></td>
                  <td><? echo $satis_cek['satis_tarih']; ?></td>
                  <td><? 
                   if($ayarcek['ayar_komisyon']==0)
                    {
                     echo  $urun_cek['urun_fiyat']; 
                    }
                    else
                    {
                        echo $urun_cek['urun_fiyat']*1*($ayarcek['ayar_komisyon']/100)+$urun_cek['urun_fiyat']*1;
                    }
                 
                  
                  ?>₺</td>
                 <td><center><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<? echo $say;?>" data-whatever="@mdo"><i class="fa fa-eye" aria-hidden="true"></i></button></center></td>
          </tr>

<div class="modal fade" id="exampleModal<? echo $say; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<? echo $say; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><? if($satis_cek['satis_durum']=="1"){echo "Hesap Bilgisi";}else{echo "Key Bilgisi";} ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" method="post">
          <div align="center" class="form-group">
              
            <label  for="recipient-name" class="col-form-label"><? echo $satis_cek['satis_bilgi']; ?></label>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" name="destekac" id="btnSubmit" class="btn btn-primary">Talep Gönder</button>
      </div>
      </form>
    </div>
  </div>
</div>

          <?php  }

          ?>
                 
                  </tfoot>
                </table>
              </div>
              <? } else{ ?>
                
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ürün</th>
                    <th>Satın Alan</th>
                    <th>Tarih</th>
                    <th>Fiyat</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($satis_cek=$satis_sor2->fetch(PDO::FETCH_ASSOC)) {
                    if($satis_cek['satis_tarih2']==date("d/m/Y"))
        {
                  $say++;
                  $urun_sor=$db->prepare("SELECT * FROM urun where urun_id={$satis_cek['urun_id']}");
                 $urun_sor->execute();
                  $urun_cek=$urun_sor->fetch(PDO::FETCH_ASSOC);
                  $kullanici_sor=$db->prepare("SELECT * FROM kullanici where k_id={$satis_cek['k_id']}");
                 $kullanici_sor->execute();
                  $kullanici_cek=$kullanici_sor->fetch(PDO::FETCH_ASSOC);
                  ?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td><?php echo '<a href="'.$ayarcek['ayar_url'].'urun/'.seo($urun_cek["urun_isim"]).'/'.$urun_cek["urun_id"].'" target="_blank">'.$urun_cek['urun_isim'].'</a>'; ?></td>
                 <td><?php
                 if($satis_cek['k_id']!=0){
                 echo $kullanici_cek['k_isim'];
                 }
                 else
                 {
                     echo "Misafir Hesap";
                 }
                 /*
                 $detay = $ssscek['sss_aciklama'];
                  $uzunluk = strlen($detay);
                  $limit = 50;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo strip_tags($detay); 
                  */
                  ?></td>
                  <td><? echo $satis_cek['satis_tarih']; ?></td>
                  <td><? 
                   if($ayarcek['ayar_komisyon']==0)
                    {
                     echo  $urun_cek['urun_fiyat']; 
                    }
                    else
                    {
                        echo $urun_cek['urun_fiyat']*1*($ayarcek['ayar_komisyon']/100)+$urun_cek['urun_fiyat']*1;
                    }
                 
                  
                  ?>₺</td>
                 <td><center><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<? echo $say;?>" data-whatever="@mdo"><i class="fa fa-eye" aria-hidden="true"></i></button></center></td>
          </tr>

<div class="modal fade" id="exampleModal<? echo $say; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<? echo $say; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><? if($satis_cek['satis_durum']=="1"){echo "Hesap Bilgisi";}else{echo "Key Bilgisi";} ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div align="center" class="form-group">
              
            <label  for="recipient-name" class="col-form-label"><? echo $satis_cek['satis_bilgi']; ?></label>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
              
              <? }}}?>
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