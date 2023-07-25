<?php

namespace App\Models;

class Cart
{
    public function centsToPrice($cents)
    {
        return number_format($cents / 100, 2);
    }

    public static function unitPrice($item)
    {
        $a = 3; 
        echo '<script>alert("hi" gettype($a))</script>';
      //  alert(gettype($a));
        //return (new self)->centsToPrice($item['product']['price']) * $item['quantity'];
    }

    public static function totalAmount()
    {
        $total = 0;
        foreach(session('cart') as $item)
        {
            $total += self::unitPrice($item);
        }
        return $total;
    }

}
