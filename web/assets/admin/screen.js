(function($){
	$(document).ready(function(event){
		$('button, .ui-button').each(function(offset, element){
			var options = {};
			if($(element).hasClass('ui-icon')){
				var classes = $(element).attr('class').split(' ');
				$(element).removeClass('ui-icon');
				$.each(classes, function(offset, candidate){
					if(candidate.indexOf('ui-icon-') !== -1){
						options.icons = {
							primary: candidate
						};
						$(element).removeClass(candidate);
					}
				});
				if($(element).hasClass('ui-button-icon-only')){
					options.text = false;
				}
			}
			$(element).button(options);
		});
		$('.datepicker').datepicker({
			dateFormat: 'm/d/y'
		});
	});
})(jQuery);
