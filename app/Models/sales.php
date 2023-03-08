<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products;
use App\Models\invoices;

class sales extends Model
{
    use HasFactory;

    protected $fillable = [
     'product_id'
    ,'invoice_id',
    'branch_id',
    'Discount_Value',
    'Added_Value',
     'Unit_Price',
     'quantity',
      'created_at',
];

    public function Invoice()
    {
        return $this->belongsTo(invoices::class,'invoice_id');
    }
    
    public function productData()
    {
        return $this->belongsTo(products::class,'product_id');
    }
    public function branch()
    {
        return $this->belongsTo(App\Models\branchs::class,'branch_id');
    }
}
