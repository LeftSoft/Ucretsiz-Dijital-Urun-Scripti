<?php
include '../sql.php';
include 'shopierAPI.php'; // İndirdiğimiz dosyada bulunan sınıfımızı dosyaya dahil ediyoruz.
session_start();
if($_SESSION['iddurum']==1){
if($_SESSION["durum"]!=0){
if(!empty($_SESSION["shoppingCart"]["summary"]["total_price"])){
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
    ));
    $ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
    $_SESSION['sipariskodu'] = rand();
$shopier = new Shopier($ayarcek['ayar_api'], $ayarcek['ayar_secret']); // Kendi api bilgilerinizi gireceksiniz.
$shopier->setBuyer([ // Kullanıcı bilgileri
'id' => $_SESSION['sipariskodu'], // Sipariş kodu
'paket' => 'Dijital Ürün', // Paket adı
'first_name' => $_SESSION['isim'], 'last_name' => $_SESSION['soy'], 'email' => $_SESSION['mail'], 'phone' => $_SESSION['tel']]); // Kullanıcının ad, soyad, telefon, email bilgileri
$shopier->setOrderBilling([
'billing_address' => $_SESSION['adres'], //Kullanıcının adresi
'billing_city' => $_SESSION['sehir'], // İl
'billing_country' => 'Türkiye', //Ülke
'billing_postcode' => $_SESSION['posta'], //Posta Kodu
]);
$shopier->setOrderShipping([
'shipping_address' => $_SESSION['adres'], //Kullanıcının adresi
'shipping_city' => $_SESSION['sehir'], // İl
'shipping_country' => 'Türkiye', //Ülke
'shipping_postcode' => $_SESSION['posta'], //Posta Kodu
]);
if(!empty($_SESSION['user_id']))
{
    setcookie('durum5', $_SESSION['user_adi'], time() + (60*5) , '/'); 
    setcookie('durum4', mt_rand(), time() + (60*5) , '/'); 
    setcookie('durum3', $_SESSION['userkullanici_mail'], time() + (60*5) , '/'); 
    setcookie('durum', $_SESSION['user_id'], time() + (60*5) , '/'); 
    if(isset($_SESSION["shoppingCart"]))
{
$shoppingCart = $_SESSION["shoppingCart"];
$total_count = $shoppingCart["summary"]["total_count"];
$total_price = $shoppingCart["summary"]["total_price"];
setcookie('durum2', serialize($shoppingCart["products"]), time() + (60*5) , '/');

}

}
else
{
    setcookie('durum4', mt_rand(), time() + (60*5) , '/'); 
    setcookie('durum', 0, time() + (60*5) , '/'); 
    if(isset($_SESSION["shoppingCart"]))
{
$shoppingCart = $_SESSION["shoppingCart"];
$total_count = $shoppingCart["summary"]["total_count"];
$total_price = $shoppingCart["summary"]["total_price"];
setcookie('durum2', serialize($shoppingCart["products"]), time() + (60*5) , '/');


}

}


die($shopier->run($_SESSION['sipariskodu'], $_SESSION["shoppingCart"]["summary"]["total_price"], $ayarcek["ayar_url"].'src/shopier/shopierNotify.php')); // Burada üç adet parametre göndermemiz gerekiyor ilk olarak paket id sonra fiyat daha sonrasında ise geri dönüş url mağazadaki girdiğiniz geri dönüş url ile aynı olması gerekiyor bu dosyamız da shopierNotfiy.php dosyamız oluyor.
}
else
{
    
    header("Location:../../sepet");

}
}
else{
    header("Location:../../sepet");
}
}
else
{
    header("Location:../../sepet");
}
?>
