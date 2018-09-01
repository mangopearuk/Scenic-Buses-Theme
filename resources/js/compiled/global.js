/**
 * Global JS for the website
 */

jQuery(document).ready(function($){

	/**
	 * CONTENTS
	 *
	 * [1]	Re-initialise LazyLoadXT on resize
	 * [2]	Smoothly scroll to anchors
	 */


	/**
	 * [1]	Re-initialise LazyLoadXT on resize
	 */
	
	var resizeTimeout;

	$(window).resize(function(){
		resizeTimeout = setTimeout(function(){
			$(window).lazyLoadXT({
				checkDuplicates: false
			});

			clearTimeout(resizeTimeout);
		}, 250);
	});





	/**
	 * [2]	Smoothly scroll to anchors
	 */
	
	$('a[href*="#"]:not([href="#"]), .js-smooth-scroll').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			

			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});





	/**
	 * [3]	Turn route lists into carousels
	 */
	
	$('.js-carousel--routes').owlCarousel({
		margin: 		10,
		navElement: 	'button',
		navText:        ['<svg class="o-icon" height="24" width="24" role="presentation"><use xlink:href="/sprites/mangopear-icons.svg#arrow-left"/></svg>',
		                 '<svg class="o-icon" height="24" width="24" role="presentation"><use xlink:href="/sprites/mangopear-icons.svg#arrow-right"/></svg>'],
		responsiveClass:true,
		responsive:{
			0 : {
				items: 			1,
				nav: 			false,
				autoHeight: 	true
			},
			600:{
				items: 			2,
				nav: 			false,
				autoHeight: 	false
			},
			900:{
				items: 			3,
				nav: 			true,
				autoHeight: 	false
			}
		}
	});





	/**
	 * [3]	Routes > Places of interest carousel
	 */
	
	$('.js-carousel--places').owlCarousel({
		margin: 		10,
		navElement: 	'button',
		navText:        ['<svg class="o-icon" height="24" width="24" role="presentation"><use xlink:href="/sprites/mangopear-icons.svg#arrow-left"/></svg>',
		                 '<svg class="o-icon" height="24" width="24" role="presentation"><use xlink:href="/sprites/mangopear-icons.svg#arrow-right"/></svg>'],
		responsiveClass:true,
		responsive:{
			0 : {
				items: 			1,
				nav: 			false,
				autoHeight: 	true
			},
			600:{
				items: 			2,
				nav: 			false,
				autoHeight: 	false
			},
			900:{
				items: 			3,
				nav: 			true,
				autoHeight: 	false
			}
		}
	});
	
});