<?php include 'header.php'; 

if (isset($_SESSION['userkullanici_mail'])) {
  header("Location:index");
  exit();
}
?>
<?php 

if (isset($_POST['kullanicigiris'])) {

        $url="https://www.google.com/recaptcha/api/siteverify";
        $r=$_POST['g-recaptcha-response'];
        $k=$ayarcek['ayar_googlesecret'];
        $ip=$_SERVER['REMOTE_ADDR'];
        $gidicek_adress=$url."?secret=".$k."&response=".$r."&remoteip=".$ip;
        $res=file_get_contents($gidicek_adress);
        $res=json_decode($res,true);

     $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 
     $kullanici_password=md5($_POST['kullanici_password']); 


if ($res['success']) {
    $kullanicisor=$db->prepare("select * from kullanici where k_mail=:mail and k_sifre=:password");
    $kullanicisor->execute(array(
        'mail' => strip_tags($kullanici_mail),
        'password' => strip_tags($kullanici_password)
        ));


    $say=$kullanicisor->rowCount();
    $kullanicisor->execute();
     $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
    if ($say==1) {

         $_SESSION['userkullanici_mail']=$kullanici_mail;
          $_SESSION['user_adi']= $kullanicicek['k_isim'];
        $_SESSION['user_id'] = $kullanicicek['k_id'];
echo "<script type=\"text/javascript\">swal(\"Giriş Başarılı!\", \"Hesabım sayfasına yönlendiriliyorsunuz.\", \"success\");</script>";

        header("Refresh: 3; url=hesabim");
      

    } else {

echo "<script type=\"text/javascript\">swal(\"Giriş Başarısız\", \"E-mail veya şifre hatalı.\", \"error\");</script>";
      header("Refresh: 3; url=giris");
    }
}
else {

echo "<script type=\"text/javascript\">swal(\"Recaptcha Başarısız\", \"Lütfen Ben Robot Değilim'i Doğrulayın.\", \"error\");</script>";
      header("Refresh: 3; url=giris");
    }

}

if (isset($_POST['kullanicikaydet'])) {

        $url="https://www.google.com/recaptcha/api/siteverify";
        $r=$_POST['g-recaptcha-response'];
        $k=$ayarcek['ayar_googlesecret'];
        $ip=$_SERVER['REMOTE_ADDR'];
        $gidicek_adress=$url."?secret=".$k."&response=".$r."&remoteip=".$ip;
        $res=file_get_contents($gidicek_adress);
        $res=json_decode($res,true);
    $kullanici_adsoyad=htmlspecialchars($_POST['kullanici_isim']);
     $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);

     $kullanici_passwordone=trim($_POST['kullanici_passwordone']);
     $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']);
