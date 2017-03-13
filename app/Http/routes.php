<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/api/test', 'MessagesController@api');


Route::get('/search-articles', 'ArticlesController@indexSearch');


Route::post('/deleteNoUserCarts', 'ShoppingCartsController@eliminarcarritos');

Route::get('/tags/{tag}', function ($tag) {


    $articles = App\Tag::where('slug', '=', $tag)->first()->articles()->where('visible', '=', 'yes')->orderBy('article_id', 'DESC')->simplePaginate(8);

    $tag = App\Tag::where('slug', '=', $tag)->first();

    $currency = App\Config::find(1);
    return view('showtags', ['articles' => $articles, 'tag' => $tag, 'currency' => $currency->currency]);
});


Route::get('/', 'WelcomeController@index');

Route::get('/home', [
    'uses' => 'MembersController@index',
    'as' => 'member.index',
    'middleware' => 'members.auth'
]);

Route::get('/home/passwords', [
    'uses' => 'MembersController@editPassword',
    'as' => 'member.password.edit',
    'middleware' => 'members.auth'
]);
Route::put('/home/passwords', [
    'uses' => 'MembersController@updatePassword',
    'as' => 'member.password.update',
    'middleware' => 'members.auth'
]);


Route::get('/cart', 'ShoppingCartsController@index');
Route::get('/cart/empty', 'ShoppingCartsController@vaciar');


Route::resource('in_shopping_carts', 'InShoppingCartsController', [

    'only' => ['store', 'destroy']

]);


Route::post('/payments/pay', 'PaymentsController@index');
Route::post('/payments/pay_bank', 'PaymentsController@pay_bank');
Route::post('/payments/pay_bank/data/{id}', 'PaymentsController@pay_bank_data');

Route::get('/payments/fail', 'PaymentsController@fail');
Route::get('/payments/pending', 'PaymentsController@pending');
Route::get('/payments/success', 'PaymentsController@success');


Route::post('/contact', [
    'uses' => 'MessagesController@store',
    'as' => 'messages.store'
]);


Route::get('/contact', ['as' => 'contact', function () {


    return view('contact');
}]);


Route::get('/articles', function () {


    $categoriescat = App\Category::orderBy('id', 'DESC')->get();

    $featuredArticles = App\Article::where('featured', 'yes')->get();


    return view('showCategories', ['categoriescat' => $categoriescat, 'featuredArticles' => $featuredArticles, 'currency' => App\Config::find(1)->currency]);
});


/* ruta para motrar los articulos de una categoria*/

Route::get('/articles/{category}', function ($cat) {


    $articles = App\Category::where('slug', '=', $cat)->first()->articles()->where('visible', '=', 'yes')->orderBy('id', 'DESC')->simplePaginate(8);
    $currency = App\Config::find(1);

    $featuredArticles = App\Article::where('featured', 'yes')->get();

    return view('show', ['articles' => $articles, 'currency' => $currency->currency, 'featuredArticles' => $featuredArticles]);


});


Route::get('articles/{category}/{slug}', ['as' => 'mostrar.articulo', function ($cat, $slug) {

    $article = App\Article::where('slug', '=', $slug)->where('visible', '=', 'yes')->first();

    //si el articulo está oculto, muestra el error 404
    if (!$article)
        return abort(404);

    $tags = $article->tags;


    $relatedArticles = collect([]);


    foreach ($tags as $tag) {

        $relatedArticle = $tag->articles()->whereNotIn('article_id', [$article->id])->where('visible', '=', 'yes')->get();


        $relatedArticles->push($relatedArticle);


    }

    $relatedArticles = $relatedArticles->collapse()->groupBy('id');

    $articles = collect([]);
    foreach ($relatedArticles as $relatedArticle) {

        $articles->push($relatedArticle[0]);

    }
    $currency = App\Config::find(1);

    return view('showArticle', ['article' => $article, 'relatedArticles' => $articles, 'currency' => $currency->currency]);

}]);


Route::get('/about-us', function () {

    return view('whoweare');

});

Route::get('/how-to-buy', function () {

    return view('howtobuy');

});

Route::get('/privacy-policies', function () {

    return view('privacypolicy');

});

