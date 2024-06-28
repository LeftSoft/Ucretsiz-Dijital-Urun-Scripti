<?php include 'header.php'; 
$urunsor2=$db->prepare("SELECT * FROM urun");
$urunsor2->execute();


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hesap Ekle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Hesap Ekle</li>
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
                    <th>Hesap Adet</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 

                $say=0;

                while($uruncek=$urunsor2->fetch(PDO::FETCH_ASSOC)) {  if($uruncek['urun_anahtar']=="1"){
                  $say++;
                  $anahtarsor2=$db->prepare("SELECT * FROM hesap where urun_id={$uruncek['urun_id']}");
                $anahtarsor2->execute();
                $hesapsay = $anahtarsor2->rowCount();
                  ?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                  <td><center><a target="_blank" href="../<?php echo $uruncek['urun_resim'] ?>"><img width="50" src="../<?php echo $uruncek['urun_resim'] ?>"></a></center></td>
                 <td><?php echo $uruncek['urun_isim'] ?></td>
                  <td><?php echo $hesapsay; ?></td>
                 <td><center><a href="hesap-ekle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Hesap Ekle</button></a></center></td>
               <td><center><a href="hesap-gor.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Hesap Listele</button></a></center></td>
          </tr>



          <?php  }}

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
