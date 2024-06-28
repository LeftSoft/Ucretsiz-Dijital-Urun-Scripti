<?php 
include 'header.php';
$destek=$db->prepare("SELECT * FROM destek where kullanici_id=:id ORDER BY destek_id DESC");
$destek->execute(array(
 'id' => $_SESSION['user_id']
  ));
function destekrand(){
 $karakterler = "1234567890KLMNOPQRSTABCDEFGHIJUVWXYZ0987654321";
 $destekrand = '';
 for($i=0;$i<11;$i++)                    
 {
  $destekrand .= $karakterler{rand() % 46};   
 }
 return $destekrand; 
}
if (!isset($_SESSION['userkullanici_mail'])) {
  header("Location:index");
  exit();
}
if(isset($_POST['destekac']))
{
   if (!isset($_SESSION['userkullanici_mail'])) {
        header("Location:index");
        exit();
    }
    else
    {
if($_POST['destek_konu']!="" || $_POST['mesaj_text']!=""){
  $ayarkaydet=$db->prepare("INSERT INTO destek SET
    destek_rand=:destek_rand,
    kullanici_id=:kullanici_id,
    destek_konu=:destek_konu,
    destek_tarih=:destek_tarih,
    destek_sontarih=:destek_sontarih,
    destek_durum=:destek_durum
    ");

  $update=$ayarkaydet->execute(array(
    'destek_rand' => destekrand(),
    'kullanici_id' => $_SESSION['user_id'],
    'destek_konu' => htmlspecialchars($_POST['destek_konu']),
    'destek_tarih' => date("d-m-Y H:i:s"),
    'destek_sontarih' => date("d-m-Y H:i:s"),
    'destek_durum' => 1
    ));

$ayarkaydet2=$db->prepare("INSERT INTO mesaj SET
    destek_id=:destek_id,
    kullanici_id=:kullanici_id,
    mesaj_text=:mesaj_text,
    mesaj_sontarih=:mesaj_sontarih
    ");
$id=$db->lastInsertId();
  $update2=$ayarkaydet2->execute(array(
    'destek_id' => $id,
    'kullanici_id' => $_SESSION['user_id'],
    'mesaj_text' => htmlspecialchars($_POST['mesaj_text']),
    'mesaj_sontarih' => date("d-m-Y H:i:s")
    ));
    
  if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Destek Talebi Oluşturuldu!\", \"success\");</script>";
 header("Refresh: 2; url=".$url);
  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
  }
    }
    else{
    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Lütfen alanları doldurunuz.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
}
}


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

        </style>
        <script  language="JavaScript">
$(document).ready(function() {
    $(".number").keydown(function (e) {
       
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode == 88 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
            
        }
    });
});


 </script>
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
                    <div class="author-card-avatar"><img src="assets/images/unknown.jpg" alt="Daniel Adams">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg"><? echo $_SESSION['user_adi'];?></h5>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item <? if($_GET['durum']=="kullanici" || $uri=="hesabim1") {echo 'active';}?>" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=kullanici"><i class="fa fa-user text-muted"></i>Kullanıcı Bilgisi</a>
                    <a class="list-group-item <? if($_GET['durum']=="satin") {echo 'active';}?>" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=satin"><i class="fa fa-credit-card text-muted"></i>Satın Alınanlar</a>
                   <a class="list-group-item <? if($_GET['durum']=="fatura") {echo 'active';}?>" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=fatura"><i class="fa fa-cubes text-muted"></i>Fatura Bilgileri</a>
                   <a class="list-group-item <? if($_GET['durum']=="destek") {echo 'active';}?>" href="<? echo $ayarcek['ayar_url'];?>hesabim?durum=destek"><i class="fa fa-comments text-muted"></i>Destek Talebi</a>
                </nav>
            </div>
        </div>
        <?
            $k_sor=$db->prepare("SELECT * FROM kullanici where k_id=:id");
    $k_sor->execute(array(
    'id' => $_SESSION["user_id"]
    ));
    $k_cek=$k_sor->fetch(PDO::FETCH_ASSOC);
        $bolun = explode(" ", $k_cek['k_isim']);
        if(isset($_POST['kullanicikaydet']))
        {
            if(!empty($_POST['isim']) && !empty($_POST['soyisim'])){
            $ayarkaydet=$db->prepare("UPDATE kullanici SET
    k_isim=:k_isim
    where k_id={$_SESSION['user_id']}");

  $update=$ayarkaydet->execute(array(
    'k_isim' => $_POST['isim']." ".$_POST['soyisim']
    ));
    if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Kullanıcı Bilgisi Güncellendi!\", \"success\");</script>";
 header("Refresh: 2; url=".$url);
  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
  }
        }
            else
            {
                echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Lütfen boş alanları doldurun.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
            }
            
            
        }
        
        if(isset($_POST['sifrekaydet']))
        {
            if(md5($_POST['eski']) != $k_cek['k_sifre'])
            
        {
            echo "<script type=\"text/javascript\">swal(\"Başarısız!\", \"Mevcut Şifren Uyuşmuyor.\", \"error\");</script>";
             header("Refresh:2");
            
        }
        else{
            if($_POST['yeni1']!=$_POST['eski']){
                
       
            $kullanici_passwordone = $_POST['yeni1'];
            $kullanici_passwordtwo = $_POST['yeni2'];
            if ($kullanici_passwordone==$kullanici_passwordtwo) {

        if (strlen($kullanici_passwordone)>=8) 
        {
        
        $ayarkaydet=$db->prepare("UPDATE kullanici SET
    k_sifre=:k_sifre
    where k_id={$_SESSION['user_id']}");

  $update=$ayarkaydet->execute(array(
    'k_sifre' => md5($_POST['yeni1'])
    ));
    if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Şifre Güncellendi!\", \"success\");</script>";
 header("Refresh: 2; url=".$url);
  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
  }

        } 

        else {

            echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Şifre 8 karakterden fazla olmalıdır.\", \"error\");</script>";
header("Refresh:2");
        }

    } 
    else
    {
        echo "<script type=\"text/javascript\">swal(\"Başarısız!\", \"Girdiğiniz şifreler eşleşmiyor.\", \"error\");</script>";
               header("Refresh:2");
    }
            }
            else
            {
                echo "<script type=\"text/javascript\">swal(\"Başarısız!\", \"Mevcut şifrenle yeni şifren bir olamaz.\", \"error\");</script>";
                 header("Refresh:2");
            }
        }
            
            
            
        }
        if(isset($_POST['adreskaydet']))
        {
            if(empty($_POST['k_adres']) || empty($_POST['k_sehir']) || empty($_POST['k_posta']) || empty($_POST['k_tel']))
            {
                echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Lütfen boş alanları doldurun.\", \"error\");</script>";
     header("Refresh: 1; url=".$url); 
            }
             else
            {
                
            
            $ayarkaydet=$db->prepare("UPDATE kullanici SET
    k_adres=:k_adres,
    k_sehir=:k_sehir,
    k_posta=:k_posta,
    k_tel=:k_tel
    where k_id={$_SESSION['user_id']}");

  $update=$ayarkaydet->execute(array(
    'k_adres' => $_POST['k_adres'],
    'k_sehir' => $_POST['k_sehir'],
    'k_posta' => $_POST['k_posta'],
    'k_tel' => $_POST['k_tel']
    ));
    if ($update) {

    echo "<script type=\"text/javascript\">swal(\"Başarılı!\", \"Adres Bilgisi Güncellendi!\", \"success\");</script>";
 header("Refresh: 2; url=".$url);
  } else {

    echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Veritabanı bağlantısı başarısız.\", \"error\");</script>";
     header("Refresh: 1; url=".$url);
  }
  
            }    
           
        }
        
        
         ?>
        
        <? if($_GET['durum']=="kullanici" || $uri=="hesabim1") {?>
        <div style="background-color: #fff; width:700px; height:810px;" align="center">
        <div class="col-lg-8" >
                            <div class="billing-inforamtion-box">
                                <br>
                                <h4>Kullanıcı Bilgisi</h4>
                                <form action="" method="post" class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>İsim</label>
                                                <input style="text-align:center;" type="text" name="isim" value="<? echo $bolun[0];?>">
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Soyisim</label>
                                                <input style="text-align:center;" type="text" name="soyisim" value="<? echo $bolun[1];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-item">
                                        <label>E-Posta</label>
                                        <input type="mail" disabled name="mail" value="<? echo $_SESSION['userkullanici_mail'];?>">
                                    </div>
                                    <button type="submit" id="btnSubmit" class="btn btn-primary" name="kullanicikaydet">Kaydet</button>
                                    </form>
                                    <br>
                                    <form action="" method="post" class="billing-form">
                                    <h4>Şifre Değiştirme</h4>
                                    <div class="input-item">
                                        <label>Eski Şifre</label>
                                        <input type="text" name="eski">
                                    </div>

                                    <div class="input-item">
                                        <label>Yeni Şifre</label>
                                        <input type="text" name="yeni1">
                                    </div>

                                    <div class="input-item">
                                        <label>Yeni Şifre Tekrar</label>
                                        <input type="text" name="yeni2">
                                    </div>
                            <div >
                                <button type="submit" id="btnSubmit" class="btn btn-primary" name="sifrekaydet">Kaydet</button>
                            </div>
                                </form>
                            </div>
                        </div>
        </div>
        <? } else if($_GET['durum']=="satin"){
        
        $satissor=$db->prepare("SELECT * FROM satis where k_id={$_SESSION['user_id']}");
        $satissor->execute();
        
        ?>
         <div class="col-lg-8 pb-5">
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Ürün</th>
                            <th>Alış Tarihi</th>
                            <th>Durum</th>
                            <th>Göster</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? $a=0; while($satiscek=$satissor->fetch(PDO::FETCH_ASSOC)){ $a++;
                            $urunlersor=$db->prepare("SELECT * FROM urun where urun_id={$satiscek['urun_id']}");
                            $urunlersor->execute();
                            $urunlercek=$urunlersor->fetch(PDO::FETCH_ASSOC)
                            ?>
                        <tr>
                            <td><? echo $satiscek['satis_rand']; ?></td>
                             <td><a class="navi-link" href="urun/<?=seo($urunlercek['urun_isim']).'/'.$urunlercek["urun_id"]?>"><? echo $urunlercek['urun_isim']; ?></a></td>
                            <td><? echo $satiscek['satis_tarih']; ?></td>
                            <td><span class="badge badge-success m-0"><? if($satiscek['satis_durum']=="1"){echo "Hesap Alımı";}else{echo "Key Alımı";} ?></span></td>
                             <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<? echo $a;?>" data-whatever="@mdo"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                        </tr>
                       <? }?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <? } else if($_GET['durum']=="fatura"){?>
        <div style="background-color: #fff; width:700px; height:600px;" align="center">
         <div class="col-lg-8">
                            <div class="billing-inforamtion-box"><br>
                                <h4>Adres Bilgisi</h4>
                                <form action="" method="post" class="billing-form">

                                    <div class="input-item">
                                        <label>Adres</label>
                                        <input type="text"  name="k_adres" value="<? echo $k_cek['k_adres'];?>" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Şehir</label>
                                        <input type="text" name="k_sehir" value="<? echo $k_cek['k_sehir'];?>" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Posta Kodu</label>
                                        <input type="text" class="number" name="k_posta" value="<? echo $k_cek['k_posta'];?>" required>
                                    </div>
                                     <div class="input-item">
                                        <label>Telefon</label>
                                        <input type="text" maxlength="11"  class="number" name="k_tel" value="<? if(!empty($k_cek['k_tel'])){echo $k_cek['k_tel'];}else{echo '0';}?>" required>
                                    </div>
                            <div >
                                <button type="submit" id="btnSubmit" class="btn btn-primary" name="adreskaydet">Kaydet</button>
                            </div>
                                </form>
                            </div>
                        </div>
                        </div>
        <? } else if($_GET['durum']=="destek"){?>
        <div class="col-lg-8 pb-5">
            <div class="d-flex justify-content-end pb-3">
                <div class="form-inline">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Destek Talebi Aç</button>
                  
                   
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Destek ID#</th>
                            <th>Destek Konu</th>
                            <th>Destek Tarihi</th>
                            <th>Durum</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($destekcek=$destek->fetch(PDO::FETCH_ASSOC)){?>
                        <tr>
                            <td><a class="navi-link" href="destek?id=<? echo $destekcek['destek_id']; ?>" ><? echo $destekcek["destek_rand"]; ?></a></td>
                            <td><? 
                            $detay = strip_tags($destekcek['destek_konu']);
                  $uzunluk = strlen($detay);
                  $limit = 10;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo $detay;
                  ?></td>
                            <td><? echo $destekcek["destek_tarih"]; ?></td>
                            <td><span class="<? if($destekcek['destek_durum']=='1'){echo 'badge badge-warning m-0';}else if($destekcek['destek_durum']=='2'){echo 'badge badge-success m-0';}else if($destekcek['destek_durum']=='0'){echo 'badge badge-danger m-0';} ?>"><? if($destekcek["destek_durum"]=="1"){echo "Bekliyor";}else if($destekcek['destek_durum']=='2'){echo 'Cevaplandı';}else if($destekcek['destek_durum']=='0'){echo 'Kapandı';} ?></span></td>
                        </tr>
                        <? }?>
                    </tbody>
                </table>
            </div>
        </div>
         <? } ?>
        <!-- 
        <div class="col-lg-8 pb-5">
            <div class="d-flex justify-content-end pb-3">
                <div class="form-inline">
                    <label class="text-muted mr-3" for="order-sort">Sort Orders</label>
                    <select class="form-control" id="order-sort">
                        <option>All</option>
                        <option>Delivered</option>
                        <option>In Progress</option>
                        <option>Delayed</option>
                        <option>Canceled</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date Purchased</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal">78A643CD409</a></td>
                            <td>August 08, 2017</td>
                            <td><span class="badge badge-danger m-0">Canceled</span></td>
                            <td><span>$760.50</span></td>
                        </tr>
                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal">34VB5540K83</a></td>
                            <td>July 21, 2017</td>
                            <td><span class="badge badge-info m-0">In Progress</span></td>
                            <td>$315.20</td>
                        </tr>
                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal">112P45A90V2</a></td>
                            <td>June 15, 2017</td>
                            <td><span class="badge badge-warning m-0">Delayed</span></td>
                            <td>$1,264.00</td>
                        </tr>
                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal">28BA67U0981</a></td>
                            <td>May 19, 2017</td>
                            <td><span class="badge badge-success m-0">Delivered</span></td>
                            <td>$198.35</td>
                        </tr>
                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal">502TR872W2</a></td>
                            <td>April 04, 2017</td>
                            <td><span class="badge badge-success m-0">Delivered</span></td>
                            <td>$2,133.90</td>
                        </tr>
                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal">47H76G09F33</a></td>
                            <td>March 30, 2017</td>
                            <td><span class="badge badge-success m-0">Delivered</span></td>
                            <td>$86.40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       -->
        
        
        
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Destek Talebi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Konu:</label>
            <input type="text" class="form-control" name="destek_konu" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Mesaj:</label>
            <textarea class="form-control" name="mesaj_text" id="message-text"></textarea>
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

<? 
$satissor2=$db->prepare("SELECT * FROM satis where k_id={$_SESSION['user_id']}");
$satissor2->execute();
$rast=0;
while($satiscek2=$satissor2->fetch(PDO::FETCH_ASSOC)){ $rast++;?>
<div class="modal fade" id="exampleModal<? echo $rast; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<? echo $rast; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><? if($satiscek2['satis_durum']=="1"){echo "Hesap Bilgisi";}else{echo "Key Bilgisi";} ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div align="center" class="form-group">
              
            <label  for="recipient-name" class="col-form-label"><? echo $satiscek2['satis_bilgi']; ?></label>
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
<? } ?>



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