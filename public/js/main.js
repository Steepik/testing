$(document).ready(function(){
    $('.c-save').on('click', function(){
        $.ajax({
            method: 'POST',
            url: "",
            data: form.serialize(),
        })
            .done(function (data) {
                console.log(data);
            });
    });
});