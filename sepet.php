<?php include 'header.php';


?>

        <!-- banner section start -->
        <section class="banner-section page-banner bg-gra4">
            <div class="shape-layer">
                <div class="circle-shape-2" data-depth="0.2"></div>
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="banner-text text-center text-lg-left">
                        <h1 class="title">Sepet</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sepet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90 bg-gray1">
            <div class="container">
                <?php if($total_count > 0){ ?>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-quantity-box">
                            <p>Sepetinizde <?php echo $total_count; ?> ürün var</p>
                            <a href="urunler" class="continue-shopping-btn">Alışverişe devam et</a>
                        </div>
                        
                        <?php  foreach($shopping_products as $product){ 
                           
                        $urunsor3=$db->prepare("SELECT * FROM urun where urun_id={$product->urun_id}");
                            $urunsor3->execute();
                    $uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);
                    
                    
                    if($uruncek3['urun_anahtar']==0){
                    $anahtarsor=$db->prepare("SELECT * FROM anahtar where urun_id={$product->urun_id}");
                            $anahtarsor->execute();
                    $anahtarcek=$anahtarsor->rowCount();
                    }
                    else{
                       $anahtarsor=$db->prepare("SELECT * FROM hesap where urun_id={$product->urun_id}");
                            $anahtarsor->execute();
                     $anahtarcek=$anahtarsor->rowCount(); 
                    
                    }
                    $_SESSION['iddurum'] = 1;
                        ?>
                        <div class="cart-product-info">
                            <div class="cart-product-info-item">
                                <div class="product-item">
                                    <div class="product-thumb">
                                        <img width="80" height="80" src="<?php echo $product->urun_resim; ?>" alt="thumb">
                                    </div>
                                    <div class="product-content">
                                        <a href="urun/<?=seo($product->urun_isim).'/'.$product->urun_id;?>" class="title"><?php echo $product->urun_isim; ?></a>
                                            <ul class="license-support d-flex flex-wrap list-unstyled">
                                                <li><strong>Adet:</strong> <?php echo $product->count;  ?></li>
                                                <li><strong>Tür:</strong> <?php if($product->urun_anahtar == "0"){echo "Key Alımı";}else{echo "Hesap Alımı";} ?></li>
                                                <? if($product->count>$anahtarcek) { $_SESSION["durum"]=0;?>
                                                <li><strong style="color:red">Ürün stokta kalmadı! <?  $_SESSION["durum"]; ?></strong></li>
                                                <? } else{ $_SESSION["durum"]=1;}?>
                                            </ul>
                                    </div>
                                </div>
                                <div class="product-price-area">
                                    <button product-id="<?php echo $product->urun_id; ?>" class="close-item removeFromCartBtn"><i class="fas fa-times"></i></button>
                                    <p class="price"><?php
                                    if($ayarcek['ayar_komisyon']==0)
                                    {
                                    echo $product->urun_fiyat; 
                                    }
                                    else
                                    {
                                   
                                     echo  $product->urun_fiyat*$product->count*($ayarcek['ayar_komisyon']/100)+$product->urun_fiyat*$product->count;
                                    }
                                    
                                    ?>₺</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="col-lg-4 pt-4 mt-2">
                        <div class="cart-total-area mt-lg-5">
                            <h5 class="cart-total-title">Toplam</h5>
                            <div class="border-item"></div>
                            <div class="cart-total-body">
                                <?php  foreach($shopping_products as $product){ ?>
                                <div class="d-flex justify-content-between py-2">
                                    <p><?php echo $product->urun_isim; ?></p>
                                    <p><?php echo $product->count; ?> Adet</p>
                                    <p class="price"><?php 
                                    if($ayarcek['ayar_komisyon']==0)
                                    {
                                    echo $product->urun_fiyat; 
                                    }
                                    else
                                    {
                                        $top = $top+$product->urun_fiyat*$product->count*($ayarcek['ayar_komisyon']/100)+$product->urun_fiyat*$product->count;
                                     echo  $product->urun_fiyat*$product->count*($ayarcek['ayar_komisyon']/100)+$product->urun_fiyat*$product->count;
                                    }
                                    ?>₺</p>
                                </div>
                                <? }?>
                                <div class="border-item"></div>
                                <div class="d-flex justify-content-between py-2">
                                    <h5>Toplam Fiyat</h5>
                                    <h5 class="price"><?php 
                                     if($ayarcek['ayar_komisyon']==0)
                                    {
                                        echo $_SESSION["shoppingCart"]["summary"]["total_price"];
                                    }
                                    else
                                    {
                                     echo $_SESSION["shoppingCart"]["summary"]["total_price"] = $top;
                                    }
                                    ?>₺</h5>
                                </div>
                                <div class="pt-5">
                                    <? if($_SESSION["durum"]!=0){?>
                                    <a href="odeme" class="checkout-btn">Ödemeye Geç</a>
                                    <? } else{?>
                                    <button disabled class="checkout-btn">Ödemeye Geç</a>
                                    <? }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{?>
                <div class="row">
                    <div class="col-lg-12">
                    <p align="center">Sepette ürün bulunmamaktadır.</p>
                </div>
                </div>
            <?php } ?>

            </div>
        </section>
        <!-- page-content section end -->
}
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