var jQ = jQuery.noConflict();
var notYet=0;
jQ(document).ready(function(){
	var ctr_intAdvHead=0;
	var intAdvHead = setInterval(
		function(){
			//alert("Interval reached");
			jQ('.advLabel').children('div').children('iframe').parent().parent().children('.advertisetmentHeader').show();
			jQ('.advLabel').children('ins').children('ins').children('ins').parent().parent().parent().children('.advertisetmentHeader').show();
			jQ('.advLabel').children('ins').children('ins').children('iframe').parent().parent().parent().children('.advertisetmentHeader').show();
			if(jQ('#BannerAd > div').css('display')=='none'){
				jQ('#BannerAd > .advertisetmentHeader').hide();
			}

			ctr_intAdvHead++;
			if(ctr_intAdvHead>10){
				clearInterval(intAdvHead);
			}
		},
		500
	);
	var ctr_intSkinBg=0;
	var intSkinBg = setInterval(
		function(){
			var skinLink = jQ( "#dfpDynSkin > div > div > iframe").contents().find("img").attr('src');
			if(skinLink==null){
				//alert('not yet');
			}else{
				//alert(skinLink);
				clearInterval(intSkinBg);	
				gLink = jQ( "#dfpDynSkin > div > div > iframe").contents().find("a").attr('href');
                		jQ('#Background').attr('style', 'background: #FFFFFF url("' + skinLink + '") top center no-repeat;');
				jQ('#BannerAd').show();
				jQ('#BannerAd').attr('style', 'height: 110px;');
				setClickableBg(gLink, "");	
			}
	
			ctr_intSkinBg++;
			if(ctr_intSkinBg>12){
				clearInterval(intSkinBg);
			}
		},
		200
	);

	/* Testing on live */
	jQ('#FooterLogoContainer').click(function(){
		//alert(jQ('#dfpDynSkin > a:first + a img').attr('src'));
		//alert(jQ('#dfpDynSkin > a:first img').attr('src'));
		//alert(jQ('#BannerAd > script').size());
		//alert(jQ('#dfpDynSkin > div > div > iframe').attr('id'));
		//alert(jQ('#dfpDynSkin > div > div > iframe').contents().find("img").attr("src"));
		//alert(jQ('#BannerAd > div').css('display'));
		//return false;
	});

	/* Toggle show/hide "ADVERTISEMENT" label */
	//jQ('.advertisetmentHeader').siblings('object').parent().children('.advertisetmentHeader').show();
	//jQ('.advertisetmentHeader').siblings('div').parent().children('.advertisetmentHeader').show();
	//jQ('.advertisetmentHeader').after('<br />');
	//jQ('.advLabel').children('iframe').parent().children('.advertisetmentHeader').show();
	//jQ('.advLabel').children('object').parent().children('.advertisetmentHeader').show();
	//jQ('.advLabel').children('div').parent().children('.advertisetmentHeader').show();
	//jQ('.advLabel').children('a').parent().children('.advertisetmentHeader').show();
	//jQ('.advLabel').children('embed').parent().children('.advertisetmentHeader').show();

	/*
	var skinLink = 0;
    	if(jQ('#dfpDynSkin > a:first + a img').length != 0){
		skinLink = jQ('#dfpDynSkin > a:first + a');

        	mystr = skinLink.children('img').attr('src');
		if(mystr.search("_x_")<0){
			skinLink = 0;
		}
	}else if(jQ('#dfpDynSkin > a:first img').length != 0){
		skinLink = jQ('#dfpDynSkin > a:first');

        	mystr = skinLink.children('img').attr('src');
	}

	if( jQ('#BannerAd > script').size()>2 ){
		jQ('#BannerAd').show();
	}
	var notYet=0;
    	if(skinLink != 0){
		jQ('#BannerAd').show();

                var mystr = skinLink.children('img').attr('src');
		if(mystr.search("_x_")>0){
                	var arrStr = mystr.split("_x_");		//Get color from image filename...
			var titleStr = arrStr[2];
			var toolStr = titleStr.replace(/_/g," ");
                	jQ('#Background').attr('style', 'background: #'+arrStr[1]+' url("' + skinLink.children('img').attr('src') + '") top center no-repeat;');
		}else{
                	jQ('#Background').attr('style', 'background: #FFFFFF url("' + skinLink.children('img').attr('src') + '") top center no-repeat;');
		}

		if(toolStr){
			if(toolStr.length < 6){
				toolStr = "";
			}
		}
		toolStr = "";
		setClickableBg(skinLink.attr('href'), "");	

	}
	*/
});


function setClickableBg(gHref, toolStr){
    		jQ('#MainWrapper').attr('title', toolStr);
		jQ('#MainWrapper').tooltip({
			track: true, delay: 0, showURL: false, showBody: " - ", fade: 250
		});
		jQ.tooltip.blocked=true;

		jQ('#MainContainer, #FooterWrapper').mouseenter(function() {
	    			jQ('#MainWrapper').removeClass('active');
	                	jQ("body").css('cursor','default');
				jQ.tooltip.blocked=true;
			}).mouseleave(function() {
    				jQ('#MainWrapper').addClass('active');
	        	        jQ("body").css('cursor','pointer');
				jQ.tooltip.blocked=false;
		});

		jQ('#activity').select(function() {
			notYet = 1;
		});
		jQ('.dropdowns').click(function() {
			notYet = 0;
			return false;
		});

		jQ('body').delegate("#MainWrapper.active", "click", function() {
		    if(notYet==0){
			//clickT = skinLink.attr('href');
			window.location.href=gHref;	
		    }
		});
		//jQ('body').delegate("#MainWrapper.active", "mousemove", function(e) {
		//	jQ('#SearchInputBox #Search').attr('value', e.pageX);
		//});

}

