(function($) {
    /**
     * Flipper class constructor
     *
     * @param DOMElement element
     */
    var Flipper = function(element) {
        var _element = $(element);
        var _this = this;
        var _left = _element.width();
        /**
         * Flipper init
         * 
         */
        _this.init = function() {
            _element.hover(
                function(event) {
                    _element.find('img').animate({'left': '+=' + _left}, 200);
                },
                function(event) {
                    _element.find('img').animate({'left': '-=' + _left}, 200);
                }
            );
        };
        /* Init() */
        _this.init();
    };
    /**
     * Namespace Flipper in jQuery
     */
    $.fn.flipper = function() {
        return this.each(function() {
            new Flipper(this);
        });
    };
    /**
     * Map class constructor
     *
     * @param DOMElement element
     */
    var Map = function(element) {
        var _bareElement = element;
        var _element = $(element);
        var _this = this;
        var latlng = new google.maps.LatLng(50.85, 4.35);
        var options = {
            'zoom': 13,
            'center': latlng,
            'mapTypeId': google.maps.MapTypeId.ROADMAP,
            'disableDefaultUI': true,
            'zoomControlOptions': {
                'style': google.maps.ZoomControlStyle.SMALL
            }
        };
        var map = new google.maps.Map(_bareElement, options);
    };
    /**
     * Namespace Map in jQuery
     * 
     */
    $.fn.map = function() {
        return this.each(function() {
            new Map(this);
        });
    };
    /**
     * DOMREADY
     * 
     */
    $(document).ready(function(event) {
        // Flip images on latest project for homepage
        $('.flipper').flipper();
        // Remove title on latest project for homepage links
        $(".home .projects li a").attr('title', '');
        $('.snowcap-map').map();
    });
})(jQuery);