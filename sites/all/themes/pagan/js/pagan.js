(function ($) {
    $(document).ready(function () {

        $(window).load(function() {
            equalheight('.equal-height');
        });


        $(window).resize(function(){
            equalheight('.equal-height');
        });
    });
})(jQuery);
