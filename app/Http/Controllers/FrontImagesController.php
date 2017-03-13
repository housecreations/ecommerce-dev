<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\FrontImage;
use App\CarouselImage;
use App\Http\Requests\ImageRequest;
use Laracasts\Flash\Flash;

class FrontImagesController extends Controller
{

    public function destroyCarousel($id)
    {

        $carouselImage = CarouselImage::find($id);

        if(CarouselImage::count() == 1 ){
            Flash::success("El banner no puede quedar sin imagen");
            return back();
        }

        if($carouselImage->image_url != "default.jpg")
            unlink(public_path()."\images\slider\\".$carouselImage->image_url);

        /* unlink("/home2/dsistema/public_html/images/slider/".$carouselImage->image_url);*/

        $carouselImage->delete();

        return redirect()->route('admin.front.edit');



    }


    public function edit()
    {
     
        $images = FrontImage::all();
        
        return view('admin.front.edit-front-images')->with('images', $images);   
            
        
        
    }
    
     public function update(ImageRequest $request, $id)
    {
         
             if($request->file('image')){
            
                $file = $request->file('image');
                $name = 'E-commerce_' .$id. "." . $file->getClientOriginalExtension();
                $path = 'images/front-images/';
                $file->move($path, $name);
                
                $image = FrontImage::find($id);
                $image->image_url = $name;
                $image->url_to = $request->url_to;
                $image->title = $request->title;
                $image->sub_title = $request->sub_title;
                $image->save();
        
                return back();
             
             
             
             }else{
                 
               $image = FrontImage::find($id);
             
               $image->url_to = $request->url_to;
               $image->title = $request->title;
            $image->sub_title = $request->sub_title;
               $image->save();  

               return back();
             }
            
         }
}
