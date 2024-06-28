<?php include 'header.php'; 

$urunsor3=$db->prepare("SELECT * FROM urun where urun_id=:id");
        $urunsor3->execute(array(
  'id' => $_GET['urun_id']
  ));
$uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);


if($uruncek3['urun_anahtar']==0){
$anahtarsor=$db->prepare("SELECT * FROM anahtar where urun_id={$_GET['urun_id']}");
        $anahtarsor->execute();
$anahtarcek=$anahtarsor->rowCount();
}
else{
   $anahtarsor=$db->prepare("SELECT * FROM hesap where urun_id={$_GET['urun_id']}");
        $anahtarsor->execute();
 $anahtarcek=$anahtarsor->rowCount(); 

}


$say=$urunsor3->rowCount();
if($say==0)
{
header("Location:../../");
    exit;
}
$ssssor=$db->prepare("SELECT * FROM sss");
$ssssor->execute();
$views=$db->prepare("SELECT COUNT(*) FROM ipadress where urun_id={$_GET['urun_id']}");
$views->execute();
$stmt =$views->fetchColumn();
$ipcheck=$db->prepare("SELECT COUNT(*) FROM ipadress where urun_id={$_GET['urun_id']} and ip_text='$visitor_ip'");
$ipcheck->execute();
$result =$ipcheck->fetchColumn();
$degisken=0;

if ($result<1) {
    $degisken++;
    $degisken = $uruncek3['urun_views'] + $degisken;
    $ipekle=$db->prepare("INSERT INTO ipadress SET
        urun_id=:urun_id,
        ip_text=:ip_text
        ");
    $ipekle->execute(array(
        'urun_id' => $_GET['urun_id'],
        'ip_text' => $visitor_ip
        ));
$ipekle2=$db->prepare("UPDATE urun SET
        urun_views=:urun_views
        WHERE urun_id={$_GET['urun_id']}");
    $ipekle2->execute(array(
        'urun_views' => $degisken
        ));
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
                        <h1 class="title"><?php echo $uruncek3['urun_isim']; ?></h1>
                        
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $uruncek3['urun_isim']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90 bg-gray1">
            <div class="container">
                <div class="row">
                     <div class="col-lg-4 sidebar">
                        <div class="theiaStickySidebar">
                            <div class="widget-woocommerce box">
                                <div class="product-w-details">
                                    <ul class="list-inline text-left product-sidebar-stats">
                                        <li><h5 align="center"><?php echo $uruncek3['urun_isim']; ?></h5></li>
                                    </ul>
                                    
                                    <p class="price"><?php
                                    if($ayarcek['ayar_komisyon']==0)
                                    {
                                    echo $uruncek3['urun_fiyat']; 
                                    }
                                    else
                                    {
                                        echo  $uruncek3['urun_fiyat']*1*($ayarcek['ayar_komisyon']/100)+$uruncek3['urun_fiyat']*1;
                                    }
                                    
                                    ?>₺</p>
                                    
                                    <ul class="list-inline text-left product-sidebar-stats">
                                        <li>
                                            <i class="fa fa-shopping-cart"></i>
                                            <span><?php echo $uruncek3['urun_satis']; ?> Satış</span>
                                        </li>
                                      <li>
                                            <i class="fa fa-cubes"></i>
                                            <span><?php echo $anahtarcek; ?> Stokta</span>
                                        </li>
                                        <? if($uruncek3['urun_anahtar']==0){?>
                                        <li>
                                            <i class="fa fa-key"></i>
                                            <span> <?php if($uruncek3['urun_anahtar']==0){echo "Key Satışı";} ?></span>
                                        </li>
                                        <? } else if($uruncek3['urun_anahtar']==1){?>
                                        <li>
                                            <i class="fa fa-user-circle"></i>
                                            <span> <?php if($uruncek3['urun_anahtar']==1){echo "Hesap Satışı";} ?></span>
                                        </li>
                                        <? }?>
                                            <li>
                                            <i class="fa fa-eye"></i>
                                            <span><?php echo $uruncek3['urun_views']; ?> Görüntülenme</span>
                                        </li>
                                    </ul>
                                    
                                    <div class="text-center">
                                        <? if($anahtarcek!=0){ ?>
                                        <a role="button" product-id="<?php echo $uruncek3['urun_id']; ?>"  class="addcart flux-btn-border addToCartBtn">Sepete Ekle</a>
                                        <? } else{?>
                                        <p style="color:red">Ürün Stokta Yok</p>
                                        <? } ?>
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="col-lg-8 main-content">
                        <div class="theiaStickySidebar">
                            <div class="product-entry-single">
                                <div class="product-thumb box">
                                    <img width="730" height="353" src="<?php echo $uruncek3['urun_resim']; ?>">
                                </div>
                               
                                <div class="box product-detail-description">
                                    <div class="d-flex pb--60">
                                        <ul class="product-tabname nav" role="tablist">
                                            <li role="presentation">
                                                <a class="tabnav-btn active" id="product-detail-descrioption-tab1-tab" data-toggle="tab" href="#product-detail-descrioption-tab1" role="tab" aria-controls="product-detail-descrioption-tab1" aria-selected="true">Açıklama</a>
                                            </li>
                                           
                                            <li role="presentation">
                                                <a class="tabnav-btn" id="product-detail-descrioption-tab4-tab" data-toggle="tab" href="#product-detail-descrioption-tab4" role="tab" aria-controls="product-detail-descrioption-tab4" aria-selected="false">S.S.S</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <!-- product-list 1 -->
                                        <div class="tab-pane fade show active" id="product-detail-descrioption-tab1" role="tabpanel" aria-labelledby="product-detail-descrioption-tab1-tab">
                                        <div class="tab-body">
                                           <?php echo $uruncek3['urun_aciklama']; ?>
                                        </div>
                                        </div>
                
                                        
                                        <!-- product-list 4 -->
                                        <div class="tab-pane fade" id="product-detail-descrioption-tab4" role="tabpanel" aria-labelledby="product-detail-descrioption-tab4-tab">
                                            <div>
                                                <div class="faq-container">
                                                    <div class="accordion" id="faqaccordion">
                                                        <?php $say=0; while($ssscek=$ssssor->fetch(PDO::FETCH_ASSOC)){ $say++;?>
                                                        <div class="faq  wow fadeInUp" data-wow-offset="10" data-wow-duration="1s" data-wow-delay="0s">
                                                            <div class="faq-header" id="faq<?php echo $say; ?>">
                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $say; ?>" aria-expanded="false" aria-controls="collapse<?php echo $say; ?>">
                                                                    <span class="icon">
                                                                        <i class="fas fa-plus"></i>
                                                                        <i class="fas fa-minus"></i>
                                                                    </span>
                                                                    <?php echo $ssscek['sss_baslik']; ?>
                                                                </button>
                                                            </div>
                                        
                                                            <div id="collapse<?php echo $say; ?>" class="collapse" aria-labelledby="faq<?php echo $say; ?>" data-parent="#faqaccordion">
                                                                <div class="faq-body">
                                                                    <?php echo $ssscek['sss_aciklama']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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