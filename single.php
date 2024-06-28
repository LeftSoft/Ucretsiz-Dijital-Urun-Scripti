<?php
include 'header.php';
$blogsor=$db->prepare("SELECT * FROM blog where blog_id=:id");
$blogsor->execute(array(
  'id' => $_GET['blog_id']
  ));
$blogcek=$blogsor->fetch(PDO::FETCH_ASSOC);

$views=$db->prepare("SELECT COUNT(*) FROM blog_ip where blog_id={$_GET['blog_id']}");
$views->execute();
$stmt =$views->fetchColumn();
$ipcheck=$db->prepare("SELECT COUNT(*) FROM blog_ip where blog_id={$_GET['blog_id']} and ip_text='$visitor_ip'");
$ipcheck->execute();
$result =$ipcheck->fetchColumn();
$degisken=0;

if ($result<1) {
    $degisken++;
    $degisken = $blogcek['blog_views'] + $degisken;
    $ipekle=$db->prepare("INSERT INTO blog_ip SET
        blog_id=:blog_id,
        ip_text=:ip_text
        ");
    $ipekle->execute(array(
        'blog_id' => $_GET['blog_id'],
        'ip_text' => $visitor_ip
        ));
$ipekle2=$db->prepare("UPDATE blog SET
        blog_views=:blog_views
        WHERE blog_id={$_GET['blog_id']}");
    $ipekle2->execute(array(
        'blog_views' => $degisken
        ));
}
 ?>

        <!-- banner section start -->
        <section class="banner-section page-banner single-page-banner bg-gra4">
            <div class="shape-layer">
                <div class="circle-shape-2" data-depth="0.2"></div>
            </div>
            <div class="banner-content-area">
                <div class="container">
                    <div class="banner-text text-center text-lg-left">
                        <h1 class="title"><?php echo $blogcek['blog_baslik']; ?></h1>
                       
                        <ul class="meta-post d-flex flex-wrap">
                            
                               
                            <li>
                                <i class="far fa-clock"></i>
                                <?php echo $blogcek['blog_tarih']; ?>
                            </li>
                             <li>
                                
                                    <i class="far fa-eye"></i>
                                    <?php echo $blogcek['blog_views']; ?> Görüntülenme
                                
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90">
            <div class="container">
                <div class="single-page">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="thumb">
                                <img src="<?php echo $blogcek['blog_resim']; ?>" width="1110" height="764">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 left-sidebar d-none d-lg-block">
                            <div class="theiaStickySidebar">
                                <div class="meta-share-sidebar">
                                    

                                    <ul class="social-media-list list-unstyled d-block">
                                        <li><a href="javascript:penac('https://www.facebook.com/sharer/sharer.php?u=https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>','aciklama','toolbar=0,location=0,status=0,menuba  r=0,scrollbars=0,resizable=0,width=500,height=300'  )"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="javascript:penac('https://twitter.com/share?url=https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>&text=<?php echo $blogcek['blog_baslik']; ?>','aciklama','toolbar=0,location=0,status=0,menuba  r=0,scrollbars=0,resizable=0,width=500,height=300')"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="javascript:penac('http://pinterest.com/pin/create/button/?url=https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>&media=https://<?php echo $_SERVER['SERVER_NAME'].'/'.$blogcek['blog_resim']; ?>','aciklama','toolbar=0,location=0,status=0,menuba  r=0,scrollbars=0,resizable=0,width=500,height=300')"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 main-content">
                            <div class="content">
                                <?php echo $blogcek['blog_text']; ?>
                            </div>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page-content section end -->


       


       <!-- footer section start -->
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