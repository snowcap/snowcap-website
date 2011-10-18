(function($){
	
	var MarkdownPreviewer = function(element){
		this.element = $(element);
		this.latestPreviewContent = "";
		var _this = this;

		/**
		 * Creating the previewer element
		 */
		previewid = "markdown_"+this.element.attr('id');
		this.element.before('<div id="'+previewid+'" class="markdown_previewer">markdown previewer</div>');
		this.previewElement = $('#'+previewid);

		/**
		 * Checking every second if the content has changed: if yes, a little AJAX call to convert the content into markdown format and update the previewer
		 */
		setInterval( function() {
			content = _this.element.val();
			if(_this.latestPreviewContent != content) {
				$.post('/admin/markdown', { content: content }, function(data) {
					_this.previewElement.html(data);
					_this.latestPreviewContent = _this.element.val();
				});
			}
		}, 1000);
	};
	
	
	
	var Slugger = function(element){
		this.element = $(element);
		var _this = this;
		/**
		 * Append a "lock" button to control slug behaviour (auto or manual)
		 */
		this.appendLockButton = function(){
			_this.lockButton = $('<a>').attr('href', 'unlock').html('unlock');
			_this.lockButton.button({
				text: false,
				icons: {
					primary: 'ui-icon-unlocked'
				}
			});
			_this.lockButton.click(function(event){
				event.preventDefault();
				if(_this.lockButton.attr('href') === 'unlock'){
					_this.unlock();
				}
				else{
					_this.lock();
				}
			});
			_this.element.after(_this.lockButton);
		};
		/**
		 * Unlock the widget input (manual mode)
		 * 
		 */
		this.unlock = function(){
			_this.lockButton.attr('href', 'lock');
			_this.element.removeAttr('readonly');
			_this.lockButton.button('option', 'icons', {
				primary: 'ui-icon-locked'
			});
		};
		/**
		 * Lock the widget input (auto mode)
		 */
		this.lock = function(){
			if(confirm("Are you sure you want to go back to auto mode ? The entered slug will be overriden")){
				_this.lockButton.attr('href', 'unlock');
				_this.element.val(_this.makeSlug(_this.target.val()));
				_this.element.attr('readonly', 'readonly');
				_this.lockButton.button('option', 'icons', {
					primary: 'ui-icon-unlocked'
				});
			}
		};
		/**
		 * Transform a string into a slug
		 * 
		 * @param string string
		 * @return string
		 */
		this.makeSlug = function(string){
			var lowercased = string.toLowerCase();
			var hyphenized = lowercased.replace(/\s/g, '-');
			var slug = hyphenized.replace(/[^a-zA-Z0-9\-]/g, '').replace('--', '-').replace(/\-+$/, '');
			return slug;
		};
		/**
		 * Observe the target field and slug it
		 * 
		 */
		this.startSlug = function(){
			_this.target.keyup(function(event){
				if(_this.element.attr('readonly') === 'readonly'){
					_this.element.val(_this.makeSlug($(this).val()));
				}
			});
		};
		/**
		 * Instance init
		 */
		this.init = function(){
			var targetId = $.grep(_this.element.attr('class').split(' '), function(element, offset){
				return element.indexOf('widget-slug-') !== -1;
			}).pop().split('-').pop();
			_this.target = $('#' + targetId);
			_this.element.val(_this.makeSlug(_this.target.val()));
			_this.element.attr('readonly', 'readonly');
			_this.appendLockButton();
			_this.startSlug();
		};
		this.init();
	};
	/**
	 * Namespace in jQuery
	 */
	$.fn.slugger = function(){
       return this.each(function(){
           new Slugger(this);
       });
	};
	$.fn.markdownPreviewer = function(){
       return this.each(function(){
           new MarkdownPreviewer(this);
       });
	};
	// DOMREADY
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
		// Datetimepicker
		$('.widget-datetimepicker').datetimepicker({
			dateFormat: 'm/d/y'
		});
		// Slugs
		$('.widget-slug').slugger();
		// Markdown previewer
		$('.widget-markdown').markdownPreviewer();
	});
})(jQuery);
