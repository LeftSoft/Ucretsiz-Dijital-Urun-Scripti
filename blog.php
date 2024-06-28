<?php include 'header.php'; 



$blogsor2=$db->prepare("SELECT * FROM blog ORDER BY blog_views DESC LIMIT 4");
$blogsor2->execute();

$sayfada = 5; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     $sorgu=$db->prepare("SELECT * FROM blog");
                     $sorgu->execute();
                     $toplam_icerik=$sorgu->rowCount();
                     $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                     // eğer sayfa girilmemişse 1 varsayalım.
                     $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                            // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                     if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                     if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
                     $limit = ($sayfa - 1) * $sayfada;

 $blogsor=$db->prepare("SELECT * FROM blog order by blog_id DESC limit $limit,$sayfada");
        $blogsor->execute();
?>

        <!-- banner section start -->
        <section class="banner-section page-banner bg-gra4">
            <div class="shape-layer">
                <div class="circle-shape-2" data-depth="0.2"></div>
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="banner-text text-center text-lg-left">
                        <h1 class="title">Blog</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90">
            <div class="container">
                <div class="row">
                     <div class="col-lg-8 main-content">
                        <div class="theiaStickySidebar">
                            <?php while($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)){ ?>
                            <div class="post-item">
                                <div class="post-thumb">
                                    <a href="blog/<?=seo($blogcek["blog_baslik"]).'/'.$blogcek["blog_id"];?>">
                                        <img src="<?php echo $blogcek['blog_resim']; ?>" width="730" height="502">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <ul class="meta-post d-flex flex-wrap">
                                        
                                        <li>
                                            <i class="far fa-clock"></i>
                                           <?php echo $blogcek['blog_tarih']; ?>
                                        </li>
                                    </ul>
                                    <h4 class="title"><a href="blog/<?=seo($blogcek["blog_baslik"]).'/'.$blogcek["blog_id"];?>"><?php echo $blogcek['blog_baslik']; ?></a></h4>
                                    <p>
                                        <?php $detay = strip_tags($blogcek['blog_text']);
                  $uzunluk = strlen($detay);
                  $limit = 250;
                  if($uzunluk > $limit)
                  {
                    $detay = substr($detay,0,$limit)."...";
                  }
                  echo $detay;
                   ?> </p>
                                    <a href="blog/<?=seo($blogcek["blog_baslik"]).'/'.$blogcek["blog_id"];?>" class="flux-btn-border">Devamını Oku</a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4 pl-lg-5 sidebar">
                        <div class="theiaStickySidebar">
                            
                            <div class="widget">
                                <h5 class="widget-title">Popüler Gönderiler</h5>
                                <div class="widget-wrapper">
                                    <div class="small-post-list">
                                        <?php while($blogcekk=$blogsor2->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <div class="small-post-item">
                                            <div class="thumb">
                                                <a href="blog/<?=seo($blogcekk["blog_baslik"]).'/'.$blogcekk["blog_id"];?>"><img src="<?php echo $blogcekk['blog_resim']; ?>" width="70" height="70"></a>
                                            </div>
                                            <div class="content">
                                                <a href="blog/<?=seo($blogcekk["blog_baslik"]).'/'.$blogcekk["blog_id"];?>" class="title"><?php echo $blogcekk['blog_baslik']; ?></a>
                                                <ul class="meta-post">
                                                    <li><?php echo $blogcekk['blog_tarih']; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                       
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
   <?php

                                      $s=0;

                                      while ($s < $toplam_sayfa) {

                                       $s++; ?>

                                       <?php 

                                       if ($s==$sayfa) {?>

    <li class="page-item active"><a class="page-link" onclick="javascript:location.href='<?php echo $ayarcek['ayar_url']; ?>blog?sayfa=<?php echo $s; ?>';"><?php echo $s; ?></a>

    </li>
     <?php } else {?>

    <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['REQUEST_URI']; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
     <?php   }

                          }

                          ?>
   
  </ul>
</nav>
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