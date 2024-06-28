<?php 
$blogsorr=$db->prepare("SELECT * FROM blog ORDER BY blog_id ASC LIMIT 2");
$blogsorr->execute();
$kategorisor=$db->prepare("SELECT * FROM kategori ORDER BY kategori_id ASC LIMIT 4");
$kategorisor->execute();
$sayfasor=$db->prepare("SELECT * FROM sayfa ORDER BY sayfa_id ASC LIMIT 4");
$sayfasor->execute();
$sayfasor2=$db->prepare("SELECT * FROM sayfa ORDER BY sayfa_id ASC LIMIT 4");
$sayfasor2->execute();

 ?>
 
        <footer class="footer">
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget pr-lg-5">
                                <a href="" class="footer-logo">
                                    <img width="207" height="65" src="<?php echo $ayarcek['ayar_logo']; ?>">
                                </a>
                                <p>HexGame açıklama..</p>
                                <ul class="social-media-list d-flex flex-wrap">
                                    <?php if(!empty($ayarcek['ayar_facebook'])){ ?>
                                    <li><a target="_blank" href="<?php echo $ayarcek['ayar_facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li>
                                <?php }  if(!empty($ayarcek['ayar_twitter'])){ ?>
                                    <li><a target="_blank" href="<?php echo $ayarcek['ayar_twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
                                <?php }  if(!empty($ayarcek['ayar_instagram'])){ ?>
                                    <li><a target="_blank" href="<?php echo $ayarcek['ayar_instagram']; ?>"><i class="fab fa-instagram"></i></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget">
                                <h5 class="widget-title">Kategoriler</h5>
                                <div class="widget-wrapper">
                                    <ul class="links">
                                        <?php  while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <li><a href="kategori/<?=seo($kategoricek["kategori_isim"]).'/'.$kategoricek["kategori_id"]?>"><?php echo $kategoricek['kategori_isim']; ?></a></li>
                                    <?php } ?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget">
                                <h5 class="widget-title">Sayfalar</h5>
                                <div class="widget-wrapper">
                                    <ul class="links">
                                        <?php  while($sayfacek=$sayfasor->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <li><a href="sayfa/<?php echo strip_tags($sayfacek['sayfa_slug']); ?>"><?php echo $sayfacek['sayfa_baslik']; ?></a></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="footer-widget">
                                <h5 class="widget-title">Blog</h5>
                                <div class="widget-wrapper">
                                    <div class="small-post-list">
                                        <?php while($blogcekk=$blogsorr->fetch(PDO::FETCH_ASSOC)) {?>
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
                <div class="footer-bottom">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-center text-lg-left">
                            <p class="copyright"><? echo $ayarcek['ayar_footer']; ?></p>
                        </div>
                        <div class="col-lg-6">
                            <ul class="footer-menu d-flex justify-content-center justify-content-lg-end">
                                <?php  while($sayfacekk=$sayfasor2->fetch(PDO::FETCH_ASSOC)){ ?>
                                <li><a href="sayfa/<?php echo strip_tags($sayfacekk['sayfa_slug']); ?>"><?php echo $sayfacekk['sayfa_baslik']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
       