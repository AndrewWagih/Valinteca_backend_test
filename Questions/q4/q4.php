<?php

function applyCoupon($jsonFilePath,$couponPercentageValue){
    if($couponPercentageValue >= 100){
        return 'coupon value must be less than 100% ';
    }
    $cart = $cart = json_decode(file_get_contents($jsonFilePath), true);
    $totalDiscount = 0;
    foreach($cart['products'] as $product){  
        if($product['unit_price'] <= 150){
            $totalDiscount += ($product['unit_price'] * $product['quantity'] ) * ($couponPercentageValue/100);
        }
    }
    return $totalDiscount;
}

print_r(applyCoupon('cart.json',120));
echo '<br>--------------------<br>';
print_r(applyCoupon('cart.json',10));