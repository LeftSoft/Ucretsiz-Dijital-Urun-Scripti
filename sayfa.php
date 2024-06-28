<?php 
include 'header.php';
$sayfasor=$db->prepare("SELECT * FROM sayfa where sayfa_slug=:sayfa_slug");
        $sayfasor->execute(array(
  'sayfa_slug' => $_GET['sef']
  ));
$sayfacek=$sayfasor->fetch(PDO::FETCH_ASSOC);
$say=$sayfasor->rowCount();
if($say==0)
{
header("Location:../");
    exit;
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
                        <h1 class="title"><?php echo $sayfacek['sayfa_baslik']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $sayfacek['sayfa_baslik']; ?></li>
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
                                
                                <?php echo $sayfacek['sayfa_aciklama']; ?>
                               
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