<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "configs";
    
    protected $fillable = ['active', 'sender_email', 'receiver_email'];
    
}
