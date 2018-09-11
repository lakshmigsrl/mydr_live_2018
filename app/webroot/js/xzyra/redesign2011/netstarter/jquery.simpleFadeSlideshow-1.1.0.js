/*
 * simpleFadeSlideshow - Name say it all. :)
 * Version: 1.2.0 (03/31/2011)
 * Copyright (c) 2011 netStarter
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 * Requires: jQuery v1.4+
 * By: Shabith Ishan 
*/
(function($){
    $.simpleFadeSlideshow = function(el, options){
        // To avoid scope issues, use 'base' instead of 'this'
        // to reference this class from internal events and functions.
        var base = this;

        // Access to jQuery and DOM versions of element
        base.$el = $(el);
        base.el = el;

        // Add a reverse reference to the DOM object
        base.$el.data("simpleFadeSlideshow", base);

        base.init = function(){

            base.options = $.extend({},$.simpleFadeSlideshow.defaultOptions, options);
			// Set up a few defaults & get details
			
			if (typeof(base.options.onInit) == "function") {
			base.options.onInit();
			}
		
			base.currentPage = base.options.startPanel-1;
			base.timer = null;
			base.playing = false;
			base.$wrapper = base.$el.wrap('<div class="sfs_wrapper" />');
			base.items = base.$el.find('> li').length;
			base.$items = base.$el.find('> li').addClass('panel');
			
			base.$el.addClass('sfs_content');
			
			//activate slide
			$(base.$items[base.currentPage]).addClass('active').css('opacity',1);
			
			base.$wrapper.css('width',(base.options.width!==null) ? base.options.width : $(base.$items[0]).width());
			base.$wrapper.css('height',(base.options.height!==null) ? base.options.height : $(base.$items[0]).height());
			// Make sure easing function exists.
			if (!$.isFunction($.easing[base.options.easing])) { base.options.easing = "swing"; }
			
			// Remove navigation & player if there is only one page
			if (base.items === 1) {
				base.options.autoPlay = false;
				base.options.buildNavigation = false;
				base.options.buildArrows = false;
			}
			
			// If autoPlay functionality is included, then initialize the settings
			if (base.options.autoPlay) {
				base.playing = !base.options.startStopped; // Sets the playing variable to false if startStopped is true
				base.buildAutoPlay();
			}
			
			//Build the Navigation
			if (base.options.buildNavigation) { base.buildNavigation(); }
			
			// Build forwards/backwards buttons
			if (base.options.buildArrows) { base.buildNextBackButtons(); }
			
			// If pauseOnHover then add hover effects
			if (base.options.pauseOnHover) {
				base.$el.hover(function() {
					base.clearTimer();
				}, function() {
					base.startStop(base.playing);
				});
			}
			
			// Add keyboard navigation
			$(window).keyup(function(e){
					switch (e.which) {
						case 39: // right arrow
							base.goForward();
							break;
						case 37: //left arrow
							base.goBack();
							break;
					}
			});

			if (typeof(base.options.onComplete) == "function") {
			base.options.onComplete();
		}

            // Put your initialization code here
        };

        // Sample Function, Uncomment to use
        // base.functionName = function(paramaters){
        //
        // };
		
		
		//build slideshow navigation
		base.buildNavigation = function(){
			base.$navHolder = $('<div class="sfs_nav" />');
			base.$nav = $('<ul />');
			
			base.$items.each(function(i,el){
				$a = $('<a href="#"></a>');
				
				if (typeof(base.options.navigationFormatter) == "function") {
						$a.html(base.options.navigationFormatter((i+1), $(this)));
					} else {
						$a.text((i+1));
					}
				
				$a.bind('click',function(e) {
						base.gotoPage(i);
						e.preventDefault();
					
					});
				if(base.currentPage==i) $a.addClass('cur');
					
				base.$nav.append($a);
				$a.wrap('<li class="nav_link" />');
				
				});
			
			
			base.$nav.appendTo(base.$navHolder);
			base.$el.after(base.$navHolder);
			
		};
		
		// Creates the Forward/Backward buttons
		base.buildNextBackButtons = function() {
			var $forward = $('<span class="arrow forward"><a href="#">' + base.options.forwardText + '</a></span>'),
				$back = $('<span class="arrow back"><a href="#">' + base.options.backText + '</a></span>');

			// Bind to the forward and back buttons
			$back.click(function(e) {
				base.goBack();
				e.preventDefault();
			});
			$forward.click(function(e) {
				base.goForward();
				e.preventDefault();
			});
			// using tab to get to arrow links will show they have focus (outline is disabled in css)
			$back.add($forward).find('a').bind('focusin focusout',function(){
			 $(this).toggleClass('hover');
			});

			// Append elements to page
			base.$el.after($forward).after($back);
		};
		
		// Creates the Start/Stop button
		base.buildAutoPlay = function(){
			base.$startStop = $("<a href='#' class='start-stop'></a>").html(base.playing ? base.options.stopText :  base.options.startText);
			base.$el.after(base.$startStop);
			base.$startStop
				.click(function(e) {
					base.startStop(!base.playing);
					if (base.playing) {
						base.goForward(true);
					}
					e.preventDefault();
				})
				// show button has focus while tabbing
				.bind('focusin focusout',function(){
					$(this).toggleClass('hover');
				});

			// Use the same setting, but trigger the start;
			base.startStop(base.playing);
		};

		

		
		base.gotoPage = function(page, autoplay) {
			
			if (typeof(page) === "undefined" || page === null) {
				page = 1;
				base.setCurrentPage(1);
			}

			// Just check for bounds
			if (page > base.items + 1) { page = base.items; }
			if (page < 0 ) { page = 1; }
			
			if(page==base.items) page=0;
			
			// When autoplay isn't passed, we stop the timer
			if (autoplay !== true) { autoplay = false; }
			// Stop the slider when we reach the last page, if the option stopAtEnd is set to true
			if (!autoplay) { base.startStop(false); }

			// Animate Slider
			/*base.$window.filter(':not(:animated)').animate(
				{ scrollLeft : base.$dimensions[page][2] },
				{ queue: false, duration: base.options.animationTime, easing: base.options.easing, complete: function(){ base.endAnimation(page); } }
			);*/
			
			if(base.$el.children('li:animated').length>0){ return;};
			
			var $active = base.$el.children('li.active');
			var $next = base.$el.children('li').eq(page);
		//	if($active.prevAll().length==page) return;
			
			if($.browser.msie && $.browser.version<9.0)
			{
				base.$el.find('> li:not(".active")').fadeOut();
				
				$active.fadeIn(1)
				.addClass('last-active')
				.fadeOut(base.options.animationTime, function(){
					$active.removeClass('active last-active');
					base.endAnimation(page);
					});
					
				$next.fadeOut(1)
				.addClass('active')
				.fadeIn(base.options.animationTime, function() {
					/*$active.removeClass('active last-active');
					base.endAnimation(page);*/
				});
				
				
				
			}else
			{
				
				base.$el.find('> li:not(".active")').css({opacity:0.0});
				
				$active.css({opacity: 1.0})
				.addClass('last-active')
				.animate({opacity: 0.0}, base.options.animationTime, function() {
					/*$active.removeClass('active last-active');
					base.endAnimation(page);*/
				});	
				
				$next.css({opacity: 0.0})
				.addClass('active')
				.animate({opacity: 1.0}, base.options.animationTime, function() {
					$active.removeClass('active last-active');
					base.endAnimation(page);
				});	
				
				
			}
			
			
			
			

		};
		
		base.endAnimation = function(page){
			base.setCurrentPage(page);
			
			
		};
		
		base.setCurrentPage = function(page) {
			
			// Set Title at h2.
			$('#slideTitle').html(base.$el.children('li.active').attr('title'));
			
			// Set visual
			if (base.options.buildNavigation){
				base.$nav.find('li.nav_link a.cur').removeClass('cur');
				base.$nav.find('li.nav_link a').eq(page).addClass('cur');
			}
			

			// Update local variable
			base.currentPage = page;

			// Set current slider as active so keyboard navigation works properly
			if (!base.$el.is('.activeGallery')){
				$('.activeGallery').removeClass('activeGallery');
				base.$el.addClass('activeGallery');
			}
			
		};
		
		base.goForward = function(autoplay) {
			if (autoplay !== true) { autoplay = false; base.startStop(false); }
			base.gotoPage(base.currentPage + 1, autoplay);
			
		};

		base.goBack = function(autoplay) {
			if (autoplay !== true) { autoplay = false; base.startStop(false); }
			base.gotoPage(base.currentPage - 1, autoplay);
		};
		
		base.clearTimer = function(){
			// Clear the timer only if it is set
			if (base.timer) { window.clearInterval(base.timer); }
		};
		
		// Handles stopping and playing the slideshow
		// Pass startStop(false) to stop and startStop(true) to play
		base.startStop = function(playing) {
			if (playing !== true) { playing = false; } // Default if not supplied is false

			// Update variable
			base.playing = playing;

			// Toggle playing and text
			if (base.options.autoPlay) { base.$startStop.toggleClass("playing", playing).html( playing ? base.options.stopText : base.options.startText ); }

			if (playing){
				base.clearTimer(); // Just in case this was triggered twice in a row
				base.timer = window.setInterval(function() {
					
					base.goForward(true);

				}, base.options.delay);
			} else {
				base.clearTimer();
			}
		};

        // Run initializer
		base.init();
	
       
    };
	
	

    $.simpleFadeSlideshow.defaultOptions = {
		width               : null,      	// Override the default CSS width
		height              : null,      	// Override the default CSS height
		buildArrows			: true,			// If true, builds the forwards and backwards buttons
        buildNavigation		: true, 		// If true, builds a list of anchor links to link to each panel
		forwardText         : "&raquo;", 	// Link text used to move the slider forward (hidden by CSS, replaced with arrow image)
		backText            : "&laquo;", 	// Link text used to move the slider back (hidden by CSS, replace with arrow image)
		delay               : 3000,      	// How long between slideshow transitions in AutoPlay mode (in milliseconds)
		animationTime       : 600,       	// How long the slideshow transition takes (in milliseconds)
		ease				: "swing", 		// Anything other than "linear" or "swing" requires the easing plugin
		navigationFormatter : null,			// Details at the top of the file on this use (advanced use)
		autoPlay            : true,     	// This turns off the entire slideshow FUNCTIONALY, not just if it starts running or not
 		pauseOnHover        : false,      	// If true & the slideshow is active, the slideshow will pause on hover
		startPanel          : 1,         	// This sets the initial panel
		startText           : "Start",   // Start button text
		stopText            : "Stop",    // Stop button text
		
		//functions	
		onInit				: null,			//on Initialize function		
		onComplete			: null			//on Complete function



    };

    $.fn.simpleFadeSlideshow = function(options){
        return this.each(function(){
            (new $.simpleFadeSlideshow(this, options));

                   // HAVE YOUR PLUGIN DO STUFF HERE

                   // END DOING STUFF

        });
    };

})(jQuery);