// When the document loads do everything inside here ...
var jQ = jQuery.noConflict();
jQ(document).ready(function(){
		jQ("#tabbed_box_1").mouseleave(function () {
			jQ(".menutab_content").hide();
		});
		// When a link is hovered
		jQ("a.tab").hover(function () {

			// switch all tabs off
			jQ(".active").removeClass("active");

			// switch this tab on
			jQ(this).addClass("active");
			// slide all elements with the class 'menutab_content' up
			jQ(".menutab_content").hide();
				//jQ(".menutab_content").slideUp();

			// Now figure out what the 'title' attribute value is and find the element with that id.  Then slide that down.
			var content_show = jQ(this).attr("title");
			//jQ("#"+content_show).slideDown();
			jQ("#"+content_show).css("left", jQ(this).position().left);
			jQ("#"+content_show).show();
			//alert(jQ(this).offset().left);

		});
		
		// When a link is clicked
		jQ("#regloginDiv div.right a").click(function () {

			// switch all tabs off
			jQ(".active").removeClass("active");

			// switch this tab on
			jQ(this).addClass("active");
			// slide all elements with the class 'menutab_content' up
			jQ(".menutab_content").hide();
				//jQ(".menutab_content").slideUp();

			// Now figure out what the 'title' attribute value is and find the element with that id.  Then slide that down.
			var content_show = jQ(this).attr("title");
			//jQ("#"+content_show).slideDown();
			jQ("#"+content_show).css("left", jQ(this).position().left);
			jQ("#"+content_show).show();
			//alert(jQ(this).offset().left);

		});
		jQ("a.tab").mouseleave(function(){
			
			// switch all tabs off
			jQ("a.active").removeClass("active");

		});
		jQ("div.menutab_content").mouseenter(function(){
			jQ(this).show();
			strID=jQ(this).attr('id');
			
			// highlight back the corresponding tab
			jQ(".tab[title~='"+strID+"']").addClass("active");
		});
		jQ("div.menutab_content").mouseleave(function(){
			jQ(this).css('display', 'none');
			
			// switch all tabs off
			jQ("a.active").removeClass("active");
		});
		
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
