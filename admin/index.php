<?php 
include 'header.php'; 

 $k_sor=$db->prepare("SELECT * FROM kullanici");
    $k_sor->execute();
    $ksay=$k_sor->rowCount();
$siparis_sor=$db->prepare("SELECT * FROM satis");
    $siparis_sor->execute();
    $siparissay=$siparis_sor->rowCount();
$urun_sor=$db->prepare("SELECT * FROM urun");
    $urun_sor->execute();
    $urunsay=$urun_sor->rowCount();
  
    $satis_sor=$db->prepare("SELECT * FROM satis where satis_tarih2");
    $satis_sor->execute();
    $satissay=0;
    while($satis_cek=$satis_sor->fetch(PDO::FETCH_ASSOC))
    {
        if($satis_cek['satis_tarih2']==date("d/m/Y"))
        {
            $satissay++;
        }
    }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Anasayfa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active">Gösterge Paneli</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><? echo $siparissay; ?></h3>

                <p>Toplam Satışlar</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="satis-listele" class="small-box-footer">Daha Fazla Bilgi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><? echo $satissay; ?></h3>

                <p>Bugünkü Satışlar</p>
              </div>
              <div class="icon">
                <i class="fa fa-usd"></i>
              </div>
              <a href="satis-listele?s=bugun" class="small-box-footer">Daha Fazla Bilgi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><? echo $ksay; ?></h3>

                <p>Toplam Kullanıcı</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="kullanici-listele" class="small-box-footer">Daha Fazla Bilgi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box badge-primary">
              <div class="inner">
                <h3><? echo $urunsay; ?></h3>

                <p>Eklenen Ürünler</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="urun-listele" class="small-box-footer">Daha Fazla Bilgi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
       
        </div>
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->
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
<?php include 'js.php'; ?>
</body>
</html>
