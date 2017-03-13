<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesTemplate extends Model
{
    protected $table = "articles_templates";

    protected $fillable = ['name', 'description'];

    /****************
     ****HAS MANY****
     ****************/

    public function articlesTemplatesProperties()
    {

        return $this->hasMany('App\ArticlesTemplatesProperty');
    }

    public function scopeSearch($query, $name)
    {

        return $query->where('name', 'LIKE', "%$name%");

    }
}
