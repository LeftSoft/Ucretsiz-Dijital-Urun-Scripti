<?php include 'header.php'; 
session_start();
if($_SESSION['check'] != 1 && empty($_SESSION['check']))
{
    header("Location: index");
}
else{
    
    $shopping_products = unserialize($_COOKIE['durum2']);
    if($_COOKIE['durum'] != 0)
    {
      $_SESSION['user_adi'] = $_COOKIE['durum5'];
       $_SESSION['user_id'] = $_COOKIE['durum'];
       $_SESSION['userkullanici_mail'] = $_COOKIE['durum3'];
    }
    
 if(!empty($_SESSION['user_id'])){
     $sayi=0;
      foreach($shopping_products as $product)
      {
          
          
          $urunsor3=$db->prepare("SELECT * FROM urun where urun_id={$product->urun_id}");
                            $urunsor3->execute();
                    $uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);
                    
                    
                    if($uruncek3['urun_anahtar']==0){
                    
                    
                    for ($i=0; $i < $product->count; $i++) { 
                        $sayi++;
                        $anahtarsor=$db->prepare("SELECT * FROM anahtar where urun_id={$product->urun_id}");
                            $anahtarsor->execute();
                    $anahtarcek=$anahtarsor->fetch(PDO::FETCH_ASSOC);
                $ayarkaydet=$db->prepare("INSERT INTO satis SET
                k_id=:k_id,
                urun_id=:urun_id,
                satis_bilgi=:satis_bilgi,
                satis_rand=:satis_rand,
                satis_durum=:satis_durum,
                satis_tarih=:satis_tarih,
                satis_tarih2=:satis_tarih2
                ");
        
              $update=$ayarkaydet->execute(array(
                'k_id' => $_SESSION['user_id'],
                'urun_id' => $product->urun_id,
                'satis_bilgi' => $anahtarcek['key_text'],
                'satis_rand' => $_COOKIE['durum4'],
                'satis_durum' => 0,
                'satis_tarih' => date("d/m/Y h:m"),
                'satis_tarih2' => date("d/m/Y")
                ));
                $ayarkaydet2=$db->prepare("UPDATE urun SET
                urun_satis=:urun_satis
                where urun_id={$product->urun_id}
                ");
        
              $update2=$ayarkaydet2->execute(array(
                'urun_satis' => $uruncek3['urun_satis']+$sayi,
                
                ));
                  $sil=$db->prepare("DELETE from anahtar where key_id=:key_id");
                  $kontrol=$sil->execute(array(
                    'key_id' => $anahtarcek['key_id']
                    ));
                  
                    }
                if ($update) {
                    
         
  } else {
$_SESSION['NotifySfy'] = 2;
$_SESSION['check'] = 1;
    
  
  }
                    }
                     else{
                       $sayi=0;
                      for ($i=0; $i < $product->count; $i++) { 
                          $sayi++;
                        $anahtarsor=$db->prepare("SELECT * FROM hesap where urun_id={$product->urun_id}");
                            $anahtarsor->execute();
                     $anahtarcek=$anahtarsor->fetch(PDO::FETCH_ASSOC);
                $ayarkaydet=$db->prepare("INSERT INTO satis SET
                k_id=:k_id,
                urun_id=:urun_id,
                satis_bilgi=:satis_bilgi,
                satis_rand=:satis_rand,
                satis_durum=:satis_durum,
                satis_tarih=:satis_tarih,
                satis_tarih2=:satis_tarih2
                ");
        
              $update=$ayarkaydet->execute(array(
                'k_id' => $_SESSION['user_id'],
                'urun_id' => $product->urun_id,
                'satis_bilgi' => $anahtarcek['hesap_text'],
                'satis_rand' => $_COOKIE['durum4'],
                'satis_durum' => 1,
                'satis_tarih' => date("d/m/Y h:m"),
                'satis_tarih2' => date("d/m/Y")
                ));
                $ayarkaydet2=$db->prepare("UPDATE urun SET
                urun_satis=:urun_satis
                where urun_id={$product->urun_id}
                ");
        
              $update2=$ayarkaydet2->execute(array(
                'urun_satis' => $uruncek3['urun_satis']+$sayi,
                
                ));
                $sil=$db->prepare("DELETE from hesap where hesap_id=:hesap_id");
                  $kontrol=$sil->execute(array(
                    'hesap_id' => $anahtarcek['hesap_id']
                    ));
                   
                    }
                    if ($update) {
                   
                    
  } else {
$_SESSION['NotifySfy'] = 2;
$_SESSION['check'] = 1;

  
  }
                    
                    }
      }
      
      } else{
          
          $_SESSION["gecici"]=1;
          $sayi=0;
          
          
          
          
          foreach($shopping_products as $product)
      {
          
          
          $urunsor3=$db->prepare("SELECT * FROM urun where urun_id={$product->urun_id}");
                            $urunsor3->execute();
                    $uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);
                    
                    
                    if($uruncek3['urun_anahtar']==0){
                    
                    
                    for ($i=0; $i < $product->count; $i++) { 
                        $sayi++;
                        $anahtarsor=$db->prepare("SELECT * FROM anahtar where urun_id={$product->urun_id}");
                            $anahtarsor->execute();
                    $anahtarcek=$anahtarsor->fetch(PDO::FETCH_ASSOC);
                $ayarkaydet=$db->prepare("INSERT INTO satis SET
                k_id=:k_id,
                urun_id=:urun_id,
                satis_bilgi=:satis_bilgi,
                satis_rand=:satis_rand,
                satis_durum=:satis_durum,
                satis_tarih=:satis_tarih,
                satis_tarih2=:satis_tarih2
                ");
        
              $update=$ayarkaydet->execute(array(
                'k_id' => 0,
                'urun_id' => $product->urun_id,
                'satis_bilgi' => $anahtarcek['key_text'],
                'satis_rand' => $_COOKIE['durum4'],
                'satis_durum' => 0,
                'satis_tarih' => date("d/m/Y h:m"),
                'satis_tarih2' => date("d/m/Y")
                ));
                $ayarkaydet2=$db->prepare("UPDATE urun SET
                urun_satis=:urun_satis
                where urun_id={$product->urun_id}
                ");
        
              $update2=$ayarkaydet2->execute(array(
                'urun_satis' => $uruncek3['urun_satis']+$sayi,
                
                ));
                  $sil=$db->prepare("DELETE from anahtar where key_id=:key_id");
                  $kontrol=$sil->execute(array(
                    'key_id' => $anahtarcek['key_id']
                    ));
                    
                    }
                if ($update) {
                        
       //            header("Location: index?durum?anahtar=ok");
                    
  } else {
     // header("Location: index?durum?anahtar=no");
$_SESSION['NotifySfy'] = 2;
$_SESSION['check'] = 1;
    
  }
                    }
                     else{
                       $sayi=0;
                      for ($i=0; $i < $product->count; $i++) { 
                          $sayi++;
                        $anahtarsor=$db->prepare("SELECT * FROM hesap where urun_id={$product->urun_id}");
                            $anahtarsor->execute();
                     $anahtarcek=$anahtarsor->fetch(PDO::FETCH_ASSOC);
                $ayarkaydet=$db->prepare("INSERT INTO satis SET
                k_id=:k_id,
                urun_id=:urun_id,
                satis_bilgi=:satis_bilgi,
                satis_rand=:satis_rand,
                satis_durum=:satis_durum,
                satis_tarih=:satis_tarih,
                satis_tarih2=:satis_tarih2
                ");
        
              $update=$ayarkaydet->execute(array(
                'k_id' => 0,
                'urun_id' => $product->urun_id,
                'satis_bilgi' => $anahtarcek['hesap_text'],
                'satis_rand' => $_COOKIE['durum4'],
                'satis_durum' => 1,
                'satis_tarih' => date("d/m/Y h:m"),
                'satis_tarih2' => date("d/m/Y")
                ));
                $ayarkaydet2=$db->prepare("UPDATE urun SET
                urun_satis=:urun_satis
                where urun_id={$product->urun_id}
                ");
        
              $update2=$ayarkaydet2->execute(array(
                'urun_satis' => $uruncek3['urun_satis']+$sayi,
                
                ));
                $sil=$db->prepare("DELETE from hesap where hesap_id=:hesap_id");
                  $kontrol=$sil->execute(array(
                    'hesap_id' => $anahtarcek['hesap_id']
                    ));
                    
                    }
                    if ($update) {
                       // header("Location: index?durum?hesap=ok");
                   
                    
  } else {
     // header("Location: index?durum?anahtar=no");
$_SESSION['NotifySfy'] = 2;
$_SESSION['check'] = 1;

  }
                    
                    }
      }
          
          
          }
          
}    
?>


        <!-- banner section start -->
        <section class="banner-section page-banner bg-gra4">
            <div class="shape-layer">
                <div class="circle-shape-2" data-depth="0.2"></div>
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="banner-text text-center text-lg-left">
                        <h1 class="title">Ödeme</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ödeme</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90 bg-gray1">
            <div class="container">
                <div class="checkout-content box">
                    <div class="row" >
                     <?php if($_SESSION['NotifySfy'] == 1){ 
                     setcookie('durum', '_', time() - 300, '/');
                     setcookie('durum2', '_', time() - 300, '/');
                     setcookie('durum3', '_', time() - 300, '/');
                     setcookie('durum5', '_', time() - 300, '/');
                     $_SESSION['check'] = 0;
                     ?>
                     <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
 <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
   <span class="swal2-success-line-tip"></span>
   <span class="swal2-success-line-long"></span>
   <div class="swal2-success-ring"></div> 
   <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
   <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
  </div>
                        <?php if(!empty($_SESSION['user_id'])){ ?>
                        <div class="col-lg-12">
                            <div class="order-product-info">
                                <h4 align="center">Ödeme İşlemi Başarılı!</h4>
                                 <p align="center">Bilgileri <b><a href="hesabim?durum=satin">satın alınanlar</a></b> ekranından görebilirsiniz.</p>
                             
                            </div>
                        </div>
                          <?php } else if($_SESSION["gecici"]==1){
                               $randsor=$db->prepare("SELECT * FROM satis where k_id=0 and satis_rand={$_COOKIE['durum4']}");
                            $randsor->execute();
                            $randcek=$randsor->fetch(PDO::FETCH_ASSOC);
                            $randart = $randsor->rowCount();
                          ?>
                          <div class="col-lg-12">
                            <div class="order-product-info">
                                <h4 align="center">Ödeme İşlemi Başarılı!</h4>
                                <p style="text-align: center;"><b>#Sipariş ID:</b> <?php echo $_COOKIE['durum4'];?> <b>(Sipariş ID'yi kaybetmeyin.)</b></p>
                                <h5 align="center">Hesap Bilgileri:</h5>
                                <? 
                                $randsor2=$db->prepare("SELECT * FROM satis where k_id=0 and satis_rand={$_COOKIE['durum4']}");
                            $randsor2->execute();
                            $ransay=0;
                                while($randcek2=$randsor2->fetch(PDO::FETCH_ASSOC)){
                                $ransay++;
                                
                                ?>
                                 <p align="center"><b><? if($randcek2['satis_durum'] == "1"){echo "Hesap Bilgisi #";}else{echo "Key Bilgisi #";} ?><? echo $ransay; ?>:</b> <? echo $randcek2["satis_bilgi"]; ?></p>
                             <?} ?>
                            </div>
                        </div>
                          <? } ?>
                         <?php } else if($_SESSION['NotifySfy'] == 3){ 
                         setcookie('durum', '_', time() - 300, '/');
                         setcookie('durum2', '_', time() - 300, '/');
                         setcookie('durum3', '_', time() - 300, '/');
                         setcookie('durum4', '_', time() - 300, '/');
                         setcookie('durum5', '_', time() - 300, '/');
                         $_SESSION['check'] = 0;
                         unset($_SESSION["gecici"]);
                         ?>
                         
                        
  <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
      <span class="swal2-x-mark">
          <span class="swal2-x-mark-line-left">
          </span>
          <span class="swal2-x-mark-line-right">
          </span>
          </span>
          </div>
                        <div class="col-lg-12">
                            <div class="order-product-info">
                                <h4 align="center">Ödeme İşlemi Başarısız!</h4>
                                 <p align="center">Ödeme işleminiz tamamlanmadı lütfen tekrar deneyin.</p>
                             
                            </div>
                        </div>
                         
                         <? }
             /*            
        unset($_SESSION['check']);
        unset($_SESSION['NotifySfy']);
        unset($_SESSION["shoppingCart"]["products"]);
        unset($_SESSION["shoppingCart"]["summary"]);
        unset($_SESSION["shoppingCart"]);
        unset($_SESSION["shoppingCart"]);
        unset($_SESSION['isim']);
        unset($_SESSION['soy']);
        unset($_SESSION['mail']);
        unset($_SESSION['adres']);
        unset($_SESSION['sehir']);
        unset($_SESSION['posta']);
        unset($_SESSION['tel']);
        */
        
                         ?>
                    </div>
                </div>
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
