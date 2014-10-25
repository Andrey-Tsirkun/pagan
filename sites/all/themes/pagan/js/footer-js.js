(function ($) {
    $(document).ready(function () {

        $(window).bind('scroll',function(e){
            parallaxScroll();
        });

        function parallaxScroll(){
            var scrolledY = $(window).scrollTop();
            $('.bg-wrapper').css('background-position','center -'+((scrolledY*0.1))+'px');
        }

    });
})(jQuery);
