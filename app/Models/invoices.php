<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customers;
use App\Models\User;

class invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id'
       ,'user_id',
         'Price',
        'branchs_id',
          'Pay',
        'Added_Value',
        'Number_of_Quantity'
      , 'created_at',
];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function branch()
    {
        return $this->belongsTo(branchs::class,'branchs_id');
    }
    public function customer()
{
    return $this->belongsTo(customers::class,'customer_id');
}
}
