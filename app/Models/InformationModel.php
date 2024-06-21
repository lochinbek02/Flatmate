<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'age',
        'smoking',
        'province',
        'city',
        'neighborhood',
        'from_money',
        'up_money',
        'about_user',
        'image'
    ];
}
