
$(document).ready(function(){
    
    $(".addToCartBtn").click(function(){

    var url="https://leagcy.hatauzmani.com/src/cart_db.php";
    var data = {
        p : "addToCart",
        "product_id" : $(this).attr("product-id")
    }

    $.post(url,data,function(response) {
        $(".cart").text(response);
        window.location.href = "sepet";
    })
    
    })

    $(".removeFromCartBtn").click(function(){

    var url="https://leagcy.hatauzmani.com/src/cart_db.php";
    var data = {
        p : "removeFromCart",
        "product_id" : $(this).attr("product-id")
    }

    $.post(url,data,function(response) {
        window.location.href = "sepet";
    })
    
    })
})