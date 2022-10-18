<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class SaleProduct extends Model
{
    use HasFactory;

    use Softdeletes;

    //protected $dates = ['delete_at'];
    protected $table = 'sale_products';
    protected $hidden = ['created_at', 'update_at'];
}
