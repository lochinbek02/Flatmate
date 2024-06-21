<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
 
    protected $fillable=['sending_user','recipient_user','message'];

}
