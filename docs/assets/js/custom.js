(function($) {
	
    $(function() {

        var documenter = function(options) {
			var nav = jQuery('.navigation'), obj = [],
			section = $('#documenter-content>section');
					
			section.each(function(i, val) {
				var self = $(this),
				scrollData = parseInt(self.position().top);
				obj.push(scrollData);				
				
			});

			var defaults = {
				duration : 400,
				easing : 'easeOutCirc'
			}

			var o = $.extend({}, defaults , options);

			return {
				events : function() {
				}
			}

		};

		var NAV = new documenter({
			duration: 1100
		});
		NAV.events();

		if ( $('.lightbox').length ) {

			var $lightbox = $('.lightbox');

			$lightbox.fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});		
		}

	});

})(jQuery);

	