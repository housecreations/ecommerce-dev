<?php

namespace App\Http\Controllers;

use App\ArticlesTemplatesProperty;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\ArticlesTemplate;

use App\Config;
use Laracasts\Flash\Flash;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articlesTemplates = ArticlesTemplate::search($request->name)->orderBy('id', 'DESC')->simplePaginate(10);
        $currency = Config::whereOption('currency')->first();
        return view('admin.articles_templates.index', ['articlesTemplates' => $articlesTemplates, 'currency' => $currency->value]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $articleTemplate = new ArticlesTemplate();
        $articleTemplate->name = $request->name;
        $articleTemplate->description = $request->description;
        $articleTemplate->save();

        $articleTemplateProperties = $request->except(['name', 'description', '_token']);

        foreach ($articleTemplateProperties as $property) {

            $articleTemplateProperty = new ArticlesTemplatesProperty();
            $articleTemplateProperty->article_template_id = $articleTemplate->id;
            $articleTemplateProperty->option = $property;
            $articleTemplateProperty->save();

        }

        Flash::success("La plantilla ".$articleTemplate->name." fue registrada con éxito");


        return redirect()->route('admin.templates.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
