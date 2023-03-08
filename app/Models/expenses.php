<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id'
        ,'Pay_Method_Name',
        'Reasonforspendingmoney',
        'branchs_id',
        'created_at',
         'updated_at',
         'Theـamountـpaid'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(branchs::class,'branchs_id');
    }
}
