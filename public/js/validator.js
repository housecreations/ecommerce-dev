
$(document).ready(function () {

    var $form = $('[required]').closest('form');

    $form.find(':submit').click(function (e) {
       e.preventDefault();
        var invalid = $form.find(':invalid');

        if(invalid[0]){
        invalid[0].focus();
        toastr.warning('Completa el campo');

        }else{
            $form.submit();
        }

    });

});