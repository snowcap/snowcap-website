(function($) {

    var Flipper = function(element) {
        var _element = $(element);
        var _this = this;
        var _pixels;
        if (_element.hasClass('flipper_thumb')) {
            _pixels = 300;
        } else if (_element.hasClass('flipper_small')) {
            _pixels = 100;
        }
        _this.init = function() {
            _element.hover(
                function(event) {
                    _element.find('img').animate({'left': '+=' + _pixels}, 'fast');
                },
                function(event) {
                    _element.find('img').animate({'left': '-=' + _pixels}, 'fast');
                }
            );
        };
        _this.init();
    };

    /**
     * Namespace in jQuery
     */
    $.fn.Flipper = function() {
        return this.each(function() {
            new Flipper(this);
        });
    };

    // DOMREADY
    $(document).ready(function(event) {
        // Flip images on latest project for homepage
        $('.flipper').Flipper();
        // Remove title on latest project for homepage links
        $(".home .projects li a").attr('title', '');
    });

})(jQuery);