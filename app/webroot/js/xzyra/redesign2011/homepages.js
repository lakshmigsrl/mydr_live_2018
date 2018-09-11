// When the document loads do everything inside here ...
var jQ = jQuery.noConflict();
var marQuee;

jQ(document).ready(function(){
/*
	jQ('div#marqueeID').attr('scrollamount', 1);
	
        marQuee = jQ('div#marqueeID').marquee('pointer');
        jQ('div#marqueeID').marquee('pointer').mouseover(function () {
            jQ(this).trigger('stop');
        }).mouseout(function () {
            jQ(this).trigger('start');
        }).mousemove(function (event) {
            if (jQ(this).data('drag') == true) {
                this.scrollLeft = jQ(this).data('scrollX') + (jQ(this).data('x') - event.clientX);
            }
        }).mousedown(function (event) {
            jQ(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
        }).mouseup(function () {
            jQ(this).data('drag', false);
        });
        
        jQ('a#playpauseMarquee').click(function(){
            curr_class = jQ(this).attr('class');
            if(curr_class=="play contentPrimaryLink"){
                jQ(marQuee).trigger('start');
                jQ(this).children('img').attr('src', '/images/pause-18x18a.png');
                jQ(this).attr('class','pause contentPrimaryLink');
            }else{
                jQ(marQuee).trigger('stop');
                jQ(this).children('img').attr('src', '/images/play-18x18a.png');
                jQ(this).attr('class','play contentPrimaryLink');
            }
        });
*/
		jQ("#symptomsText").autocomplete({
						source: "/homepages/ajax/searchSymptoms",
						minLength: 1,
                        appendTo: "#symptomsTextContainer",
						select: function(event, ui){
									//var str = jQ("#symptomsText")..val();     
									//var strarr = str.split("  ");
									jQ("#Box2 a.GoButtonContainer").attr('href',ui.item.id);
									//jQ("#state").val(ui.item.state);
								}
		});
        
		jQ("#medicinesText").autocomplete({
						source: "/homepages/ajax/searchMedicines",
						minLength: 3,
                        appendTo: "#medicinesTextContainer",
						select: function(event, ui){
                                        if(!ui.item.id)
                                        {
                                                //jQ("#Box3 a.GoButtonContainer").attr('href',jQ("#medicinesText").value());
                                                alert('nah');
                                        }else{
                                                jQ("#Box3 a.GoButtonContainer").attr('href',ui.item.id);
                                        }
								}
		});
        
        jQ("#Box3 a.GoButtonContainer").click(function(){
                        //alert(jQ(this).attr('href'));
                        if(jQ(this).attr('href')=='#'){
                                window.location.href = "/search/cmi?q=" + jQ("#medicinesText").attr('value');
                        }
        });

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
/*
function goSearch(){
	//?q=paracetamol
	searchStr=jQ('#searchStringBox').attr('value');
	if(jQ('#searchSel').attr('value')=='Medicines'){
		window.location.href = "/search/cmi?q=" + searchStr;
	}else{
		window.location.href = "/search/health_information?q=" + searchStr;
	}
	//alert(jQ('#searchSel').attr('value'));
}
*/
