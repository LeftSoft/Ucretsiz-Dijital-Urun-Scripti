<?php 
include 'header.php';
if (!isset($_SESSION['userkullanici_mail'])) {
  header("Location:index");
  exit();
}
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
    if($say==0)
    {
        header("Location:hesabim?durum=destek");
  exit();
    }
?>
<style type="text/css">
         body{
    background:#eee;    
}
.main-container{
    margin-top:40px;    
}
.widget-author {
  margin-bottom: 58px;
}
.author-card {
  position: relative;
  padding-bottom: 48px;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .09);
}
.author-card .author-card-cover {
  position: relative;
  width: 100%;
  height: 100px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.author-card .author-card-cover::after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: '';
  opacity: 0.5;
}
.author-card .author-card-cover > .btn {
  position: absolute;
  top: 12px;
  right: 12px;
  padding: 0 10px;
}
.author-card .author-card-profile {
  display: table;
  position: relative;
  margin-top: -22px;
  padding-right: 15px;
  padding-bottom: 16px;
  padding-left: 20px;
  z-index: 5;
}
.author-card .author-card-profile .author-card-avatar, .author-card .author-card-profile .author-card-details {
  display: table-cell;
  vertical-align: middle;
}
.author-card .author-card-profile .author-card-avatar {
  width: 85px;
  border-radius: 50%;
  box-shadow: 0 8px 20px 0 rgba(0, 0, 0, .15);
  overflow: hidden;
}
.author-card .author-card-profile .author-card-avatar > img {
  display: block;
  width: 100%;
}
.author-card .author-card-profile .author-card-details {
  padding-top: 20px;
  padding-left: 15px;
}
.author-card .author-card-profile .author-card-name {
  margin-bottom: 2px;
  font-size: 14px;
  font-weight: bold;
}
.author-card .author-card-profile .author-card-position {
  display: block;
  color: #8c8c8c;
  font-size: 12px;
  font-weight: 600;
}
.author-card .author-card-info {
  margin-bottom: 0;
  padding: 0 25px;
  font-size: 13px;
}
.author-card .author-card-social-bar-wrap {
  position: absolute;
  bottom: -18px;
  left: 0;
  width: 100%;
}
.author-card .author-card-social-bar-wrap .author-card-social-bar {
  display: table;
  margin: auto;
  background-color: #fff;
  box-shadow: 0 12px 20px 1px rgba(64, 64, 64, .11);
}
.btn-style-1.btn-white {
    background-color: #fff;
}
.list-group-item i {
    display: inline-block;
    margin-top: -1px;
    margin-right: 8px;
    font-size: 1.2em;
    vertical-align: middle;
}
.mr-1, .mx-1 {
    margin-right: .25rem !important;
}

.list-group-item.active:not(.disabled) {
    border-color: #e7e7e7;
    background: #fff;
    color: #ac32e4;
    cursor: default;
    pointer-events: none;
}
.list-group-flush:last-child .list-group-item:last-child {
    border-bottom: 0;
}

.list-group-flush .list-group-item {
    border-right: 0 !important;
    border-left: 0 !important;
}

.list-group-flush .list-group-item {
    border-right: 0;
    border-left: 0;
    border-radius: 0;
}
.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: .25rem;
    border-bottom-left-radius: .25rem;
}
a.list-group-item, .list-group-item-action {
    color: #404040;
    font-weight: 600;
}
.list-group-item {
    padding-top: 16px;
    padding-bottom: 16px;
    -webkit-transition: all .3s;
    transition: all .3s;
    border: 1px solid #e7e7e7 !important;
    border-radius: 0 !important;
    color: #404040;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    text-decoration: none;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,0.125);
}

.comment {
    display: block;
    position: relative;
    margin-bottom: 30px;
    padding-left: 66px
}

.comment .comment-author-ava {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    border-radius: 50%;
    overflow: hidden
}

.comment .comment-author-ava>img {
    display: block;
    width: 100%
}

.comment .comment-body {
    position: relative;
    padding: 24px;
    border: 1px solid #e1e7ec;
    border-radius: 7px;
    background-color: #fff
}

.comment .comment-body::after,
.comment .comment-body::before {
    position: absolute;
    top: 12px;
    right: 100%;
    width: 0;
    height: 0;
    border: solid transparent;
    content: '';
    pointer-events: none
}

.comment .comment-body::after {
    border-width: 9px;
    border-color: transparent;
    border-right-color: #fff
}

.comment .comment-body::before {
    margin-top: -1px;
    border-width: 10px;
    border-color: transparent;
    border-right-color: #e1e7ec
}

