<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Sale extends Model
{
    use HasFactory;    

    use Softdeletes;

    //protected $dates = ['delete_at'];
    protected $table = 'sales';
    protected $hidden = ['created_at', 'update_at'];
}
