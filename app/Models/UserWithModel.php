<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWithModel extends Model
{
    use HasFactory;
    protected $fillable=['userid_n1','userid_n2','like_n1','like_n2'];
}
