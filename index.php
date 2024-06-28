<?php 
include 'header.php'; 


$kategorisor=$db->prepare("SELECT * FROM kategori");
$kategorisor->execute();
$kategorisor2=$db->prepare("SELECT * FROM kategori");
$kategorisor2->execute();
?>

        <!-- banner section start -->
        <section class="banner-section search">
            <div class="shape-layer">
                <div class="circle-shape" data-depth="0.1"></div>
                <div class="circle-shape-2" data-depth="0.2"></div>
                <div class="shape-box" data-depth="0.3">
                    <img src="assets/images/dot-shape.png" alt="">
                    <div class="sm-circle"></div>
                </div>
                
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-text text-center">
                                <p class="subtitle">Uygun Fiyata Hesap veya Key Satın Almak İster misin?</p>
                                <h1 class="title">Legacy ile doğru yoldasın!</h1>
                                <div class="row justify-content-center">
                                 <div class="col-12 col-md-10 col-lg-8">
                            <form class="search-form" method="post" action="ara" role="form">
                                <div class="card-body row no-gutters align-items-center">
                                   
                                    <!--end of col-->
                                    <div class="col">

                                        <input class="rounded-pill" type="text" name="aranan" placeholder="Ulaşmak istediğin ürün tek tıkla yanında!">
                                       
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-primary btn-2" name="arama" type="submit"><i class="fas fa-search"></i></button>
                                       
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                    </div>
                        <!--end of col-->
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- banner section end -->



        <!-- product-section start -->
        <section class="product-section section-ptb bg-gray2">
            <div class="section-header pb--30 pt_lg--60">
                <div class="container">
                    <div class="row align-items-center text-center text-lg-left">
                        <div class="col-lg-6 mb--15 mb-lg-0">
                            <h3>Çeşitli kategorilerle birlikte uygun fiyata hesap veya key satın alabilirsin.</h3>
                        </div>
                        <div class="col-lg-6 text-center text-lg-right">
                            <div class="text text-center text-lg-left">
                                <p>Aşağıda sıralanan kategorilere tıklayarak seçimini yapabilirsin.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-wrapper">
                <div class="container p-lg-0">
                    <div class="d-flex pb--30 pt_lg--60">
                        <ul class="product-tabname nav" role="tablist">
                            <?php $say=0; while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ $say++;?>
                            <li role="presentation">
                                <a class="tabnav-btn <?php if($say==1){echo 'active';} ?>" id="productTypeName<?php echo $say; ?>-tab" data-toggle="tab" href="#productTypeName<?php echo $say; ?>" role="tab" aria-controls="productTypeName<?php echo $say; ?>" aria-selected="true"><?php echo $kategoricek['kategori_isim']; ?></a>
                            </li>
                             <?php } ?>
                        </ul>

                    </div>
                    <div class="tab-content">
                        <!-- product-list 1 -->
                        <?php $sayy=0; while($kategoricek2=$kategorisor2->fetch(PDO::FETCH_ASSOC)){ $sayy++;?>
                        <div class="tab-pane fade <?php if($sayy==1){echo 'active show';} ?>" id="productTypeName<?php echo $sayy; ?>" role="tabpanel" aria-labelledby="productTypeName<?php echo $sayy; ?>-tab">
                            <div class="row">
                            <?php 
                            $urunsor=$db->prepare("SELECT * FROM urun where kategori_id={$kategoricek2['kategori_id']} ORDER BY urun_id ASC LIMIT 9");
                            $urunsor->execute();

                            while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)){?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="product-item">
                                        <div class="thumb">
                                            <a class="thumb-link" href="urun/<?=seo($uruncek["urun_isim"]).'/'.$uruncek["urun_id"]?>">
                                                <img src="<?php echo $uruncek['urun_resim']; ?>" alt="product thumb">
                                            </a>
                                            
                                        </div>
                                        <div class="content">
                                            <div class="content-inner">
                                                <div class="price-rating-area d-flex flex-wrap justify-content-between">
                                                    <div class="price"><?php 
                                                     if($ayarcek['ayar_komisyon']==0)
                                    {
                                    echo $uruncek['urun_fiyat']; 
                                    }
                                    else
                                    {
                                        echo  $uruncek['urun_fiyat']*1*($ayarcek['ayar_komisyon']/100)+$uruncek['urun_fiyat']*1;
                                    }
                                                    
                                                    ?>₺</div>
                                                    
                                                </div>
                                                <h5 class="title"><a href="urun/<?=seo($uruncek["urun_isim"]).'/'.$uruncek["urun_id"]?>"><?php echo $uruncek['urun_isim']; ?></a></h5>
                                            </div>
                                            
                                        </div>
                                        <div class="product-overlay">
                                            <a href="urun/<?=seo($uruncek["urun_isim"]).'/'.$uruncek["urun_id"]?>" class="product-overlay-btn details"><span>Ürünü Gör</span></a>
                             
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                                
                                <div class="col-12 mt--30 text-center">
                                    <a href="urunler" class="view-theme button">Tüm Ürünleri Göster</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                       
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   


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