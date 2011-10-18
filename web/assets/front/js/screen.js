(function($) {

    var Flipper = function(element) {
        var _element = $(element);
        var _this = this;
        _this.init = function() {
            _element.hover(
                function(event) {
                    _element.find('img').animate({'left': '+=300'}, 'fast');
                },
                function(event) {
                    _element.find('img').animate({'left': '-=300'}, 'fast');
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
        $('.home section.projects li a').Flipper();
    });

})(jQuery);