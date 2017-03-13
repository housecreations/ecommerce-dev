

$(window).load(function() { // makes sure the whole site is loaded
        // The slider being synced must be initialized first
      
      $('#preloader').fadeOut('slow');
    $('body').css({'overflow':'visible'});
      
  $('#slider-related').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210, /*210*/
    itemMargin: 0,
    minItems: 2,
    maxItems: 4
           
        });
    
    
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 105,
            itemMargin: 0,
            asNavFor: '#slider',
            minItems: 2,
    maxItems: 3
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel",
            start: function(slider){
                $('#status').fadeOut(); // will first fade out the loading animation
                $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
                $('#main-wrapper').delay(350).css({'overflow':'visible'});
            }
        });


    
    
    
$(document).ready(function(){


    $('#currencyCmb').change(function () {

        if ($(this).val() == 'Bs'){

            $('#currencyCodeCmb').val('VEF');

        }if ($(this).val() == '$'){

            $('#currencyCodeCmb').val('USD');

        }

    });



    var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
        showLeft = document.getElementById( 'showLeft' );

    if(showLeft != null){
        showLeft.onclick = function() {
            classie.toggle( this, 'active' );
            classie.toggle( menuLeft, 'cbp-spmenu-open' );

        };
    }
    
    
    
    
     $('#payment_type').change(function(){
    
    var $optionSelected = $(this).find("option:selected");
  
         
         
     var $val  = $optionSelected.val();
     var $form = $("#payments_form");     
     var $comision = $("#comision");
     var $comision_price = $("#comision-price");
     var $total_amount = $("#total-amount");
     var $total_price = $("#total-price");
         
        if($val === 'TDC'){
         var $baseUrl = document.location.origin + '/payments/pay';  
             $form.attr("action", $baseUrl);
             $comision.html("Comisión plataforma de pagos 8%");
             $comision_price.html($total_amount.html()*0.08 + " Bs");
             $total_price.html(parseFloat($total_amount.html()*0.08)+parseFloat($total_amount.html()) + " Bs");
            
            }else{
                
               var $baseUrl = document.location.origin + '/payments/pay_bank'; 
                $form.attr("action", $baseUrl);
            }     
           
        });
    
    $('#sort-select').change(function(){
    
    var $optionSelected = $(this).find("option:selected").val();
 
       
         switch($optionSelected){
                 
             case 'id-desc':
                
                 
                 $("#sortSelect").val('id');
                 $("#orderType").val('DESC');
                 
                 break;
                 
             case 'id-asc':
                 
                 $("#sortSelect").val('id');
                 $("#orderType").val('ASC');
                 
                 break;
                 
             case 'price-desc':
                 
                 $("#sortSelect").val('price_now');
                 $("#orderType").val('DESC');
                 
                 break;
                 
             case 'price-asc':
                 
                 $("#sortSelect").val('price_now');
                 $("#orderType").val('ASC');
                 
                 break;
             
             default:
                 break;
                 
         }
        
        

        
        if(getQueryVariable('name') != false){
        $("#search-articles-submit").val(getQueryVariable('name'))
        }
        
        $("#search-articles-form").submit();
        
        
    
        });
    
    
    function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = query.split("&");
   for (var i=0; i < vars.length; i++) {
       var pair = vars[i].split("=");
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}
    
    
    
    $(".form-discount").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){ 
                $button.html("<i class='fa fa-refresh fa-spin'></i>");

            },
            success: function(data){
              
                
               
                
                setTimeout(function(){
                    
                    $button.html(data.texto).attr("class", data.clase);
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                
            }
        });
        
        return false;
        
    });
    
    
    
    $(".form-featured").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){ 
                $button.html("<i class='fa fa-refresh fa-spin'></i>");

            },
            success: function(data){
              
                
               
                
                setTimeout(function(){
                    
                    $button.html(data.texto).attr("class", data.clase);
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                
            }
        });
        
        return false;
        
    });
    
    
    
    
    
    
    $("#store-status-form").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){ 
                $button.html("<i class='fa fa-refresh fa-spin'></i>");

            },
            success: function(data){
              
                
               
                
                setTimeout(function(){
                    
                    $button.html(data.texto).attr("class", data.clase);
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                
            }
        });
        
        return false;
        
    });
    
    $("#delete-carts-form").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){ 
                $button.html("<i class='fa fa-refresh fa-spin'></i> Eliminando carritos");

            },
            success: function(data){
                  
                    $button.html(data.texto).css("background-color", "#00c853");
                $("#noUserCartsCount").html("0");
                setTimeout(function(){
                    
                     $button.html('Eliminar carritos obsoletos').css("background-color", "#00a8d6");
                   
                    
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                
            }
        });
        
        return false;
        
    });
    
    
    
    
    $("#update-emails-form").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){ 
                $button.html("<i class='fa fa-refresh fa-spin'></i> Actualizando correos");

            },
            success: function(data){
              
                    $button.html(data.texto).css("background-color", "#00c853");
              
                setTimeout(function(){
                    
                     $button.html('Actualizar correos').css("background-color", "#00a8d6");
                   
                    
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                
            }
        });
        
        return false;
        
    });
    
    
    
    $("#message_form").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){
                $button.attr('style','font-size:12px;transition:none;');
                $button.html("<i class='fa fa-refresh fa-spin'></i> Enviando mensaje");

            },
            success: function(data){
              
                $button.attr('style','');
                
                if(data.status === 'success'){
                    
                    $button.html("¡Mensaje enviado!").css("background-color", "#00c853");
                    $('#message_form')[0].reset();
                
                }else{
                
                    $button.css("background-color", "#d50000").html("Falló la verificación");    
                
                }
                
                
                
                setTimeout(function(){
                    
                    restartButtonMessage($button);
                    grecaptcha.reset();
                    
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                  setTimeout(function(){
                    
                    restartButtonMessage($button);
                    
                },3000);
            }
        });
        
        return false;
        
    });
    
    
    function restartButtonMessage($button){
        $button.html("Enviar mensaje").attr("style", "");
    }
    
    
    $(".form-visible").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){ 
                $button.html("<i class='fa fa-refresh fa-spin'></i>");

            },
            success: function(data){
              
                
               
                
                setTimeout(function(){
                    
                    $button.html(data.texto).attr("class", data.clase);
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                
            }
        });
        
        return false;
        
    });
    
    
    
      $(".shopping_cart_form").on("submit", function(ev){
       ev.preventDefault();
        
        var $form = $(this);
        var $button = $form.find("[type='submit']");
        
        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            dataType:"JSON",
            beforeSend: function(){
                $button.html("<i class='fa fa-refresh fa-spin'></i> Agregando al carrito");
            },
            success: function(data){
                $button.css("background-color", "#00c853").html("Agregado al carrito");
                
                $(".item-count").html(data.products_count + " ");
                
                setTimeout(function(){
                    restartButton($button);
                },3000);
                
            },
            error: function(err){
                console.log(err);
                $button.css("background-color", "#d50000").html("Hubo un error");
                
                setTimeout(function(){
                    restartButton($button);
                },3000);
            }
        });
        
        return false;
        
    });
    
    function restartButton($button){
        $button.html("<i class='fa fa-shopping-cart'></i> Agregar al carrito").attr("style", "");
    }
    
    
});
    
});
    
