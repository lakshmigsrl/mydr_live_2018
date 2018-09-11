var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	//doDynLinks();
	jQ("#ArticleFormatType").change(function(){
		if(jQ("#ArticleFormatType").val()==14){
			if(!jQ("#slideWrap").is(":visible")){
				jQ("#slideWrap").slideDown("slow");
			}
		}else{
			if(jQ("#slideWrap").is(":visible")){
				jQ("#slideWrap").slideUp("slow");
			}
		}
	});

	init_SortableList();

        /*Test for visible elements. */
        jQ('h1').click(function(){
                if(jQ('#bodyLinkUrls').is(':visible')){
                        alert('urls are visible');
                }else{
                        alert('urls are NOT visible');
                }
        });
});

function init_SortableList(){
	jQ("#sortable").sortable({
	  placeholder: "ui-state-highlight",
	  opacity: 0.8,
	  update: function(event, ui) { 
		//alert('watda'); 
		},
	  stop: function () {
	    // enable text select on inputs
	    jQ("#sortable").find("input, textarea").bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(e) {
	      e.stopImmediatePropagation();
	    });
	  }
	}).disableSelection();

	// enable text select on inputs
	jQ("#sortable").find("input, textarea").bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(e) {
	  e.stopImmediatePropagation();
	});
}

function assembleBodyLinks(recordDelimiter, fieldDelimiter){
	
	ctr = 0;
	retString="";
	nextlink = jQ('#linktitle_'+ctr).attr('value');

	if(jQ('#bodyLinkUrls').is(':hidden')){
	
		$retString = jQ('#homepageDynBodyLinks').attr('value');
		return retString;
	}

	while(1){
		nextlink = jQ('#linktitle_'+(ctr+1)).attr('value');
		if(nextlink!=null){
			if(jQ('#linktitle_'+ctr).parent().is(':visible')==true){
				retString = retString + jQ('#linktitle_'+ctr).attr('value') + fieldDelimiter + jQ('#linkurl_'+ctr).attr('value') + recordDelimiter;
			}
			ctr = ctr + 1;
		}else{
			retString = retString + jQ('#linktitle_'+ctr).attr('value') + fieldDelimiter + jQ('#linkurl_'+ctr).attr('value') + "";
			jQ('#homepageDynBodyLinks').attr('value', retString);
			return retString;
		}
	}
	
}

function insertNewBodyLink(){
	
	strID = jQ('#bodyLinkUrls div:last-child').attr('id');
	arrID = strID.split("_");
	lastInt = parseInt(arrID[1]);
	nextInt = lastInt+1;
	
	//alert(lastInt);
	
	jQ("#bodyLinkUrls").append("<div id='wrapTitleUrl_"+nextInt+"'>"
				   +"<input id='linktitle_"+nextInt+"' type='text' value='' style='width: 300px;' />"
				   +"&nbsp&nbsp&nbsp"
				   +"<input id='linkurl_"+nextInt+"' type='text' value='' style='width: 600px;' />"
				   +"<span onclick='jQ(this).parent().hide(\"slow\");' style='margin-left: 3px; cursor: pointer; background-color: #6D9CC8;'>(-)</span>"
				   +"</div>");
}

function insertNewSlideItem(articleID){
	
	strID = jQ('#allSlide li:last-child').attr('id');
	if(strID == null){
		nextInt = 0;
	}else{
		arrID = strID.split("_");
		lastInt = parseInt(arrID[2]);
		nextInt = lastInt+1;
	}
	mceNxtInt = nextInt+500;
	
	jQ("#sortable").append(
				"<li class='ui-state-default' id='sortable_li_"+nextInt+"'>"
				   +"<div id='slideItem_"+nextInt+"' class='required slideSubWrap' style='position: relative; float: left; width: 800px; clear: both;'>"
					+"<table style='width: 100%; padding: 0; cell-padding: 0; border: 0;'><tr><td style='width: 400px; border: 0;'>"
						+"title:<br /><input type='text' name='data[Slide]["+nextInt+"][title]' /><br />"
						+"image:<br /><input type='text' name='data[Slide]["+nextInt+"][imgsrc]' id='Slide"+nextInt+"imgsrc' class='imagepicker' />"
						+"<a class='imagepicker' href='javascript:mcImageManager.open(\"Article\",\"Slide"+nextInt+"imgsrc\");'>"
						+"<img src=\"/img/../js/tiny_mce/themes/advanced/images/image.gif\" class=\"imagepicker\" alt=''>"
						+"</a>"
						+"<br />img alt text:<br /><input type='text' name='data[Slide]["+nextInt+"][img_alttext]' /><br />"
						+"<input type='hidden' name='data[Slide]["+nextInt+"][id]'         value='0' />"
						+"<input type='hidden' name='data[Slide]["+nextInt+"][article_id]' value='"+articleID+"' class='SlideItemArtId' id='SlideItemArtId_"+nextInt+"' />"
						+"<input type='hidden' name='data[Slide]["+nextInt+"][orderdisp]'  value='"+nextInt+"' class='SlideItemOrderdisp' />"
					+"</td><td style='width: 320px; bordedr: 0;'>"
						+"body:<br /><textarea class='body' style='height: 150px; width: 300px;' name='data[Slide]["+nextInt+"][body]'></textarea>"
					+"</td><td style='width: 150px; bordedr: 0;'>"
						+"<a href='#' onClick='jQ(\"#SlideItemArtId_"+nextInt+"\").attr(\"value\", \"0\"); jQ(\"#sortable_li_"+nextInt+"\").slideUp(\"slow\"); return false;'>"
						+"(-)Remove"
						+"</a>"
					+"</td></tr></table>"
				   +"</div>"
				+"</li>");

	
}

function updateRelatedProfSearch(){
	var strAll="";
	ctr=0;
	
	jQ("#ProfSearch :input").each(function(){
		if( jQ(this).is(':checked') ){
			strAll = strAll + ctr + ',';
		}
		ctr++;
	});
	
	/*  strip off the last comma. */
	//strAll = strAll.substring(0, strAll.length-1);  //Remove to solve javascript bug on toString().
	//alert(strAll);
	jQ('#relatedSearchVal').attr('value', strAll);
}

function collectSlideshowData(){
	var orderCtr = 0;
	jQ('#sortable li').each(function(index){
		if(jQ(this).find('.SlideItemArtId').attr('value') != "0"){
			jQ(this).find('.SlideItemOrderdisp').attr('value',  orderCtr);
			orderCtr++;
		}
		//alert(jQ(this).find('.title').attr('value') + ", " + jQ(this).find('.SlideItemOrderdisp').attr('value') + ", " + jQ(this).find('.SlideItemArtId').attr('value'));
	});
}
