var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	jQ('table.information td[rowspan]').css('border-right', '1px solid #C0C0C0');


	winWidth = jQ(window).width();
	if(winWidth <= 480){
		//jQ("h2:nth-of-type(2)").before("<span>lino is here...</span>").addClass("infected");
		jQ(".mrec1").insertBefore(".LargeLinks:nth-of-type(3)");
	}


});
