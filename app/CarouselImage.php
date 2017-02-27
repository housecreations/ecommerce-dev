<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
   protected $table = "carousel_images";
    
    protected $fillable = ['image_url'];
}
