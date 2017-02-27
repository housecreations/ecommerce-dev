<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Laracasts\Flash\Flash;


class Article extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [

        'build_from' => 'name',
        'save_to' => 'slug'

    ];

    protected $table = "articles";

    protected $fillable = ['article_information_id', 'name', 'description', 'on_discount', 'stock', 'discount', 'price', 'price_now', 'featured'];


    /******************
     ****BELONGS TO****
     ******************/

    public function articlesInformation()
    {

        return $this->belongsTo('App\ArticlesInformation');
    }


    public function tags()
    {

        return $this->belongsToMany('App\Tag', 'article_tag')->withPivot('id');

    }

    /****************
     ****HAS MANY****
     ****************/

    public function images()
    {

        return $this->hasMany('App\Image');
    }

    public function articlesProperties()
    {

        return $this->hasMany('App\ArticlesProperty');
    }

    /*****************
     *****METHODS*****
     *****************/


    public function scopeSearchEngine($query, $name, $sortSelect, $orderType)
    {

        return $query->where('visible', 'yes')->where('name', 'LIKE', "%$name%")->orderBy($sortSelect, $orderType);

    }


    public function scopeSearch($query, $name)
    {

        return $query->where('name', 'LIKE', "%$name%");

    }

    public static function saveArticle($request)
    {


        if ($request->file('image')) {

            $file = $request->file('image');
            $name = 'E-commerce_' . time() . "." . $file->getClientOriginalExtension();
            $path = 'images/articles/';
            $file->move($path, $name);

        }

        $article = new Article($request->all());

        $article->price_now = $article->price - ($article->price * ($article->discount / 100));
        $article->save();

        $article->tags()->sync($request->tags);

        $image = new Image();
        $image->article()->associate($article);
        $image->image_URL = $name;
        $image->save();

        return Flash::success("Artículo registrado");

    }

}