.comment .comment-title {
    margin-bottom: 8px;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.comment .comment-text {
    margin-bottom: 12px
}

.comment .comment-footer {
    display: table;
    width: 100%
}

.comment .comment-footer>.column {
    display: table-cell;
    vertical-align: middle
}

.comment .comment-footer>.column:last-child {
    text-align: right
}

.comment .comment-meta {
    color: #9da9b9;
    font-size: 13px
}

.comment .reply-link {
    transition: color .3s;
    color: #606975;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: .07em;
    text-transform: uppercase;
    text-decoration: none
}

.comment .reply-link>i {
    display: inline-block;
    margin-top: -3px;
    margin-right: 4px;
    vertical-align: middle
}

.comment .reply-link:hover {
    color: #0da9ef
}

.comment.comment-reply {
    margin-top: 30px;
    margin-bottom: 0
}

@media (max-width: 576px) {
    .comment {
        padding-left: 0
    }
    .comment .comment-author-ava {
        display: none
    }
    .comment .comment-body {
        padding: 15px
    }
    .comment .comment-body::before,
    .comment .comment-body::after {
        display: none
    }
}

        </style>
        <!-- banner section start -->
        <section class="banner-section page-banner bg-gra4">
            <div class="shape-layer">
                <div class="circle-shape-2" data-depth="0.2"></div>
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="banner-text text-center text-lg-left">
                        <h1 class="title">Hesabım</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hesabım</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90">
            <div class="about">
                <div class="container">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-12 text-center">
                            <div class="about-content">
                                
                                
                               
<div class="container mb-4 main-container">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
               
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="assets/images/unknown.jpg">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg"><? echo $_SESSION['user_adi'];?></h5>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=kullanici">
                    <i class="fa fa-user"></i>Kullanıcı Bilgisi</a>
                    <a class="list-group-item" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=satin">
                    <i class="fa fa-credit-card"></i>Satın Alınanlar</a>
                   <a class="list-group-item" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=fatura"><i class="fa fa-cubes text-muted"></i>Fatura Bilgileri</a>
                   <a class="list-group-item active" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=destek"><i class="fa fa-comment-o"></i>Destek Talebi</a>
                </nav>
            </div>
        </div>
        <!-- Orders Table-->
      <?php 
      if(isset($_POST['biletikapat'])){
          if (!isset($_SESSION['userkullanici_mail'])) {
  header("Location:index");
  exit();
}
else{
    $ayarkaydet=$db->prepare("UPDATE destek SET
    destek_durum=:destek_durum
    where destek_id={$_GET['id']}");

  $update=$ayarkaydet->execute(array(
    'destek_durum' => 0
    ));
      if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Destek Talebi Kapatıldı!\", \"success\");</script>";
 header("Refresh: 2; url=".$url);
  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
  }
}
          
          
      }
   
      ?>
       <div class="col-lg-8">
           <? if($destekcekk['destek_durum']!="0"){ ?>
        <form action="" method="post">
            <div align="right">
                
                    <button type="submit" name="biletikapat" class="btn btn-secondary"><i class="fa fa-times"> Destek Kapat</i></button>
                </div>
                </form>
                <?} ?>
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <div class="table-responsive margin-bottom-2x">
                <table class="table margin-bottom-none">
                    <thead>
                        <tr>
                            <th>İletilen Tarih</th>
                            <th>Son Güncelleme</th>
                            <th>Konu</th>
                            <th>Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><? echo timeConvert($destekcekk['destek_tarih']); ?></td>
                            <td><? echo timeConvert($destekcekk['destek_sontarih']); ?></td>
                            <td><? echo $destekcekk['destek_konu']; ?></td>
                            <td><span class="text-<? if($destekcekk['destek_durum']=='1'){echo 'primary';}else if($destekcekk['destek_durum']=='2'){echo 'success';}else if($destekcekk['destek_durum']=='0'){echo 'danger';}?>"><? if($destekcekk['destek_durum']=='1'){echo 'Bekliyor';}else if($destekcekk['destek_durum']=='2'){echo 'Cevaplandı';}else if($destekcekk['destek_durum']=='0'){echo 'Kapandı';}?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive margin-bottom-2x">
            <div style="height: 325px; overflow: scroll; width: 710px;">
            <? foreach($destek as $result){
            $destekyonetici=$db->prepare("SELECT * FROM mesaj where destek_id=:id and kullanici_id=:k_id ORDER BY mesaj_id DESC");
$destekyonetici->execute(array(
 'id' => $_GET['id'],
 'k_id' => $result['kullanici_id']
  ));
  $destekyoneticicek=$destekyonetici->fetch(PDO::FETCH_ASSOC);
            $destek2=$db->prepare("SELECT * FROM kullanici where k_id=:id");
$destek2->execute(array(
 'id' => $result['kullanici_id']
  ));
  $destekcek=$destek2->fetch(PDO::FETCH_ASSOC);
            ?> 
            <!-- Messages-->
            <div class="comment">
                <div class="comment-author-ava"><img src="<?if($destekyoneticicek['kullanici_id']==0){echo 'assets/images/admin.png';}else{echo 'assets/images/unknown.jpg';}?>" alt="Avatar"></div>
                <div class="comment-body">
                    <p class="comment-text"><? echo htmlspecialchars($result['mesaj_text']); ?></p>
                    <div class="comment-footer"><span class="comment-meta"><?  if($destekyoneticicek['kullanici_id']==0){echo "Yönetici"." | ".timeConvert($destekyoneticicek['mesaj_sontarih']);}else{echo $destekcek['k_isim']." | ".timeConvert($result['mesaj_sontarih']);} ?></span></div>
                </div>
            </div>
           
            <? }?>
            </div>
             </div>
            <?php 
            $say=0;
            if(isset($_POST["mesajgonder"]))
            {
                if(!empty($_POST['mesaj_text'])){
                $say++;
                if($destekcekk['destek_durum']!=0){
                if (!isset($_SESSION['userkullanici_mail'])) {
                header("Location:index");
                exit();
            }
            else
            {
            
            if($say<=1){
          $ayarkaydet=$db->prepare("INSERT INTO mesaj SET
            destek_id=:destek_id,
            kullanici_id=:kullanici_id,
            mesaj_text=:mesaj_text,
            mesaj_sontarih=:mesaj_sontarih
            ");
        
          $update=$ayarkaydet->execute(array(
            'destek_id' => $_GET['id'],
            'kullanici_id' => $_SESSION['user_id'],
            'mesaj_text' => htmlspecialchars($_POST['mesaj_text']),
            'mesaj_sontarih' => date("d-m-Y H:i:s")
            ));
            
            $ayarkaydet2=$db->prepare("UPDATE destek SET
            destek_sontarih=:destek_sontarih,
            destek_durum=:destek_durum
            where destek_id={$_GET['id']}");
        
          $update2=$ayarkaydet2->execute(array(
            'destek_sontarih' => date("d-m-Y H:i:s"),
            'destek_durum' => 1
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
            
                }
                else{
                    header("Refresh: 0; url=".$url);
                }
            }
            else{
                echo "<script type=\"text/javascript\">swal(\"Hata!\", \"Lütfen mesajınızı boş bırakmayın.\", \"error\");</script>";
 header("Refresh: 2; url=".$url);
            }
            }
            
            ?> 
            <!-- Reply Form-->
            <? if($destekcekk['destek_durum']!='0'){ ?>
            <h5 class="mb-30 padding-top-1x">Mesaj Bırak</h5>
            <form id="formABC" method="post" action="">
                <div class="form-group">
                    <textarea class="form-control form-control-rounded" id="review_text" rows="8" name="mesaj_text" placeholder="Mesajını buraya yazabilirsin..." required=""></textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" id="btnSubmit" type="submit" name="mesajgonder"><i class="fa fa-reply"> Mesaj Gönder</i></button>
                </div>
            </form>
            <? }?>
        </div>
  
       
       
       
       
    </div>
</div>
                                
                                <!---
                            
                                
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Kullanıcı Bilgisi</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Satın Alınanlar</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Fatura Bilgilerim</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Destek</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="col-lg-12">
                            <div class="billing-inforamtion-box">
                                <h4>Kullanıcı Bilgisi</h4>
                                <form action="#" class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-item">
                                                <label>İsim</label>
                                                <input type="text" name="isim" value="<? echo $_SESSION['user_adi'];?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="input-item">
                                        <label>E-Posta</label>
                                        <input type="mail" disabled name="mail" value="<? echo $_SESSION['userkullanici_mail'];?>">
                                    </div>
                                    <h4>Şifre Değiştirme</h4>
                                    <div class="input-item">
                                        <label>Yeni Şifre</label>
                                        <input type="text" name="yeni">
                                    </div>

                                    <div class="input-item">
                                        <label>Eski Şifre</label>
                                        <input type="text" name="eski">
                                    </div>

                                    <div class="input-item">
                                        <label>Eski Şifre Tekrar</label>
                                        <input type="text" name="eski2">
                                    </div>
                            <div >
                                <button type="submit" class="btn btn-primary" name="kullanicikaydet">Kaydet</button>
                            </div>
                                </form>
                            </div>
                        </div>
      
      
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">AAAAAAAAAAAAAAA</div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
      
      
      
  </div>
</div>
          ---->                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="counter-up-section section-pt-90">
             
            </div>
        </section>
        <!-- page-content section end -->


<?php include 'footer.php'; ?>
        
        

        <script src='assets/js/jquery.min.js'></script>
        <script src='assets/js/bootstrap.bundle.min.js'></script>
        <script src="swiper@6.8.0/swiper-bundle.min.js"></script>
        <script src='assets/js/theia-sticky-sidebar.js'></script>
        <script src='assets/js/waypoints.min.js'></script>
        <script src='assets/js/counterup.min.js'></script>
        <script src='assets/js/custom-select.js'></script>
        <script src='assets/js/lightcase.js'></script>
        <script src='assets/js/functions.js'></script>
    </body>
</html>