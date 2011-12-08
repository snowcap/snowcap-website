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
        /* INIT */
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
     * Navigation class constructor
     *
     * @param DOMElement element
     */
    var Navigation = function(element) {
        var _element = $(element);
        var _this = this;
        var _handle;
        var _move;
        /**
         * Move the handle to the specified element
         *
         * @param DOMElement element
         * @param int speed
         */
        _this.moveTo = function(element, speed) {
            var activeOffset = $(element).position().left;
            var handleOffset = activeOffset + element.outerWidth() / 2 - 5;
            _handle.animate({'left': handleOffset}, speed);
        };
        /**
         * Move the handle to the active element
         *
         * @param int speed
         */
        _this.moveToActive = function(speed) {
            var activeElement = _element.find('.active');
            if(activeElement.length > 0) {
                _this.moveTo(activeElement, speed);
            }
        };
        /**
         * Follow (on mouseenter)
         *
         * @param DOMEvent event
         */
        _this.follow = function(event) {
            window.clearTimeout(_move);
            var element = $(this);
            _move = window.setTimeout(function(){
                _this.moveTo(element, 200);
            }, 300);
        };
        /**
         * Go back to active (on mouseleave)
         *
         * @param DOMEvent event
         */
        _this.gohome = function(event) {
            window.clearTimeout(_move);
            _move = window.setTimeout(function(){
                _this.moveToActive(200);
            }, 300);

        };
        /**
         * Navigation init
         *
         */
        _this.init = function() {
            _handle = $('<span>').addClass('handle').hide();
            _element.append(_handle);
            _this.moveToActive(0);
            _handle.show();
            _element.find('a').hover(_this.follow, _this.gohome);
        };
        /* INIT */
        _this.init();
    };

    $.fn.navigation = function(element) {
        return this.each(function() {
            new Navigation(this);
        });
    };
    /* DOMREADY */
    $(document).ready(function(event) {
        // Flip images on latest project for homepage
        $('.flipper').flipper();
        // Remove title on latest project for homepage links
        $(".home .projects li a").attr('title', '');
        $('header nav').navigation();
    });
})(jQuery);