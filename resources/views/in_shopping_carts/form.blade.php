{!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST', 'class' => 'shopping_cart_form']) !!}

<input type="hidden" name="article_id" value="{{$article->id}}">

{{--<input type="submit" class="cart-button" value="Agregar al carrito">--}}
<button type="submit" class="add-to-cart-button">
    <i class="fa fa-shopping-cart"></i> Agregar al carrito
</button>

{!! Form::close() !!}