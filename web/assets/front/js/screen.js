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
            }
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
            _this.moveToActive(0)
            _handle.show();
            _element.find('a').hover(_this.follow, _this.gohome);
            _element.find('a').click(function (event) {
                $(this).unbind('hover');
            });
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
        var max_elements = 4;
        $('li', _element).each(function (offset, element) {
            if (offset >= max_elements) {
                $(element).hide();
            }
        });
        setInterval(function () {
            var first_child = $('li:first-child', _element);
            var siblings = first_child.siblings();
            first_child.slideUp(1000);
            $(siblings[max_elements - 1]).fadeIn(1000, function () {
                _element.append(first_child);
                first_child.hide();
            });

        }, 5000);


    };
    $.fn.twitterFeed = function () {
        return this.each(function () {
            new TwitterFeed(this);
        });
    };

    var CommentForm = function (element) {
        var _this = this;
        var _element = $(element);
        var _container = _element.parents('.comments-container');

        /**
         * CommentForm init
         */
        _this.init = function () {
            _element.submit(function () {
                $(':submit', this).click(function () {
                    return false;
                });
                $.post(_element.attr('action'), _element.serialize(), function (data, response, xhr) {
                    var html = $(data);
                    _container.replaceWith(html);
                    $('form', html).commentForm();
                });

                return false;
            });
        };
        /* INIT */
        _this.init();
    };
    $.fn.commentForm = function () {
        return this.each(function () {
            new CommentForm(this);
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
                $('.qtip').hide();
                _element.show();
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
                $('.qtip').fadeOut(500);
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
                'zoom':13,
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
                new google.maps.Size(40, 15),
                new google.maps.Point(0, 0),
                new google.maps.Point(20, 15)
            );
            var shadow = new google.maps.MarkerImage(
                'assets/front/images/marker_shadow.png',
                new google.maps.Size(52, 15),
                new google.maps.Point(0, 0),
                new google.maps.Point(20, 15)
            );
            var shape = {
                coord:[25, 0, 26, 1, 27, 2, 28, 3, 29, 4, 30, 5, 31, 6, 32, 7, 33, 8, 34, 9, 35, 10, 36, 11, 37, 12, 38, 13, 39, 14, 14, 14, 13, 13, 12, 12, 11, 11, 10, 10, 9, 9, 8, 8, 7, 7, 6, 6, 5, 5, 4, 4, 3, 3, 2, 2, 1, 1, 0, 0, 25, 0],
                type:'poly'
            };
            var marker = new google.maps.Marker({
                'icon': image,
                'shadow': shadow,
                'shape': shape,
                'map': _map,
                'position': latlng
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
            script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=snowcap_map_init";
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
    $.fn.snowMap = function() {
        return this.each(function(){
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
        // Autoscroll twitter feed
        $('section.tweets ul').twitterFeed();
        // Ajaxify comments posts
        $('.comments form').commentForm();
        $('.technology').technoTip();
        // Observer external links
        $('a[rel*=external]').click(function (event) {
            event.preventDefault();
            window.open(this.href);
        });
        $('.snowcap-map').snowMap();
    });
})(jQuery);