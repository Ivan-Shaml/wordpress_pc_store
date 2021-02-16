;(function($) {
'use strict'
// Dom Ready

	var back_to_top_scroll = function() {
			
			$('#backToTop').on('click', function() {
				$("html, body").animate({ scrollTop: 0 }, 500);
				return false;
			});
			
			$(window).scroll(function() {
				if ( $(this).scrollTop() > 500 ) {
					
					$('#backToTop').addClass('active');
				} else {
				  
					$('#backToTop').removeClass('active');
				}
				
			});
			
		}; // back_to_top_scroll   
	//Trap focus inside mobile menu modal
	//Based on https://codepen.io/eskjondal/pen/zKZyyg	
	var trapFocusInsiders = function(elem) {
		
			
		var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
		
		var firstTabbable = tabbable.first();
		var lastTabbable = tabbable.last();
		/*set focus on first input*/
		firstTabbable.focus();
		
		/*redirect last tab to first input*/
		lastTabbable.on('keydown', function (e) {
		   if ((e.which === 9 && !e.shiftKey)) {
			   e.preventDefault();
			   
			   firstTabbable.focus();
			  
		   }
		});
		
		/*redirect first shift+tab to last input*/
		firstTabbable.on('keydown', function (e) {
			if ((e.which === 9 && e.shiftKey)) {
				e.preventDefault();
				lastTabbable.focus();
			}
		});
		
		/* allow escape key to close insiders div */
		elem.on('keyup', function(e){
		  if (e.keyCode === 27 ) {
			elem.hide();
		  };
		});
		
	};	
	
	$(function() {
		
		back_to_top_scroll();
		
		//$('.theme-btn').data('text','saiful');
		//$('.theme-btn').attr("data-text",$(this).find('span').html());
		
		$( ".theme-btn.inverted" ).each(function( index ) {

			$(this).attr("data-text",$(this).find('span').html());
			
		});


		
		/*--------------------------------------------------------------
		# Header
		--------------------------------------------------------------*/
		if( $('.rd-navbar').length ){ 
		 $('.rd-navbar').RDNavbar({ stickUpClone: false, stickUpOffset: 160});   
		}
			
			/*------------Main Menu For desktop-------*/
			if( $('.rd-navbar-static .rd-navbar-nav li > a').length ){
				
				$( ".rd-navbar-wrap,.rd-navbar-static .rd-navbar-nav li a" ).hover(function() {
					$( ".rd-navbar-static .rd-navbar-nav li" ).removeClass('nav_focus_mod');

					$('.menu-category-list,.top-form-minicart').removeClass('focus-active').removeClass('mb-active');
				});

				$(".rd-navbar-static .rd-navbar-nav li > a").keyup(function() {
		
					$( ".rd-navbar-static .rd-navbar-nav li" ).removeClass('focus').addClass('nav_focus_mod');	
					
					if( $(this).parents('li.rd-navbar-submenu').length ){
						$(this).parent('li').addClass('focus');
					}
					
					if( $('.menu-category-list,.top-form-minicart').length ){
						$('.menu-category-list,.top-form-minicart').removeClass('mb-active');
					}
				});

				$( ".rd-navbar-static li.rd-navbar-submenu li > a" ).keyup(function() {
					$(this).parents('li.rd-navbar-submenu').addClass('focus');
				});
			}
		
			/*------------toggle------*/
			if( $('.grocery-store-rd-navbar-toggle').length ){
					
				$('.grocery-store-rd-navbar-toggle').on('click', function() {
					
					$('.rd-navbar-nav-wrap.toggle-original-elements').toggleClass('active');
					$(this).find('i').toggleClass('icofont-arrow-left').toggleClass('icofont-navigation-menu');
					$('.rd-navbar-fixed .rd-navbar-submenu-toggle').attr('tabindex', 0).attr('autofocus', 'true');
					
					return false;
				}); 
			
				$('.rd-navbar-toggle.toggle-original').on('click', function() {
					$('.rd-navbar-nav-wrap.toggle-original-elements,.rd-navbar-fixed .rd-navbar-nav-wrap').removeClass('active');
					$('.grocery-store-rd-navbar-toggle').find('i').removeClass('icofont-arrow-left').addClass('icofont-navigation-menu');
					$('.rd-navbar-fixed .rd-navbar-submenu-toggle').removeAttr('tabindex').removeAttr('autofocus');
					$(this).removeClass('active');
				}); 
				
				
			}
			
			$('.rd-navbar-nav li > .rd-navbar-submenu-toggle').keyup(function (e) {	
				e.preventDefault();
				var code = e.keyCode || e.which;
				if(code == 13) { 
					$(this).parents('li.rd-navbar-submenu').eq(0).toggleClass('opened');
				}
			}); 
			 
			
			$(window).on('load resize', function() {
				
				if ( matchMedia( 'only screen and (max-width: 992px)' ).matches ) {
					
					trapFocusInsiders( $('.rd-navbar-fixed .rd-navbar-nav-wrap') );
					
				}else{
				
					$('.rd-navbar-nav-wrap.toggle-original-elements,.rd-navbar-fixed .rd-navbar-nav-wrap').removeClass('active');
					$('.grocery-store-rd-navbar-toggle').find('i').removeClass('icofont-arrow-left').addClass('icofont-navigation-menu');
					
					$('.rd-navbar-fixed .rd-navbar-submenu-toggle').removeAttr('tabindex').removeAttr('autofocus');
					
				}	
			});
		
		/*-------------- Focus For Min Cart--------------------------*/
		
			$('.menu-category-list,.top-form-minicart').on('keydown', function(event) {
				$(this).addClass('focus-active').addClass('mb-active');

			});
			$(".menu-category-list a,.top-form-minicart a").keyup(function() {	
				if( $(this).parents('.menu-category-list').length ){
					$('.menu-category-list').addClass('mb-active');
				}
				if( $(this).parents('.top-form-minicart').length ){
					$('.top-form-minicart').addClass('mb-active');
				}
			});

	
	

		$('#static_header_banner,#primary,#masthead').on('keydown', function(event) {
					
				$('.rd-navbar-static .rd-navbar-nav li.menu-item-has-children').removeClass('opened').removeClass('focus');
				$( ".rd-navbar-static .rd-navbar-nav li" ).removeClass('nav_focus_mod');
				$('.menu-category-list,.top-form-minicart').removeClass('focus-active').removeClass('mb-active');
				
		});
		
		
		/*--------------------------------------------------------------
		# Header
		--------------------------------------------------------------*/

		if( $('#secondary').length ){

			$('#secondary').stickySidebar({
				topSpacing: 60,
				bottomSpacing: 60,
			});
		}

		if( $('.owlGallery').length ){
			$(".owlGallery").owlCarousel({
				stagePadding: 0,
				loop: true,
				autoplay: true,
				autoplayTimeout: 2000,
				margin: 0,
				nav: false,
				dots: false,
				smartSpeed: 1000,
				rtl: ( $("body.rtl").length ) ? true : false, 
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 1
					},
					1000: {
						items: 1
					}
				}
			});
		}
		
	});

	 $(window).on ('load', function (){ // makes sure the whole site is loaded

        // ------------------------------- AOS Animation 
        AOS.init({
          duration: 500,
          mirror: true
        });
	});
})(jQuery);