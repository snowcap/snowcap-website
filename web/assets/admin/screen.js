(function($){
	$(document).ready(function(event){
		$('button, .button').button();
		$('.datepicker').datepicker({
			dateFormat: 'm/d/y'
		});
	});
})(jQuery);
