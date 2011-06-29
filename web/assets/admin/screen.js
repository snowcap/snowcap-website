(function($){
	$(document).ready(function(event){
		// Icons / buttons
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
		// Datepicker
		$('.widget-datepicker').datepicker({
			dateFormat: 'm/d/y'
		});
		// Slugs
		$('.widget-slug').each(function(offset, slugWidget){
			var lockButton = $('<a>').attr('href', 'unlock').html('unlock');
			lockButton.button({
				text: false,
				icons: {
					primary: 'ui-icon-unlocked'
				}
			});
			$(slugWidget).attr('disabled', 'disabled');
			lockButton.click(function(event){
				event.preventDefault();
				if($(this).attr('href') === 'unlock'){
					$(this).attr('href', 'lock');
					$(slugWidget).removeAttr('disabled');
					lockButton.button('option', 'icons', {
						primary: 'ui-icon-locked'
					});
				}
				else{
					$(this).attr('href', 'unlock');
					$(slugWidget).attr('disabled', 'disabled');
					lockButton.button('option', 'icons', {
						primary: 'ui-icon-unlocked'
					});
				}
			})
			$(slugWidget).after(lockButton);
			var target = $.grep($(slugWidget).attr('class').split(' '), function(element, offset){
				return element.indexOf('widget-slug-') !== -1;
			}).pop().split('-').pop();
			$('#' + target).keyup(function(event){
				if($(slugWidget).attr('disabled') === 'disabled'){
					var lowercased = $(this).val().toLowerCase();
					var hyphenized = lowercased.replace(/\s/g, '-');
					var slug = hyphenized.replace(/[^a-zA-Z0-9\-]/g, '').replace('--', '-').replace(/\-+$/, '');
					$(slugWidget).val(slug);
				}
			});
		});
	});
})(jQuery);
