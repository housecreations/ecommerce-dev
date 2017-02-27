<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesInformation extends Model
{
    protected $table = "articles_information";

    protected $fillable = ['category_id', 'name', 'description'];

    /******************
     ****BELONGS TO****
     ******************/

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /****************
     ****HAS MANY****
     ****************/

    public function articles()
    {

        return $this->hasMany('App\Article');
    }
}