if ($res['success']) {
if ($kullanici_adsoyad!="" && $kullanici_mail!="") {
 if(filter_var($kullanici_mail, FILTER_VALIDATE_EMAIL)) {
                                                        
    if ($kullanici_passwordone==$kullanici_passwordtwo) {

        if (strlen($kullanici_passwordone)>=8) {
// Başlangıç

            $kullanicisor=$db->prepare("select * from kullanici where k_mail=:mail");
            $kullanicisor->execute(array(
                'mail' => $kullanici_mail
                ));

            $say=$kullanicisor->rowCount();
        
            if ($say==0) {

                $password=md5($kullanici_passwordone);

                $kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
                    k_isim=:kullanici_adsoyad,
                    k_mail=:kullanici_mail,
                    k_sifre=:kullanici_password,
                    k_tarih=:k_tarih
                    ");
                $insert=$kullanicikaydet->execute(array(
                    'kullanici_adsoyad' => $kullanici_adsoyad,
                    'kullanici_mail' => $kullanici_mail,
                    'kullanici_password' => $password,
                    'k_tarih' => date('d.m.Y')
                    ));

                if ($insert) {

                      $_SESSION['userkullanici_mail']=$kullanici_mail;
                      $_SESSION['user_adi']=$kullanici_adsoyad;
                      $_SESSION['user_id']= $db->lastInsertId();
        echo "<script type=\"text/javascript\">swal(\"Kayıt Başarılı!\", \"Hesabım sayfasına yönlendiriliyorsunuz.\", \"success\");</script>";

        header("Refresh: 3; url=giris");
                    

                } else {

echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Lütfen Alanları Doldurduğunuzdan Emin Olun\", \"error\");</script>";
                  header("Refresh: 3; url=giris");
                }

            } else {
                echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Bu E-Posta Zaten Kayıtlı\", \"error\");</script>";
               header("Refresh: 3; url=giris");

            }


        } 

        else {

            echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Şifreniz minimum 8 karakter uzunluğunda olmalıdır.\", \"error\");</script>";
     header("Refresh: 3; url=giris");
        }

    } 

    else {

echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Girdiğiniz şifreler eşleşmiyor.\", \"error\");</script>";
header("Refresh: 3; url=giris");
    }
 
}
else {
echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Mail Formatı Yanlış.\", \"error\");</script>";
header("Refresh: 3; url=giris");
}

}
else {

    echo "<script type=\"text/javascript\">swal(\"Kayıt Başarısız!\", \"Lütfen Alanları Doldurunuz.\", \"error\");</script>";
    header("Refresh: 3; url=giris");
}
}
else
{
    echo "<script type=\"text/javascript\">swal(\"Recaptcha Başarısız\", \"Lütfen Ben Robot Değilim'i Doğrulayın.\", \"error\");</script>";
    header("Refresh: 3; url=giris");
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
                        <h1 class="title">Giriş Yap & Kayıt Ol</h1>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-area">
                <div class="container d-flex justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giriş Yap & Kayıt Ol</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- banner section end -->

        <!-- page-content section start -->
        <section class="page-content section-ptb-90 bg-gray1">
            <div class="container">
                <div class="my-account-container">
                    <div class="login-box">
                        <h3>Giriş Yap</h3>
                        <form action="" method="post" class="login-form">
                            <div class="input-item">
                                <label>E-Posta</label>
                                <input type="text" name="kullanici_mail" placeholder="Mail adresinizi yazın">
                            </div>
                            <div class="input-item">
                                <label>Şifre</label>
                                <input type="password" name="kullanici_password" placeholder="*****">
                            </div>
                            <div class="text-left">
                                <button class="submit-btn" name="kullanicigiris">Giriş Yap</button>
                            </div>
                            <div class="g-recaptcha" data-sitekey="<? echo $ayarcek['ayar_googlekey']; ?>"></div>
                        </form>
                    </div>
                    <div class="seperator text-cente">
                        <span>YA DA</span>
                    </div>
                    <div class="signup-box">
                        <h3>Kayıt Ol</h3>
                        <form action="" method="post" class="signup-form">
                            <div class="input-item">
                                <label>İsim</label>
                                <input type="text" name="kullanici_isim" placeholder="Enter Your Name">
                            </div>
                            <div class="input-item">
                                <label>E-Posta</label>
                                <input type="mail" name="kullanici_mail" placeholder="Enter Your Email Address">
                            </div>
                            <div class="input-item">
                                <label>Şifre</label>
                                <input type="password" name="kullanici_passwordone" placeholder="***** (Minimum 8 karakterden fazla olmalıdır.)">
                            </div>
                           <div class="input-item">
                                <label>Şifre Tekrar</label>
                                <input type="password" name="kullanici_passwordtwo" placeholder="***** (Minimum 8 karakterden fazla olmalıdır.)">
                            </div>
                            <div class="text-left">
                                <button class="submit-btn" name="kullanicikaydet">Kayıt Ol</button>
                            </div>
                            
                            <div class="g-recaptcha" data-sitekey="<? echo $ayarcek['ayar_googlekey']; ?>"></div>
                           
                        </form>
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