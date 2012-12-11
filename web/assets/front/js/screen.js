(function ($) {
    /**
     * Flipper class constructor
     *
     * @param DOMElement element
     */
    var Flipper = function (element) {
        var _element = $(element);
        var _this = this;
        var _left = _element.width();
        /**
         * Flipper init
         *
         */
        _this.init = function () {
            _element.hover(
                function (event) {
                    _element.find('img').animate({'left':'+=' + _left}, 200);
                },
                function (event) {
                    _element.find('img').animate({'left':'-=' + _left}, 200);
                }
            );
        };
        /* INIT */
        _this.init();
    };
    /**
     * Namespace Flipper in jQuery
     */
    $.fn.flipper = function () {
        return this.each(function () {
            new Flipper(this);
        });
    };
    /**
     * Navigation class constructor
     *
     * @param DOMElement element
     */
    var Navigation = function (element) {
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
        _this.moveTo = function (element, speed) {
            var activeOffset = $(element).position().left;
            var handleOffset = activeOffset + (element.outerWidth() / 2) - 5;
            _handle.animate({'left':handleOffset}, speed);
        };
        /**
         * Move the handle to the active element
         *
         * @param int speed
         */
        _this.moveToActive = function (speed) {
            var activeElement = _element.find('.active');
            if (activeElement.length > 0) {
                _this.moveTo(activeElement, speed);
                return true;
            }
            return false;
        };
        /**
         * Follow (on mouseenter)
         *
         * @param DOMEvent event
         */
        _this.follow = function (event) {
            window.clearTimeout(_move);
            var element = $(this);
            _move = window.setTimeout(function () {
                _this.moveTo(element, 200);
            }, 300);
        };
        /**
         * Go back to active (on mouseleave)
         *
         * @param DOMEvent event
         */
        _this.gohome = function (event) {
            window.clearTimeout(_move);
            _move = window.setTimeout(function () {
                _this.moveToActive(200);
            }, 300);

        };
        /**
         * Navigation init
         *
         */
        _this.init = function () {
            _handle = $('<span>').addClass('handle').hide();
            _element.append(_handle);
            if (_this.moveToActive(0)) {
                _handle.show();
                _element.find('a').hover(_this.follow, _this.gohome);
                _element.find('a').click(function (event) {
                    $(this).unbind('hover');
                });
            }
        };
        /* INIT */
        _this.init();
    };

    $.fn.navigation = function (element) {
        return this.each(function () {
            new Navigation(this);
        });
    };

    var TwitterFeed = function (element) {
        var _this = this;
        var _element = $(element);
        var loader = $('a.ajax-loader', _element);
        var url = loader.attr('href');
        var max_elements = 4;
        _this.scroll = function () {
            var first_child = $('li:first-child', _element);
            var siblings = first_child.siblings();
            first_child.slideUp(1000);
            $(siblings[max_elements - 1]).fadeIn(1000, function () {
                _element.append(first_child);
                first_child.hide();
            });
        };
        _this.init = function () {
            $.get(url, function (data) {
                _element.html(data);
                if ($('li', _element).length > max_elements) {
                    $('li', _element).each(function (offset, element) {
                        if (offset >= max_elements) {
                            $(element).hide();
                        }
                    });
                    setInterval(_this.scroll, 5000);
                }
            })
                .error(function () {
                    // Do nothing
                }
            );
        };
        this.init();


    };
    $.fn.twitterFeed = function () {
        return this.each(function () {
            new TwitterFeed(this);
        });
    };

    var TechnoTip = function (element) {
        var _this = this;
        var _element = $(element);

        /**
         * Technotip init
         */
        _this.init = function () {
            var trigger = _element.prev();
            _element.addClass('qtip');
            var quit;
            trigger.mouseenter(function (event) {
                clearTimeout(quit);
                _element.fadeIn(500);
                $('.qtip').not(_element).hide();
                _element.mouseenter(function (event) {
                    clearTimeout(quit);
                });
                _element.mouseleave(function (event) {
                    quit = setTimeout(function () {
                        _element.fadeOut(500);
                    }, 500);
                });
            });
            trigger.mouseleave(function (event) {
                quit = setTimeout(function () {
                    _element.fadeOut(500);
                }, 500);
            });
            trigger.click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                $('.qtip').not(_element).hide();
                _element.fadeToggle(500);
            });
            $('body').click(function (event) {
                _element.fadeOut(500);
            });
        };
        /* INIT */
        _this.init();
    };
    $.fn.technoTip = function () {
        return this.each(function () {
            new TechnoTip(this);
        });
    };


    /**
     * Map class constructor
     *
     * @param DOMElement element
     */
    var SnowMap = function (element) {
        var _bareElement = element;
        var _element = $(element);
        var _this = this;
        var _map;
        /**
         * Map init
         *
         */
        this.init = function () {
            var latlng = new google.maps.LatLng(50.8337136336712, 4.4054032858797);
            var options = {
                'zoom':12,
                'center':latlng,
                'mapTypeId':google.maps.MapTypeId.TERRAIN,
                'disableDefaultUI':true,
                'zoomControlOptions':{
                    'style':google.maps.ZoomControlStyle.SMALL
                }
            };
            _map = new google.maps.Map(_bareElement, options);
            var image = new google.maps.MarkerImage(
                'assets/front/images/marker_front.png',
                new google.maps.Size(50, 49),
                new google.maps.Point(0, 0),
                new google.maps.Point(25, 49)
            );
            var shadow = new google.maps.MarkerImage(
                'assets/front/images/marker_shadow.png',
                new google.maps.Size(78, 49),
                new google.maps.Point(0, 0),
                new google.maps.Point(25, 49)
            );
            var shape = {
                'coord':[49, 0, 49, 1, 49, 2, 49, 3, 49, 4, 49, 5, 49, 6, 49, 7, 49, 8, 49, 9, 49, 10, 49, 11, 49, 12, 49, 13, 49, 14, 49, 15, 49, 16, 49, 17, 49, 18, 49, 19, 49, 20, 49, 21, 49, 22, 49, 23, 49, 24, 49, 25, 49, 26, 49, 27, 49, 28, 49, 29, 49, 30, 49, 31, 49, 32, 49, 33, 49, 34, 49, 35, 49, 36, 49, 37, 49, 38, 49, 39, 49, 40, 49, 41, 28, 42, 28, 43, 27, 44, 26, 45, 26, 46, 25, 47, 25, 48, 24, 48, 23, 47, 23, 46, 22, 45, 21, 44, 21, 43, 20, 42, 0, 41, 0, 40, 0, 39, 0, 38, 0, 37, 0, 36, 0, 35, 0, 34, 0, 33, 0, 32, 0, 31, 0, 30, 0, 29, 0, 28, 0, 27, 0, 26, 0, 25, 0, 24, 0, 23, 0, 22, 0, 21, 0, 20, 0, 19, 0, 18, 0, 17, 0, 16, 0, 15, 0, 14, 0, 13, 0, 12, 0, 11, 0, 10, 0, 9, 0, 8, 0, 7, 0, 6, 0, 5, 0, 4, 0, 3, 0, 2, 0, 1, 0, 0, 49, 0],
                'type':'poly'
            };
            var marker = new google.maps.Marker({
                'icon':image,
                'shadow':shadow,
                'shape':shape,
                'map':_map,
                'position':latlng
            });
        };
        /**
         * Google maps async load
         */
        if (window.snowcap_map_init === undefined) {
            var script = document.createElement("script");
            script.type = "text/javascript";
            window.snowcap_map_init = function () {
                _this.init();
            };
            script.src = "http://maps.googleapis.com/maps/api/js?v=3.7&sensor=false&callback=snowcap_map_init";
            document.body.appendChild(script);
        }
        else {
            _this.init();
        }
    };
    /**
     * Namespace Map in jQuery
     *
     */
    $.fn.snowMap = function () {
        return this.each(function () {
            new SnowMap(this);
        });
    };

    /* DOMREADY */
    $(document).ready(function (event) {
        // Flip images on latest project for homepage
        $('.flipper').flipper();
        // Remove title on latest project for homepage links
        $(".home .projects li a").attr('title', '');
        // Apply active menu styles
        $('header nav').navigation();
        // Load and autoscroll twitter feed
        $('section.tweets').twitterFeed();
        $('.technology').technoTip();
        // Observer external links
        $('a[rel*=external]').live('click', function (event) {
            event.preventDefault();
            window.open(this.href);
        });
        $('.snowcap-map').snowMap();

        $('a.obem').each(function () {
            a = "sh";
            b = "@";
            e = "snowcap";
            c = "oot";
            d = ".";
            f = "be";
            x = "ma";
            y = "il";
            z = "to";
            m = a + c + b + e + d + f;
            mm = x + y + z + ":" + m;
            $(this).html(m);
            $(this).attr("href", mm);
        });
    });
})(jQuery);