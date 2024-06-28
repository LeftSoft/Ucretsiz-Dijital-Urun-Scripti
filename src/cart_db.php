<?php

include 'sql.php';

session_start();
function addToCart($product_item){
    
    if(isset($_SESSION["shoppingCart"])){
        
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    } else {
        $products = array();
    }
    
    // Adet Kontrolü
    if(array_key_exists($product_item->urun_id,$products)){
        $products[$product_item->urun_id]->count++;
    }
      else{  
    $products[$product_item->urun_id] = $product_item;
    }
     // Sepetin Hesaplanması
     $total_price = 0.0;
    $total_count = 0;
foreach ($products as $product){
        
        $product->total_price = $product->count * $product->urun_fiyat;
        $total_price = $total_price + $product->total_price;
        $total_count += $product->count;
        
    }

     $summary["total_price"] = $total_price;
    $summary["total_count"] = $total_count;
    
    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;

    return $total_count;
}
function removeFromCart($product_id){
    
    if(isset($_SESSION["shoppingCart"])){
        
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
        
        if(array_key_exists($product_id, $products)){
            unset($products[$product_id]);
            $_SESSION['iddurum'] = 0;
        }
        
        $total_price = 0.0;
    $total_count = 0;
    
    foreach ($products as $product){
        
        $product->total_price = $product->count * $product->urun_fiyat;
        $total_price = $total_price + $product->total_price;
        $total_count += $product->count;
        
    }
    
     $summary["total_price"] = $total_price;
    $summary["total_count"] = $total_count;
    
    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;

    return true;
        
    }
    
    
}

if(isset($_POST["p"])){
    $islem = $_POST["p"];
    if($islem=="addToCart")
    {
        $id = $_POST["product_id"];
        $product = $db->query("SELECT * FROM urun WHERE urun_id={$id}", PDO::FETCH_OBJ)->fetch();
        $product->count = 1;
        
      echo  addToCart($product);

        

    } else if($islem=="removeFromCart"){

        $id = $_POST["product_id"];
      echo removeFromCart($id);

    }
 
   

}


?>