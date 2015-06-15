$(document).ready(function() {
	$(".nav-smallmenu-hide").hide();
	
	var currentWidth = $(window).width();
	if (currentWidth < 800) {
		$(".my-nav > div > div:nth-child(2)~div > div:first-child").hide();
		$(".my-nav > div > div:nth-child(2)").show();
	} else {
		$(".my-nav > div > div:nth-child(2)~div > div:first-child").show();
		$(".my-nav > div > div:nth-child(2)").hide();
	}

	$(window).on('resize', function() {
		$(".nav-smallmenu-hide").hide();
		currentWidth = $(this).width();
		if (currentWidth < 800) {
			$(".my-nav > div > div:nth-child(2)~div > div:first-child").hide();
			$(".my-nav > div > div:nth-child(2)").show();
		} else {
			$(".my-nav > div > div:nth-child(2)~div > div:first-child").show();
			$(".my-nav > div > div:nth-child(2)").hide();
		}
	});

	var mouseposition = false;
	$(".my-nav").on('mouseenter', function() {
		mouseposition = true;
		setTimeout(function() {
			if (currentWidth > 800 && mouseposition == true) {
				$(".nav-hide").slideDown(600);
				$(".my-nav > div:last-child").slideDown(300);
			}
		}, 300);
	});

	$(".my-nav").on('mouseleave', function() {
		mouseposition = false;
		setTimeout(function() {
			if (currentWidth > 800 && mouseposition == false) {
				$(".nav-hide").slideUp(300);
				$(".my-nav > div:last-child").slideUp(500);
			}
		}, 300);
	});

	var menubar = $(".my-nav");
	var pos = menubar.offset();
	var posflag = false;
	$(window).on("scroll", function() {
		if ($(this).scrollTop() > pos.top) {
			if (!posflag) {
				menubar.addClass('nav-fix');
				posflag = true;
			}
		} else {
			if (posflag) {
				menubar.removeClass('nav-fix');
				posflag = false;
			}
		}
	});

	$("#custom_smallicon").on('click', function(){
		$(".nav-smallmenu-hide").show();
		$(".my-nav > div:last-child").slideToggle(300);
	});
});