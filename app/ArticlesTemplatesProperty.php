<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesTemplatesProperty extends Model
{

    protected $table = "articles_templates_properties";

    protected $fillable = ['article_template_id', 'option', 'value'];

    /******************
     ****BELONGS TO****
     ******************/

    public function articleTemplate()
    {
        return $this->belongsTo('App\ArticlesTemplate');
    }

}
