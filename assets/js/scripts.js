$(function(){
    var body = $('body');

    // Показ формы отправки отзыва
    body.on('click', '#testimonial-open', function() {
        $('#testimonial-form').slideDown();
    });

    // Добавление нового отзыва
    body.on('submit', '#testimonial-form', function(evt){
        evt.preventDefault();
        let form = $(this);
        let btn=form.find('button[type=submit]');
        let formData = form.serialize();
        btn.prop('disabled',true);
        $('#testimonial-errors').empty();
        $.post($(this).prop('action'), formData, function(respData) {
            btn.prop('disabled',false);
            if (respData.status==='success') {
                $('#testimonial-empty').remove();
                $('#testimonials-header').after(respData.html);
                $('#testimonial-form').slideUp();
                form[0].reset();
            } else {
                $.each(respData.errors, function (key, val) {
                    $('#testimonial-errors').append('<li>'+val+'</li>');
                });
            }
        }, 'json');
    });
});
