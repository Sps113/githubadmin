document.addEventListener("DOMContentLoaded", function(){

    $('button#submitForm').on('click', function(e){
        e.preventDefault();
        var $this = $(this);
        console.log( $($this[0].parentElement).attr('action'));
        $.ajax({
            url: $($this[0].parentElement).attr('action'),
            method: 'POST',
            data: $($this[0].parentElement).serialize(),
            success: function(data){
                $('.alert').alert();
                console.log(data);
                successString='<div class="alert alert-success" role="alert"><li>' +data.message + '</   li><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                $("#messages").append(successString);
            }
        }).done(function(data){
            
        }).fail(function(data){
            $('.alert').alert();
            var response = JSON.parse(data.responseText);
            var errorString = '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
            $.each( response.errors, function( key, value) {
                errorString += '<li>' + value + '</li>';
            });
            errorString += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $("#messages").append(errorString);
        });
    });
});