$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {type: 'PUT'};
    $.fn.editable.defaults.showbuttons = false;
$(document).ready(function(){
    
    $(".set-guide-number").editable();
    $(".select-status").editable({
        source: [
            {value:"Por procesar", text: "Por procesar"},
            {value:"Por enviar", text: "Por enviar"},
            {value:"Enviado", text: "Enviado"}
        ]
    });
    
    
  




});


jQuery(document).ready(function($){

    
    
    

	/*$(window).resize(function(){
		if ($(window).width() >= 1000){ //768	
			$(".responsive_menu").hide();
		}	
	});
*/
	/************** SuperFish Menu *********************/
		function initSuperFish(){
			
			$(".sf-menu").superfish({
				 delay:  50,
				 autoArrows: true,
				 animation:   {opacity:'show'}
				 //cssArrows: true
			});
			
			// Replace SuperFish CSS Arrows to Font Awesome Icons
			$('nav > ul.sf-menu > li').each(function(){
				$(this).find('.sf-with-ul').append('<i class="fa fa-angle-down"></i>');
			});
		}
		
		initSuperFish();



	/************** Portfolio Carousel *********************/
		/*function initOwlCarousel(){

			$("#portfolio-carousel").owlCarousel({
				items : 4,
				navigation : false,
				pagination : false,
				autoPlay : true,
				navigationText : ["",""],
			}); 

		}

		initOwlCarousel();

*/

	/************** bxSlider (Testimonials) *********************/
		/*function initbxSlider(){

			$('.bxslider').bxSlider({
				adaptiveHeight : true,
				controls : false,
				auto : true,
				mode : 'fade',
			});

		}

		initbxSlider();



	/************** FlexSlider *********************/
		/*function initFlexSlider(){

			$('.flexslider').flexslider({
				controlNav: false,
				animation: 'slide',
				prevText: '',
				nextText: ''
			});

		}

		initFlexSlider();



	/************** FancyBox *********************/
	/*	function initFancyBox(){

			$(".fancybox").fancybox({
				padding: 5,
				titlePosition: 'over'
			});

		}

		initFancyBox();



	/************** MixitUp *********************/
	/*	$('#Grid').mixitup({
	        effects: ['fade','grayscale'],
	        easing: 'snap',
	        transitionSpeed: 400
	    });




	/************** Flickr Feed *********************/
		/*function initFlickrFeed(){

			$('#flickr-feed').jflickrfeed({
				limit: 8,
				qstrings: {
					id: '44802888@N04'
				},
				itemTemplate: 
				'<li>' +
					'<a href="{{image_b}}" class="fancybox"><img src="{{image_s}}" alt="{{title}}" /></a>' +
				'</li>'
			});

		}

		initFlickrFeed();




	/************** Parallax Scrolling Backgrounds *********************/
	/*	$('#homeIntro').parallax("50%", 0.3);
		$('#blogPosts').parallax("80%", 0.3);
		$('.pageTitle').parallax("50%", 0.3);
		



	/************** Responsive Navigation *********************/
		$('.menu-toggle-btn').click(function(){
	        $('.responsive_menu').slideToggle();
	    });


	/************** Contact Form *********************/
	   /* $(".contact-form #submit").click(function() { 
	        //collect input field values
	        var user_name       = $('input[name=name]').val(); 
	        var user_email      = $('input[name=email]').val();
	        var user_subject      = $('input[name=subject]').val();
	        var user_message    = $('textarea[name=message]').val();
	        
	        //simple validation at client's end
	        //we simply change border color to red if empty field using .css()
	        var proceed = true;
	        if(user_name==""){ 
	            $('input[name=name]').css('border-color','red'); 
	            proceed = false;
	        }
	        if(user_email==""){ 
	            $('input[name=email]').css('border-color','red'); 
	            proceed = false;
	        }
	        if(user_subject=="") {    
	            $('input[name=subject]').css('border-color','red'); 
	            proceed = false;
	        }
	        if(user_message=="") {  
	            $('textarea[name=message]').css('border-color','red'); 
	            proceed = false;
	        }

	        	

	        //everything looks good! proceed...
	        if(proceed) 
	        {
	            //data to be sent to server
	            post_data = {'userName':user_name, 'userEmail':user_email, 'userSubject':user_subject, 'userMessage':user_message};
	            
	            //Ajax post data to server
	            $.post('contact.php', post_data, function(data){  
	                
	                //load success massage in #result div element, with slide effect.       
	                $("#result").hide().html('<div class="success">'+data+'</div>').slideDown();

	                //reset values in all input fields
                	$('.widget-inner input').val(''); 
                	$('.widget-inner textarea').val(''); 
	                
	            }).fail(function(err) {  //load any error data
	                $("#result").hide().html('<div class="error">'+err.statusText+'</div>').slideDown();
	            });
	        }
	                
	    });
	    
	    //reset previously set border colors and hide all message on .keyup()
	    $(".contact-form input, .contact-form textarea").keyup(function() { 
	        $(".contact-form input, .contact-form textarea").css('border-color',''); 
	        $("#result").slideUp();
	    });
    
   

	/* wow
	-------------------------------*/
	new WOW().init();    
    
  


    

});

  

 