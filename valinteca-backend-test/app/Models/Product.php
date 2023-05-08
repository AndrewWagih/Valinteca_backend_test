<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['price_after_discount'];
    protected $guarded = [];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    // please create database and then run php artisan migrate with seed then goto routes/api.php and use route products to show results
    public function getPriceAfterDiscountAttribute(){
        if (now()->between($this->offer_start, $this->offer_end)) {
            $priceAfterDiscount = $this->price - ($this->price * ($this->discount / 100));
            return round($priceAfterDiscount, 2);
        } else {
            return $this->price;
        }
    }
}
