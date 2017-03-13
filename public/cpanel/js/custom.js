/**
 * Created by h-sx on 12/03/2017.
 */

$(document).ready(function(){

    $('#addPropertyLink').on('click', function (e) {
        e.preventDefault();

        $name_value = $('#properties').children(':last-child').find('input').attr('name');

        if($name_value){
        $id = parseInt($name_value.slice(-1)) + 1;
        }else{
          $id = 1;
        }

        $('#properties').append("<div class='form-group'><div class='input-group'><input class='form-control' required='required' placeholder='Agregue una propiedad como talla, color, entre otras' name='option_"+$id+"' type='text' aria-describedby = 'delete-form'>" +
            "<span class='input-group-addon' id='delete-form'><a href='#' class='removeForm'><span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span></a></span></div></div>");

    });

    $('.removeForm').live('click', function (e) {
        e.preventDefault();

       $(this).closest('.form-group').remove();



    });



});


