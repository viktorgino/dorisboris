;(function($) {

	window.main = {
		w: $(window),
		d: $(document),
		init: function(){

			main.global.init();		
			main.mobileNav.init();
			main.footerNav.init();
		},

		loaded: function(){
		
		},

		global: {
			init: function(){
				
			}
		},

		body: {
			element: $('body')
		},

		share: {
			init: function(){
				$('.share-popup-btn').on('click', function(e){
					e.preventDefault();

					var url = $(this).attr('href'),
					width = 640,
					height = 305,
					left = ($(window).width() - width) / 2,
					top = ($(window).height() - height) / 2;

					window.open(url, null,'height='+height+',width='+width+',left='+left+',top='+top+',status=yes,toolbar=no,menubar=no,location=no');
					return false;
				});
			}
		},

		mobileNav: {
			element: $('#dl-menu'),

			init: function() {
				main.mobileNav.element.dlmenu({
					animationClasses : { classin : 'dl-animate-in-3', classout : 'dl-animate-out-3' }
				});
			}
		},

		footerNav: {	
			element :$('#footer aside div'),		    
			init: function() {
				if ($(window).width() < 400) {
					var allPanels = main.footerNav.element.hide();

					$('#footer aside > h5').click(function() {
						if($(this).parent().hasClass('open')) {
							allPanels.slideUp();
							$('#footer aside').removeClass('open');
							return false;
						} else {
							$('#footer aside').removeClass('open');
							$(this).parent().addClass('open');
							allPanels.slideUp();
							$(this).next().slideDown();
							return false;
						}
					});
				}
			}
		},		

		equalHeight: function(){
			if($('.equal-height').length !== 0){
		
				var currTallest = 0,
				currRowStart = 0,
				rowDivs = [],
				topPos = 0;

				$('.equal-height').each(function() {

					var element = $(this);
					topPos = element.position().top;
					if (currRowStart !== topPos) {

						for (var i = 0; i < rowDivs.length ; i++) {
							rowDivs[i].height(currTallest);
						}

						rowDivs.length = 0;
						currRowStart = topPos;
						currTallest = element.height();
						rowDivs.push(element);

					} else {
						rowDivs.push(element);
						currTallest = (currTallest < element.height()) ? (element.height()) : (currTallest);
					}

					for (var ii = 0 ; ii < rowDivs.length ; ii++) {
						rowDivs[ii].height(currTallest);
					}

				});
			}
		}
	};

	$(function(){
		window.main.init();
	});

})(jQuery);

