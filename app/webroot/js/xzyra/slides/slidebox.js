(function(jQ) {
  var cache = [];
  // Arguments are image paths relative to the current page.
     jQ.preLoadImages = function() {
         var args_len = arguments.length;
             for (var i = args_len; i--;) {
                   var cacheImage = document.createElement('img');
                         cacheImage.src = arguments[i];
                               cache.push(cacheImage);
		}
	}
	
	jQ(window).hashchange( function(){
		var hash = location.hash;
		//document.title = 'The hash is ' + ( hash.replace( /^#/, '' ) || 'blank' ) + '.';
		
		toggle_mydr_analytics();
	});
	
	// Since the event is only triggered when the hash changes, we need to trigger
	// the event now, to handle the hash the page may have loaded with.
	jQ(window).hashchange();
	
})(jQuery)




function doSlide(startPage){
    jQ("#dynAd").show();
    jQ(".slideshow").before('<div id="nav" class="nav">').cycle({
		/* fx: 'uncover', */
		fx: 'fade',
		speed: 0,
		timeout: 3500,
		//next: '.slideshow',
		//pager: '#nav',
		pause: 1,
		next: '.next_slideButton', 		/* Disabled for separate page per slide */
		prev: '.prev_slideButton',		/* Disabled for separate page per slide */
		pagerAnchorBuilder: function(idx, slide) {
				return "<a href='#'>"+(idx+1)+"</a>";
		 },
		before: function(curr, nxt, opts) { 
					if (window.console) console.log(this.src); 
				},
		after: updateDashboard,
		startingSlide: (startPage-1)		/* zero based index. This is for separate page per slide. */
	});

	jQ("div#leftSlideTransHolder").click(function(){
		//jQ('.slideshow').cycle('prev');
	});
	jQ("div#rightSlideTransHolder").click(function(){
		//jQ('.slideshow').cycle('next');
	});

	jQ("div#leftSlideTransHolder").mouseover(function(e){
		jQ('#leftSlideImgHolder img').show();
		jQ('#rightSlideImgHolder img').show();

		jQ('div#leftSlideImgHolder img').attr("src", "/img/slides/hoverleftdark.png");
		jQ('div#rightSlideImgHolder img').attr("src", "/img/slides/hoverright.png");
	});
	jQ("div#rightSlideTransHolder").mouseover(function(e){
		jQ('#leftSlideImgHolder img').show();
		jQ('#rightSlideImgHolder img').show();

		jQ('div#rightSlideImgHolder img').attr("src", "/img/slides/hoverrightdark.png");
		jQ('div#leftSlideImgHolder img').attr("src", "/img/slides/hoverleft.png");
	});
	jQ("div#leftSlideTransHolder").mouseout(function(e){
		jQ('#leftSlideImgHolder img').hide();
		jQ('#rightSlideImgHolder img').hide();
	});
	jQ("div#rightSlideTransHolder").mouseout(function(e){
		jQ('#leftSlideImgHolder img').hide();
		jQ('#rightSlideImgHolder img').hide();
	});

	jQ('#leftSlideImgHolder img').hide();
	jQ('#rightSlideImgHolder img').hide();
	jQ('.slideshow').cycle('pause');
	jQ.preLoadImages('/img/slides/hoverleftdark.png', '/img/slides/hoverrightdark.png');
	jQ('#cycleBox').show();
	//jQ(".slides").css("position","relative");
	jQ(".slideshow").css("width","100%"); /* force attribute value as this will be assigned on the element level at runtime. */
}

function updateDashboard(curr, next, opts){

	if(opts.currSlide == opts.slideCount-1){
		jQ('div.slidenavi').hide();
		jQ('#NavDashboard').html((opts.slideCount-1) + " of " + (opts.slideCount-1));
	}else{
		jQ('div.slidenavi').show();
		jQ('#NavDashboard').html((opts.currSlide+1) + " of " + (opts.slideCount-1));
	}
	location.hash = '#'+String(opts.currSlide+1);
	
	
}
