<?php include 'header.php'; 
session_start();
$k_sor=$db->prepare("SELECT * FROM kullanici where k_id=:id");
$k_sor->execute(array(
'id' => $_SESSION["user_id"]
));
$k_cek=$k_sor->fetch(PDO::FETCH_ASSOC);
$bolun = explode(" ", $k_cek['k_isim']);
if($_SESSION['iddurum']!=1)
{
    Header("Location:sepet");

}
else
{
    if($_SESSION["durum"]==0)
{
    header("Location:sepet");
}
}
if(isset($_POST['odeme']))
{
    if($_POST['adres']=="" || $_POST['sehir']=="" || $_POST['posta']=="" ||  $_POST['tel']==""){
        
    
        echo "<script type=\"text/javascript\">swal(\"Başarısız\", \"Lütfen alanları doldurun.\", \"error\");</script>";
        header("Refresh: 1; url=".$url);
    
    }
    else
    {
        if(!empty($_SESSION['user_id'])){
            
            if($k_cek['k_adres']!="" && $k_cek['k_sehir']!="" && $k_cek['k_posta']!="" && $k_cek['k_tel']!=""){
     $ayarkaydet=$db->prepare("UPDATE kullanici SET
    k_adres=:k_adres,
    k_sehir=:k_sehir,
    k_posta=:k_posta,
    k_tel=:k_tel
    WHERE k_id={$_SESSION['user_id']}");
  $update=$ayarkaydet->execute(array(
    'k_adres' => $_POST['adres'],
    'k_sehir' => $_POST['sehir'],
    'k_posta' => $_POST['posta'],
    'k_tel' => $_POST['tel']
    ));

  if ($update) {
     $_SESSION['isim'] = $_POST['isim'];
        $_SESSION['soy'] = $_POST['soy'];
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['adres'] = $_POST['adres'];
        $_SESSION['sehir'] = $_POST['sehir'];
        $_SESSION['posta'] = $_POST['posta'];
        $_SESSION['tel'] = $_POST['tel'];
    header("Location: src/shopier");

  } else {

    header("Refresh: 1; url=".$url);
  }
            }
  
    }
     else
    {
        $_SESSION['isim'] = $_POST['isim'];
        $_SESSION['soy'] = $_POST['soy'];
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['adres'] = $_POST['adres'];
        $_SESSION['sehir'] = $_POST['sehir'];
        $_SESSION['posta'] = $_POST['posta'];
        $_SESSION['tel'] = $_POST['tel'];
        header("Location: src/shopier");
    }
    }
    
   
  
}
?>
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
                     <?php if($total_count > 0){ ?>
                       <?php if(!empty($_SESSION["user_id"])){ 
                       
                       
                       ?>
                      <div class="col-lg-6 pr-lg-4">
                            <div class="billing-inforamtion-box">
                                <h4>Fatura Bilgileri</h4>
                                <form action="" method="post" class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>İsim</label>
                                                <input type="text" name="isim" value="<? echo $bolun[0]; ?>" required>
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Soyisim</label>
                                                <input type="text" name="soy" value="<? echo $bolun[1]; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-item">
                                        <label>Adres</label>
                                        <input type="text" name="adres" value="<? echo $k_cek['k_adres'] ?>" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Şehir</label>
                                        <input type="text" name="sehir" value="<? echo $k_cek['k_sehir']; ?>" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Posta Kodu</label>
                                        <input type="text" name="posta" class="number" value="<? echo $k_cek['k_posta']; ?>" required>
                                    </div>

                                    <div class="input-item">
                                        <label>E-Posta</label>
                                        <input type="email" name="mail" value="<? echo $k_cek['k_mail']; ?>" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Telefon</label>
                                        <input type="text" maxlength="11"  class="number" name="tel" value="<? if(empty($k_cek['k_tel'])){echo "0";}else{ echo $k_cek['k_tel'];} ?>" required>
                                    </div>
                                    <div class="pt-5 text-center">
                                   
                                    <button type="submit" name="odeme" class="cart-btn br3">
                                        Ödeme Yap
                                    </button>
                                  
                                </div>
                                </form>
                                
                            </div>
                            
                        </div>
                        
                          <?php } else{?>
                          
                          <div class="col-lg-6 pr-lg-4">
                            <div class="billing-inforamtion-box">
                                <h4>Fatura Bilgileri</h4>
                                <form action="" method="post" class="billing-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>İsim</label>
                                                <input type="text" name="isim" required>
                                            </div>
                                        </div>
                                         <div class="col-lg-6">
                                            <div class="input-item">
                                                <label>Soyisim</label>
                                                <input type="text" name="soy" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-item">
                                        <label>Adres</label>
                                        <input type="text" name="adres" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Şehir</label>
                                        <input type="text" name="sehir" required>
                                    </div>

                                    <div class="input-item">
                                        <label>Posta Kodu</label>
                                        <input type="text" name="posta"required>
                                    </div>

                                    <div class="input-item">
                                        <label>E-Posta</label>
                                        <input type="email" name="mail"  required>
                                    </div>

                                    <div class="input-item">
                                        <label>Telefon</label>
                                        <input type="text" maxlength="11"  class="number" name="tel" value="0" required>
                                    </div>
                                    <div class="pt-5 text-center">
                                   
                                    <button type="submit" name="odeme" class="cart-btn br3">
                                        Ödeme Yap
                                    </button>
                                  
                                </div>
                                </form>
                                
                            </div>
                            
                        </div>
                          <?php } ?>
                        <div class="col-lg-6 pl-lg-5">
                            <div class="order-product-info">
                                <h4>Siparişiniz</h4>
                                <table class="order-product-table table-responsive">
                                    <thead>
                                        <tr>
                                            <th  class="product-name">Ürün</th>
                                            <th class="quantity text-center">Adet</th>
                                            <th class="total text-center">Fiyat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  foreach($shopping_products as $product){ ?>
                                        <tr>
                                            <td style="width:100%" class="product-name">
                                                <a href="urun/<?=seo($product->urun_isim).'/'.$product->urun_id;?>"><?php echo $product->urun_isim; ?></a>
                                            </td>
                                            <td style="width:10%" class="quantity text-center"><?php echo $product->count;  ?></td>
                                            <td style="width:20%" class="total text-center"><?php 
                                            
                                             if($ayarcek['ayar_komisyon']==0)
                                    {
                                            echo $product->urun_fiyat; 
                                    }
                                    else
                                    {
                                        echo  $product->urun_fiyat*$product->count*($ayarcek['ayar_komisyon']/100)+$product->urun_fiyat*$product->count;
                                    }
                                            
                                            ?>₺</td>
                                        </tr>
                                        
                                        <? }?>
                                        <tr>
                                            <td colspan="2" class="product-name">
                                                <h6>Toplam</h6>
                                            </td>
                                            <td class="total text-center"><h6><?php echo $_SESSION["shoppingCart"]["summary"]["total_price"]; ?>₺</h6></td>
                                        </tr>
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                         <?php } ?>
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