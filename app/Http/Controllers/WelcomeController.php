<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\CarouselImage;
use App\Article;
use App\Config;
use App\FrontImage;

class WelcomeController extends Controller
{
    public function index(){

    $initial_config = Config::all();

    if ($initial_config->isEmpty()){
        return redirect('/admin/auth/login');
    }

    $carousel = CarouselImage::all();
    
    $featuredArticles = Article::where('featured', 'yes')->get();
    
    $newArticles = Article::orderBy('id', 'DESC')->take(4)->get();

    $currency = Config::whereOption('currency')->first();

    $front_images = FrontImage::all();

    return view('welcome', [
                            'carousel' => $carousel,
                            'newArticles' => $newArticles,
                            'currency' => $currency->value,
                            'front_images' => $front_images,
                            'featuredArticles' => $featuredArticles]);
        
        
    }
    
    
}
