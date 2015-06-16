function changetab_byhash() {
	var hashValue = window.location.hash;
    hashValue = hashValue.substr(1);
    if(hashValue) {
    	hashValue = parseInt(hashValue);
        if(hashValue == NaN)
        	return;
        hashValue -= 1;
        var tabs = $('#set-nn_tabs-1').find('li');
        var id_name = "";
        tabs.each(function(i, v){
        	v.removeClass('active');
            if(i === hashValue)
            	id_name = $(v).find('a').eq(0).attr('data-id');
        });
        tabs.eq(parseInt(hashValue)).addClass('active');
        $('.tab-content').find("div").each(function(i, v){ v.removeClass('active'); });
        $('#'+id_name).addClass('active');
        $tab_content = $('.tab-content').eq(0);
		var top = $tab_content.offset().top;
    	$(window).scrollTop(top);
    }
}
$(changetab_byhash);
$(window).on('hashchange', changetab_byhash);

// $(function(){
//     $('[itemprop="articleBody"]').children("p").find("img").css('float','right');
//     $('[itemprop="articleBody"]').children("div").css('clear','both');
// });
