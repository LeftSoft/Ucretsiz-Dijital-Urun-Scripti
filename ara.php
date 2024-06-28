<?php include 'header.php'; 
if (isset($_POST['arama'])) {
    $_SESSION['aranan'] = $_POST['aranan'];
    $aranan= $_SESSION['aranan'];
    $urunsorf=$db->prepare("SELECT * FROM urun where urun_isim LIKE ?");
    $urunsorf->execute(array("%$aranan%"));

    $sayf=$urunsorf->rowCount();
} else {
    if (empty($_SESSION['aranan'])) {
        $_SESSION['aranan'] = "";
        $aranan= $_SESSION['aranan'];
    $urunsorf=$db->prepare("SELECT * FROM urun where urun_isim LIKE ?");
    $urunsorf->execute(array("%$aranan%"));
    }
    else
    {
        $aranan= $_SESSION['aranan'];
    $urunsorf=$db->prepare("SELECT * FROM urun where urun_isim LIKE ?");
    $urunsorf->execute(array("%$aranan%"));
    }
}

$sayfada = 8; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     
                     $toplam_icerik=$urunsorf->rowCount();
                     $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                     // eğer sayfa girilmemişse 1 varsayalım.
                     $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                            // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                     if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                     if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
                     $limit = ($sayfa - 1) * $sayfada;

 $urunsor=$db->prepare("SELECT * FROM urun order by urun_id DESC limit $limit,$sayfada");
        $urunsor->execute();


?>

        <!-- banner section start -->
        <section class="banner-section page-banner bg-gra4">
            <div class="shape-layer">
                <div class="circle-shape-2" data-depth="0.2"></div>
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="banner-text text-center text-lg-left">
                        <h1 class="title">Ürünler</h1>
                    
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ürünler</li>
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
                    <div class="col-lg-3 product-sidebar">
                        <div class="theiaStickySidebar">
                           
                            <div class="widget-filter-wrapper" id="flux-filtermain">
                                <div class="widget catagory">
                                    <a class="widget-title" data-toggle="collapse" href="#flux-catagory-filterId1" role="button" aria-expanded="true" aria-controls="flux-catagory-filterId1">Kategoriler<i class="fas fa-angle-down"></i></a>

                                    <div class="widget-wrapper show" id="flux-catagory-filterId1">
                                        <ul class="catagory-submenu pl-0">
                                             <?php 




$kategorisor=$db->prepare("SELECT * FROM kategori");
$kategorisor->execute();
                                             while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ ?>    
                                            <li>
                                                <a class="d-flex justify-content-between" href="kategori/<?=seo($kategoricek["kategori_isim"]).'/'.$kategoricek["kategori_id"]?>">
                                                    <span><?php echo $kategoricek['kategori_isim']; ?></span>

                                                    <span>
                                                   <?php  
                                                   $kategorisor1=$db->prepare("SELECT COUNT(*) FROM urun where kategori_id={$kategoricek['kategori_id']}");
                                                    $kategorisor1->execute();
                                                   echo $result =$kategorisor1->fetchColumn();


                                                    ?>
                                                    
                                                </span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                  
                    <div class="col-lg-9 main-content">
                        <div class="theiaStickySidebar">
                            <div class="row">
                                <?php

                                 if($sayf==0){
                                echo "<div class='col-md-12' align='center'>
                                 <p>Aradağınız ürünü bulamakdık :(<p> 
                                </div>";
                                } ?>
                                

                                <?php  while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)){ ?>
                                <div class="col-md-6 col-lg-6">
                                    <div class="product-item">
                                        <div class="thumb">
                                            <a class="thumb-link" href="urun/<?=seo($uruncek["urun_isim"]).'/'.$uruncek["urun_id"]?>">
                                                <img src="<?php echo $uruncek['urun_resim']; ?>">
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
                            </div>
                  
                               <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
   <?php

                                      $s=0;

                                      while ($s < $toplam_sayfa) {

                                       $s++; ?>

                                       <?php 

                                       if ($s==$sayfa) {?>

    <li class="page-item active"><a class="page-link" href="<?php echo $_SERVER['REQUEST_URI']; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

    </li>
     <?php } else {?>

    <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['REQUEST_URI']; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
     <?php   }

                          }

                          ?>
   
  </ul>
</nav>

    

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
        <script src='assets/js/price-range.js'></script>
        <script src='assets/js/lightcase.js'></script>
        <script src='assets/js/functions.js'></script>
    </body>
</html>