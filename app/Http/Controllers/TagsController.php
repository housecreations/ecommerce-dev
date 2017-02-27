<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Laracasts\Flash\Flash;
use App\Http\Requests\TagRequest;

class TagsController extends Controller
{
   public function index(Request $request){
       
       $tags = Tag::search($request->name)->orderBy('id', 'DESC')->paginate(5);
       
       return view('admin.tags.index', ['tags' => $tags]);
       
   }
    
    public function create(){
        
        return view('admin.tags.create');
        
    }
    
    public function store(TagRequest $request){
        
            $tag = new Tag($request->all());
            $tag->save();
        
            Flash::success("Tag registrado");
        
            return redirect()->route('admin.tags.index');
        
        
    }
    
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', ['tag' => $tag]);
    }
     
    public function update(Request $request, $id)
    {
     
        $tag = Tag::find($id);
        $tag->fill($request->all());
      
        
        $tag->save();
        
        Flash::success('El tag se editó con éxito');
         
        return redirect()->route('admin.tags.index');
    }
    
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        
        Flash::success('El tag ' . $tag->name. ' ha sido eliminado');
       
        return redirect()->route('admin.tags.index');
    }
}
