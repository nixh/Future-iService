(function($){
    $(function(){
        $(".option-table").on('click', function(){
            $('.display-image').css('display', 'none');
            $('.display-table').css('display', 'block');
        });
        $(".option-image").on('click', function(){
            $('.display-table').css('display', 'none');
            $('.display-image').css('display', 'block');
        });

    });
})(jQuery);
