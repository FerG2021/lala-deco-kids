<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class CurrentAccountDetail extends Model
{
    use HasFactory;

    use softDeletes;

    //protected $dates = ['delete_at'];
    protected $table = 'current_account_details';
    protected $hidden = ['created_at', 'update_at'];
}
