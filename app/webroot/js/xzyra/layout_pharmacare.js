var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	doSlide();
});

function doSlide(){
    jQ("#dynAd").show();
    jQ(".slideshow").after('<div id="nav">').cycle({
		/* fx: 'uncover', */
		fx: 'fade',
		speed: 400,
		timeout: 3000,
		//next: '.slideshow',
		pause: 1,
		pager: '#nav',
		pagerAnchorBuilder: function(idx, slide) { 
			//return '<a href="#" class="slide" style="margin-left: 5px; left:'+(idx*100)+'px;"><p style="top-margin: 4px; line-height: 12px; ">' + jQ(slide).children('a').attr("title") + '</p></a>';
			return '<a href="#" class="slide"><p style="top-margin: 4px; line-height: 12px; ">' + jQ(slide).children('a').attr("title") + '</p></a>';
		},
		before: function(currSlideElement, nextSlideElement, options, forwardFlag) {
			//index = jQ(nextSlideElement).attr('name');
			//jQ("#deltapoint").css('left', ((index*100))+'px');
		}
		
	});
    
}
