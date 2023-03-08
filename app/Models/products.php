<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'purchasingـprice',
        'sale_price',
        'numberofpice',
        'numberـofـsales',
        'Status',
        'user_id',
        'Product_Location',
        'Product_Code',
        'Product_Location',
        'branchs_id',
        'minmum_quantity_stock_alart',
        'unit',
        'name_en',
        'grace_period_in_days'
    ];
    public function branch()
    {
        return $this->belongsTo(branchs::class,'branchs_id');
    }
}
