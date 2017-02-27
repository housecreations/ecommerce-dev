<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontImage extends Model
{
    
    
    protected $table = "front_images";
    
    protected $fillable = ['image_url', 'title', 'sub_title', 'url_to'];
    
    
}
