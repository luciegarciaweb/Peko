<?php 

if (!function_exists('tva')) {
    function tva($price) {
        $tva = 20;
        $calc = ( $tva / 100 ) * $price;
        $result = $price + $calc;

        return money_euro($result);
    }
}

function money_euro($money) {
    return number_format($money, 2, ',', ' ').' EUR';
}