Route::get('/terms-and-conditions', function () {

    return view('termsconditions');

});

Route::get('/payments-and-shipments', function () {

    return view('paysandshipment');

});


Route::get('/on-discount', function () {

    $articles = App\Article::where('on_discount', '=', 'yes')->where('visible', '=', 'yes')->orderBy('id', 'DESC')->simplePaginate(8);
    $currency = App\Config::find(1);

    return view('showoutlet', ['articles' => $articles, 'currency' => $currency->currency]);

});


route::get('/checkout', ['uses' => 'PaymentsController@checkout', 'middleware' => 'members.auth']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {


    Route::get('front/edit/{id}/destroy', [
        'uses' => 'FrontImagesController@destroyCarousel',
        'as' => 'admin.carousel.destroy'
    ]);

    Route::resource('payments_accounts', 'PaymentsAccountsController');

    Route::get('/payments_accounts/{id}/active', [
        'uses' => 'PaymentsAccountsController@active',
        'as' => 'admin.payments_accounts.active'
    ]);


    Route::post('/config/status', [
        'uses' => 'ConfigsController@changeStatus',
        'as' => 'admin.config.status'
    ]);
    Route::post('/config/emails', [
        'uses' => 'ConfigsController@changeEmails',
        'as' => 'admin.config.emails'
    ]);


    Route::get('/config', [
        'uses' => 'ConfigsController@index',
        'as' => 'admin.config.index'
    ]);

    Route::post('/config/shipment', [
        'uses' => 'ShipmentsController@storeShipment',
        'as' => 'admin.shipment.store'
    ]);
    Route::get('/config/shipment/{id}', [
        'uses' => 'ShipmentsController@editShipment',
        'as' => 'admin.shipment.edit'
    ]);
    Route::put('/config/shipment/{id}', [
        'uses' => 'ShipmentsController@updateShipment',
        'as' => 'admin.shipment.update'
    ]);
    Route::get('/config/shipment/{id}/destroy', [
        'uses' => 'ShipmentsController@destroyShipment',
        'as' => 'admin.shipment.destroy'
    ]);


    Route::resource('orders', 'OrdersController', [

        'only' => ['index']

    ]);


    Route::post('/orders/expired/delete', [
        'uses' => 'OrdersController@expiredDelete',
        'as' => 'admin.orders.expired.delete'
    ]);


    Route::put('/orders/{id}', 'OrdersController@adminUpdate');

    Route::get('/orders/all', [
        'uses' => 'OrdersController@showAll',
        'as' => 'admin.orders.all'
    ]);


    Route::resource('tags', 'TagsController',
        ['except' => ['create', 'show']]);


    Route::get('/payment', 'PaymentsController@searchView');
    Route::post('/payment', [
        'uses' => 'PaymentsController@search',
        'as' => 'admin.payments.search'
    ]);


    Route::get('/front/edit', [
        'uses' => 'FrontController@edit',
        'as' => 'admin.front.edit'
    ]);
    Route::put('/front/edit/{id}', [
        'uses' => 'FrontController@update',
        'as' => 'admin.front.update'
    ]);


    Route::get('/front/edit/mas', [
        'uses' => 'FrontController@mas',
        'as' => 'admin.front.mas'
    ]);
    /*Route::get('/front/edit/menos', [
        'uses' => 'FrontController@menos',
        'as' => 'admin.front.menos'
    ]);*/

    /*Editar imagenes de inicio*/
    Route::get('/front-images/edit', [
        'uses' => 'FrontImagesController@edit',
        'as' => 'admin.front-images.edit'
    ]);
    Route::put('/front-images/edit/{id}', [
        'uses' => 'FrontImagesController@update',
        'as' => 'admin.front-images.update'
    ]);


    Route::get('/messages', [
        'uses' => 'MessagesController@index',
        'as' => 'admin.messages.index'
    ]);
    Route::get('/messages/show/{id}', [
        'uses' => 'MessagesController@show',
        'as' => 'admin.messages.show'
    ]);
    Route::get('/messages/destroy/{id}', [
        'uses' => 'MessagesController@destroy',
        'as' => 'admin.messages.destroy'
    ]);

    Route::post('/discount/{id}', [
        'uses' => 'FrontController@discount',
        'as' => 'admin.discount'
    ]);


    Route::post('/featured/{id}', [
        'uses' => 'FrontController@featured',
        'as' => 'admin.featured'
    ]);


    Route::get('/password', [
        'uses' => 'UsersController@editPassword',
        'as' => 'admin.password.edit'
    ]);
    Route::put('/password', [
        'uses' => 'UsersController@updatePassword',
        'as' => 'admin.password.update'
    ]);


    Route::get('/initial-configuration', [
        'uses' => 'ConfigsController@initialConfiguration',
        'as' => 'admin.configuration.index'
    ]);
    Route::post('/initial-configuration', [
        'uses' => 'ConfigsController@storeInitialConfiguration',
        'as' => 'admin.configuration.store'
    ]);

    Route::get('/', ['as' => 'admin.index', function () {


        $initial_config = App\Config::all();

        if ($initial_config->isEmpty()){
            return redirect()->route('admin.configuration.index');
        }

        $unread = App\Message::where('read', '=', 'no')->count();

        $totalMonth = App\Order::totalMonth();
        $totalMonthCount = App\Order::totalMonthCount();
        $orderCount = App\Order::orderCount();
        $orderCountAll = App\Order::orderCountAll();
        $front_images = App\FrontImage::all();

        if ($unread > 99) {

            $unread = '+99';
        }


        $carousel = App\CarouselImage::all();

        $currency = App\Config::whereOption('currency')->first();

        return view('admin.index', [
                                    'unread'            => $unread,
                                    'carousel'          => $carousel,
                                    'totalMonth'        => $totalMonth,
                                    'totalMonthCount'   => $totalMonthCount,
                                    'orderCount'        => $orderCount,
                                    'orderCountAll'     => $orderCountAll,
                                    'currency'          => $currency->value,
                                    'front_images'      => $front_images
                                    ]);
    }]);

    Route::resource('users', 'UsersController');
    Route::get('users/{id}/destroy', [
        'uses' => 'UsersController@destroy',
        'as' => 'admin.users.destroy'
    ]);

    Route::resource('categories', 'CategoriesController', [
        'except' => ['destroy', 'create', 'show']
    ]);
    Route::get('categories/{id}/destroy', [
        'uses' => 'CategoriesController@destroy',
        'as' => 'admin.categories.destroy'
    ]);


    Route::resource('templates', 'TemplatesController');

    Route::resource('articles', 'ArticlesController');

    Route::get('articles/{id}/destroy', [
        'uses' => 'ArticlesController@destroy',
        'as' => 'admin.articles.destroy'
    ]);
    Route::get('articles/{id}/images', [
        'uses' => 'ArticlesController@images',
        'as' => 'admin.articles.images'
    ]);
    Route::delete('articles/{id}/images/{image_id}', [
        'uses' => 'ArticlesController@deleteimage',
        'as' => 'admin.articles.images.delete'
    ]);
    Route::post('articles/{id}/images', [
        'uses' => 'ArticlesController@newimage',
        'as' => 'admin.articles.images.new'
    ]);
    Route::post('articles/{id}/visible', [
        'uses' => 'ArticlesController@visible',
        'as' => 'admin.articles.visible'
    ]);


    /*  inicio rutas sites  */


    /*  fin rutas states  */


});


Route::get('admin/auth/login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'admin.auth.login'
]);
Route::post('admin/auth/login', [
    'uses' => 'Auth\AuthController@postLogin',
    'as' => 'admin.auth.login'
]);
Route::get('admin/auth/logout', [
    'uses' => 'Auth\AuthController@logout',
    'as' => 'admin.auth.logout'
]);

Route::get('/register', [
    'uses' => 'Auth\RegisterController@getRegister',
    'as' => 'admin.auth.register'
]);

Route::post('/register', [
    'uses' => 'Auth\RegisterController@register',
    'as' => 'admin.auth.register'
]);

Route::post('/password/email', [
    'uses' => 'Auth\PasswordController@sendResetLinkEmail',

]);
Route::post('/password/reset', [
    'uses' => 'Auth\PasswordController@reset',

]);
Route::get('/password/reset/{token?}', [
    'uses' => 'Auth\PasswordController@showResetForm',

]);


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
