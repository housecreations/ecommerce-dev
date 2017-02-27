<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesProperty extends Model
{
    protected $table = "articles_properties";

    protected $fillable = ['article_id', 'option', 'value'];

    /******************
     ****BELONGS TO****
     ******************/

    public function article()
    {

        return $this->belongsTo('App\Article');
    }

}
