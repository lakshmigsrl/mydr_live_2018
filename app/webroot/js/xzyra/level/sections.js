var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	jQ('table.information td[rowspan]').css('border-right', '1px solid #C0C0C0');


	winWidth = jQ(window).width();
	if(winWidth <= 480){
		//jQ("h2:nth-of-type(2)").before("<span>lino is here...</span>").addClass("infected");
		jQ(".mrec1").insertAfter(".SlideWrapper");
	}

	/* Slide Images Gallery */
	jQ('ul#slideGallery').simpleFadeSlideshow({
		forwardText: '<img src="/images/netstarter/ContentImages/right-arrow.png" width="8" height="13" alt="" />',
		backText: '<img src="/images/netstarter/ContentImages/left-arrow.png" width="8" height="13" alt="" />',
		delay               : 4000,
		animationTime       : 1000, 
		onComplete: function(){
			jQ('.sfs_nav ul').prepend(jQ('<li />').append(jQ('.sfs_wrapper span.back')));
			jQ('.sfs_nav ul').append(jQ('<li />').append(jQ('.sfs_wrapper span.forward')));
		}
		});
	
	jQ('ul#healthSlideGallery').simpleFadeSlideshow({
		forwardText: '<img src="/images/netstarter/ContentImages/right-arrow.png" width="8" height="13" alt="" />',
		backText: '<img src="/images/netstarter/ContentImages/left-arrow.png" width="8" height="13" alt="" />',
		delay               : 4000,
		animationTime       : 1000, 
		onComplete: function(){
			jQ('.sfs_nav ul').prepend(jQ('<li />').append(jQ('.sfs_wrapper span.back')));
			jQ('.sfs_nav ul').append(jQ('<li />').append(jQ('.sfs_wrapper span.forward')));
		}
		});
	jQ('ul#healthSlideGallery div.content_holder').show();
	/* END Slide Images Gallery */

});
