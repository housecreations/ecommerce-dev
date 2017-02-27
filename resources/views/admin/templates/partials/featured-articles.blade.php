<h2 class="text-center related-title"> Artículos destacados</h2>
  
  
  
  
  
  <div id="slider-related" class="flexslider">
                              <ul class="slides">
                                
     @foreach($featuredArticles as $article_related)
                                 
                                 <li>
                                 
                                 
                                 
                    <div class="about-thumb">
                     
                      @if($article_related->discount > 0)
                    <div class="oferta">{{$article_related->discount}}% de descuento</div>
                    @endif
                     
                      <a href="{{url('/articulos/'.$article_related->category->slug.'/'.$article_related->slug)}}">
                       
                        <img class="recent-articles" src="/images/articles/{{$article_related->images[0]->image_url}}" alt="Slide {{$article_related->id}}"/>
                              <div class="about-overlay">
                                   <h3>{{$article_related->name}}</h3>
                                   <h4>{{$article_related->price_now}} {{$currency}}</h4>
                            @if(Auth::user())
                            @if(Auth::user()->type == 'member')
                            @if($article_related->stock > 0)      
                             
                             @include('in_shopping_carts.form', ['article' => $article_related])
                            
                            @endif
                            @endif
                            
                            @else
                            @if($article_related->stock > 0)      
                            
                            
                             @include('in_shopping_carts.form', ['article' => $article_related])
                            
                            @endif
                            @endif
                                       
                                 
                              </div>
                              </a>
                    </div>
              
                           
                              </li>
                              
                              @endforeach
                              
                          </ul>
                      </div>