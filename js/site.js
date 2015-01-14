(function($) {
	var blog = (function() {
		return {
			init: function() {
				
			}
		}
	})();
	var content_single = (function() {
		
		return {
			init: function() {
				$('a').tooltip();
		        $('#main-content').delegate('#comment','focus', function(){
		            $('#commentform').addClass('active');
		            $('.comment-form-comment textarea').autosize();
		        });
		        $('#main-content').delegate('.wpcf7-textarea','focus', function(){
		            $('.wpcf7-textarea').autosize();
		        });
		        $('#main-content a.read-mod').on('click', function() {
		        	var isin = $(this).hasClass('active');
		        	if(isin) {
		        		$('.site-content').removeClass('site-read-mod');
		        		$('i', this).attr("class", "fa fa-eye");
		        		$(this).removeClass("active");
		        		$(this).attr("title", "Read Mod");
		        		$(this).tooltip('hide')
								  .attr('data-original-title', "Read Mod")
								  .tooltip('fixTitle')
								  .tooltip('show');
		        	} else {
		        		$('.site-content').addClass('site-read-mod');
		        		$('i', this).attr("class", "fa fa-eye-slash");
		        		$(this).addClass("active");
		        		$(this).attr("title", "Close Read Mod");
		        		$(this).tooltip('hide')
								  .attr('data-original-title', "Close Read Mod")
								  .tooltip('fixTitle')
								  .tooltip('show');
		        	}
		        	event.preventDefault();
		        });
				$('#main-content').delegate('.font-size-minus', 'click',function(event){
				        event.preventDefault();
				        var entry = $('.entry-content'),
				            fontSize = parseInt( entry.css('font-size').replace('px','') );
				        if( fontSize <= 14 ) {
				            return false;
				        } else {
				            entry.css('font-size', fontSize - 2).css('line-height','1.5');
				        }      
				    });
				    $('#main-content').delegate('.font-size-plus', 'click',function(event){
				        event.preventDefault();
				        var entry = $('.entry-content'),
				            fontSize = parseInt( entry.css('font-size').replace('px','') );
				        if( fontSize >= 22 ) {
				            return false;
				        } else {
				            entry.css('font-size', fontSize + 2).css('line-height','1.5');
				        }      
				    });
			}
		}
	})();
	var common = (function() {
		return {
			init: function() {
				//subMenu
				jQuery('.site-nav').superfish({
					delay: 100,
					animation:   {opacity:'show',height:'show'}, 
					speed:       'fast'
				});	
			}
		}
	})();
	
	var init = {
		 /** Blog **/
		 blog: function() {
		 	blog.init();
		 },
		 /** Single **/
		 content_single: function() {
		 	content_single.init();
		 },
		 /** Some common functions **/
		 common: function() {
		 	common.init();
		 }
		
	};
	
	// Initialization
	var $page = jQuery('.site-content').attr('id');
	if (init[$page]) {
        init[$page]();
        init['common']();
    } else {
    	init['common']();
    }
})(jQuery);