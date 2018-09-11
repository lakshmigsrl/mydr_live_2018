var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	jQ('table.information td[rowspan]').css('border-right', '1px solid #C0C0C0');

});

jQ(function(){

/* START Routine for Responsive navigation... */
	var	pull 		= jQ('#pull');
		//menu 		= jQ('nav ul');
		//menuHeight	= menu.height();

	/* Check if window is less than 480px wide or if page is probably opened in mobiles. */
	//if(jQ(window).width() > 480 && menu.is(':hidden')) {
	if(jQ(window).width() > 480) {
		//jQ("ul#topnav li").hoverIntent(config);
	}

	jQ(pull).on('click', function(e) {
		e.preventDefault();
		//menu.slideToggle();
	});
	jQ(window).resize(function(){
		var w = jQ(window).width();
		if(w > 480 && menu.is(':hidden')) {
			//menu.removeAttr('style');
			//jQ("ul#topnav li").hoverIntent(config);
		}
		//if(w < 480 && menu.is(':hidden')) {
		if(w < 480) {
			//alert('smaller now');
			//jQ("div#topnav").removeClass("megaMenu");
			//jQ("ul#topnav li").unbind("mouseenter").unbind("mouseleave");
			//jQ("ul#topnav li").removeProp("hoverIntent_t");
			//jQ("ul#topnav li").removeProp("hoverIntent_s");
			
			jQ("ul#slideGallery").attr("style", "height: 380px;");

		}
	});	
/* END Routine for Responsive navigation... */


		
	jQ('.jq_dropdown_link').click(function(e){
		e.preventDefault();
		if(jQ(this).hasClass('selected'))
		{
			jQ(this).removeClass('selected');
		}else
		{
			jQ(this).addClass('selected');
		}
		jQ('.jq_dropdown_content').slideUp();
		
		jQ(jQ(this).attr('href')).slideToggle();
		});

		
		
	jQ('body').click(function(e){
		if(jQ(e.target).hasClass('jq_dropdown_link') || jQ(e.target).parents('.jq_dropdown_content').length>0) return;
		jQ('.jq_dropdown_content').slideUp(function(){
			jQ('.jq_dropdown_link').removeClass('selected');
			
			});
		
		
		});
		
		
	//font resizer
	
	jQ('.textDecrease').click(function(){
		
			
			jQ('#MainBodyLeftPane *').each(function(){
				var size = parseFloat(jQ(this).css('font-size'),10);
				jQ(this).css('font-size',(size-2)+'px');
				
				});

		
		
		});
	jQ('.textIncrease').click(function(){
		
			
			jQ('#MainBodyLeftPane *').each(function(){
				var size = parseFloat(jQ(this).css('font-size'),10);
				jQ(this).css('font-size',(size+2)+'px');
				
				});
			

		
		
		});
	
	jQ('.HeaderReference').click(function(e){
		e.preventDefault();
		(jQ(this).hasClass('down')) ? jQ(this).removeClass('down') : jQ(this).addClass('down')
		jQ(jQ(this).attr('href')).slideToggle();
		
		
		});
	
	//for Tabs
	jQ('.tabLink').click(function(e){
		jQ('.tabLink').removeClass('selected');
		jQ(this).addClass('selected');
		e.preventDefault();
		jQ('.tabContent').removeClass('selected');
		jQ(jQ(this).attr('href')).addClass('selected');
		
		});
		
	//tab expand
	jQ('.tabExpand').toggle(function(e){
		var _item = jQ(this);
		e.preventDefault();
		
		var h = 0;
		
		jQ(jQ(this).attr('href')).find('ul').each(function(){
		 h = (h<jQ(this).height()) ? jQ(this).height() : h;	
			});
		jQ(jQ(this).attr('href')).find('.tabWrapper').animate({
			height : h
		
		},function(){
			_item.addClass('collapse').text('Collapse listing');	
		});
		
		},function(e){
			var _item = jQ(this);
			e.preventDefault();
			
			var h = 320;
			
			jQ(jQ(this).attr('href')).find('.tabWrapper').animate({
				height : h
		
			},function(){
			_item.removeClass('collapse').text('Expand listing');	
			});	
			
		
		});
		
		jQ('.searchdropdown').click(function(e){
			
			jQ('.btnHelthInfo').text(jQ(this).text());
			
			});
	
	
	})
	
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

var urlAddress = "http://www.mydr.com.au"; 
var pageName = "myDr.com.au - Health and Medical Information for Australia from MIMS" ; 
function addToFavorites() { 
	if (window.sidebar) { // Mozilla Firefox
    		window.sidebar.addPanel(pageName, urlAddress, "");
	}
	else if (window.external) { // IE
    		window.external.AddFavorite(urlAddress, pageName);
	}
	else if (window.opera && window.print) {
    		window.external.AddFavorite(urlAddress, pageName);
	}
	else {
    		alert('not supported');
	}
}
