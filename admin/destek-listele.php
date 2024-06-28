<?php include 'header.php'; 

$destek=$db->prepare("SELECT * FROM mesaj where destek_id=:id ORDER BY mesaj_id DESC");
$destek->execute(array(
 'id' => $_GET['id']
  ));
  
$say=$destek->rowCount();
  $destekk=$db->prepare("SELECT * FROM destek where destek_id=:id");
$destekk->execute(array(
 'id' => $_GET['id']
  ));
    $destekcekk=$destekk->fetch(PDO::FETCH_ASSOC);
    
$desteklist=$db->prepare("SELECT * FROM destek ORDER BY destek_sontarih DESC");
$desteklist->execute();

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Destek</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
              <li class="breadcrumb-item active">Destek</li>
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

<div class="container">
<h3 class=" text-center">Konu: <? echo htmlspecialchars($destekcekk['destek_konu']); ?></h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Kullanıcılar</h4>
            </div>
            
          </div>
          <div class="inbox_chat">
              
              <? foreach($desteklist as $list){ 
                  $desteksors=$db->prepare("SELECT * FROM mesaj where destek_id={$list['destek_id']} ORDER BY mesaj_id DESC");
            $desteksors->execute();
            $mesajisim=$desteksors->fetch(PDO::FETCH_ASSOC); 
            
              $destek2=$db->prepare("SELECT * FROM kullanici where k_id=:id");
$destek2->execute(array(
 'id' => $mesajisim['kullanici_id']
  ));
  $destekcek=$destek2->fetch(PDO::FETCH_ASSOC);
  
$destekj=$db->prepare("SELECT * FROM kullanici where k_id=:id");
$destekj->execute(array(
 'id' => $list['kullanici_id']
  ));
  $destekcekc=$destekj->fetch(PDO::FETCH_ASSOC);
 
          $desteksor3=$db->prepare("SELECT * FROM mesaj where destek_id={$list['destek_id']} ORDER BY mesaj_id DESC");
            $desteksor3->execute();
            $destekcek3=$desteksor3->fetch(PDO::FETCH_ASSOC);    
              ?>
              <a href="?id=<? echo $list['destek_id']; ?>">
            <div class="chat_list <? if($_GET['id']==$list['destek_id']){echo 'active_chat';} ?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="../assets/images/unknown.jpg" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5><? echo $destekcekc['k_isim']; ?> <span class="chat_date"><? echo timeConvert($destekcek3['mesaj_sontarih']); ?></span></h5>
                  <p><? $detay = strip_tags($destekcek3['mesaj_text']);
                  $uzunluk = strlen($detay);
                  $limit = 20;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                 if(empty($destekcek['k_id'])){echo 'Yönetici: '.$detay;}else{echo $destekcek['k_isim'].': '.$detay;}
                 ?></p>
                </div>
              </div>
            </div>
            </a>
            <? } ?>
            
            
           
           
           
          </div>
        </div>
        <div class="mesgs">
            
          <div class="msg_history">
               <? foreach($destek as $result){
         
            ?> 
            <? if($result["kullanici_id"]==0){ ?>
            
            <div class="outgoing_msg">
              <div class="sent_msg">
              <p> <? echo htmlspecialchars($result['mesaj_text']); ?></p>
                <span class="time_date"> <?echo timeConvert($result['mesaj_sontarih'])?></span> </div>
            </div>
            <? }else{?>
        <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="../assets/images/unknown.jpg" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                 <p><? echo htmlspecialchars($result['mesaj_text']); ?></p>
                  <span class="time_date"><? echo timeConvert($result['mesaj_sontarih'])?></span></div>
              </div>
            </div>
            <? }?>
           <? }?>
           
           
          </div>
          <?php 
            $sayy=0;
            if(isset($_POST["mesajgonder"]))
            {
              if(!empty($_POST['mesaj_text'])){
            if($sayy<=1){
          $ayarkaydet=$db->prepare("INSERT INTO mesaj SET
            destek_id=:destek_id,
            kullanici_id=:kullanici_id,
            mesaj_text=:mesaj_text,
            mesaj_sontarih=:mesaj_sontarih
            ");
        
          $update=$ayarkaydet->execute(array(
            'destek_id' => $_GET['id'],
            'kullanici_id' => 0,
            'mesaj_text' => htmlspecialchars($_POST['mesaj_text']),
            'mesaj_sontarih' => date("d-m-Y H:i:s")
            ));
            
            $ayarkaydet2=$db->prepare("UPDATE destek SET
            destek_sontarih=:destek_sontarih,
            destek_durum=:destek_durum
            where destek_id={$_GET['id']}");
        
          $update2=$ayarkaydet2->execute(array(
            'destek_sontarih' => date("d-m-Y H:i:s"),
            'destek_durum' => 2
            ));
            if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Mesajınız Gönderilmiştir.\", \"success\");</script>";
 header("Refresh: 2; url=".$url);
  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
  }
            }else{
                header("Refresh:0; url=".$url);
            }
            }
            else{
                echo "<script type=\"text/javascript\">swal(\"Hata!\", \"Lütfen mesajınızı boş bırakmayın.\", \"error\");</script>";
 header("Refresh: 2; url=".$url);
            }
            }
            
            
            ?> 
            <? if($destekcekk['destek_durum']!=0){ ?>
            <form  action="" method="post"> 
          <div class="type_msg">
            <div class="input_msg_write">
              <textarea type="text" style="width:76%;" name="mesaj_text" class="write_msg" placeholder="Mesajını buraya yaz.." /></textarea>
              <button class="btn btn-primary" name="mesajgonder" style=" background: #05728f none repeat scroll 0 0;
  border: medium none;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 50px;
  position: absolute;
  right: 0;
  top: 2px;
  width: 150px;" id="btnSubmit" type="submit">Mesaj Gönder</button>
            </div>
          </div>
          </form>
          <? }?>
        </div>
      </div>
      
      
     
      
    </div></div>
              
              
          
              
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