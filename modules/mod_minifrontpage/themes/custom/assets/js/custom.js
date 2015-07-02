(function($){
    $(function(){
       $(".option-table").on('click', function(){



            $('.display-image').css('display', 'none');
            $('.display-table').css('display', 'block');
            $('.option-image').removeClass('option-selected');
            $('.option-table').addClass('option-selected');
        });
        $(".option-image").on('click', function(){
            $('.display-table').css('display', 'none');
            $('.display-image').css('display', 'block');
            $('.option-table').removeClass('option-selected');
            $('.option-image').addClass('option-selected');
        });

    });
})(jQuery);
