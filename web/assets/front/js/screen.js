(function($){

    var flipper = function(element) {

        this.element = $(element);
        var _this = this;
        _this.front = $('.project-thumb-front',this.element);

        this.element.bind('mouseenter mouseleave', function(event) {
            _this.front.fadeToggle(200);
        });
    };

    /**
	 * Namespace in jQuery
	 */
	$.fn.flipper = function(){
       return this.each(function(){
           new flipper(this);
       });
	};

	// DOMREADY
	$(document).ready(function(event){

        $(".project-thumb-link").flipper();
    });

})(jQuery);