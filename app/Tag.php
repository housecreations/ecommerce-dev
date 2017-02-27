<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Tag extends Model implements SluggableInterface
{
    use SluggableTrait;
    
    protected $sluggable = [
        
        'build_from' => 'name',
        'save_to' => 'slug'
        
    ];
    
    
     protected $table = "tags";
    
    protected $fillable = ['name'];
    
    public function scopeSearch($query, $name){
    
    return $query->where('name', 'LIKE', "%$name%");
    
}
    public function articles(){
        
        return $this->belongsToMany('App\Article','article_tag')->withPivot('id');
        
    }
}
