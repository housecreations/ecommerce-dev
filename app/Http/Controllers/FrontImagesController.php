<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\FrontImage;
use App\Http\Requests\ImageRequest;

class FrontImagesController extends Controller
{
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
