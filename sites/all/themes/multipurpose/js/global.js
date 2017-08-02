jQuery( function($) {

	$(document).ready(function(){

		// Main menu superfish
		$('#main-menu > ul').addClass('dropdown-menu sf-menu');
		$('#main-menu > ul').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: false,
			disableHI: true
		});

		// Mobile Menu
		$('#navigation-toggle').sidr({
			name: 'sidr-main',
			source: '#sidr-close, #site-navigation',
			side: 'left'
		});
		$(".sidr-class-toggle-sidr-close").click( function() {
			$.sidr('close', 'sidr-main');
			return false;
		});

    $(window).scroll(function(){
      var x = $(this).scrollTop();
      $('body').css('background-position','0% '+parseInt(-x/10)+'px');
    });


	}); // End doc ready

	$(window).load(function(){
		// Homepage FlexSlider

		$('#main-menu > ul > li > a.sf-with-ul').append('<i class="fa fa-angle-down"></i>');
		$('#main-menu > ul > li li > a.sf-with-ul').append('<i class="fa fa-angle-right"></i>');

		$('#homepage-slider').flexslider({
			animation: 'fade',
			slideshow: true,
			smoothHeight: true,
			controlNav: false,
			directionNav: true,
			prevText: '<span class="fa fa-caret-left"></span>',
			nextText: '<span class="fa fa-caret-right"></span>',
			controlsContainer: ".flexslider-container"
		});

	}); // End on window load

});
