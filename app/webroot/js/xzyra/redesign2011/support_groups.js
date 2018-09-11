var jQ = jQuery.noConflict();

jQ(document).ready(function(){
	jQ.widget( "custom.catcomplete", jQ.ui.autocomplete, {
		_renderMenu: function( ul, items ) {
			var that = this,
			currentCategory = "";
			jQ.each( items, function( index, item ) {
				if ( item.category != currentCategory ) {
					ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
					currentCategory = item.category;
				}
				that._renderItemData( ul, item );
			});
		},
		_renderItem: function( ul, item) {
			var strLabel = item.label;
			var regex = new RegExp(this.term, "gi");
			var arrMatch = strLabel.match(regex);
			//var strLabelFormatted = strLabel.replace(regex, "<span style='font-weight: bold; color:#157ddb;'>"+this.term+"</span>");
			var strLabelFormatted = strLabel.replace(regex, function(s, m1){
										return "<span style='font-weight:bold;color:#157ddb'>"+s+"</span>";
									});

		    return jQ( "<li></li>" )
		       .data( "item.autocomplete", item )
			        .append( "<a style='margin-left: 10px;'>" + strLabelFormatted + "</a>" )
				        .appendTo( ul );
		}
	});

	//jQ("#searchSupportGroups").autocomplete({
	jQ("#searchSupportGroups").catcomplete({
		//source: "/search/ajax/searchSupportGroups",
		source: function(request, response){
			jQ.ajax({
				url: "/search/ajax/searchSupportGroups",
				dataType: "json",
				data:{
					term: request.term,
					state: jQ('#filterState option:selected').attr('value')
				},
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 1,
		appendTo: "#searchSupportGroupsContainer",
		select: function(event, ui){
			jQ("#searchSupportGroups").attr('value',ui.item.value);
			window.location.href = ui.item.urlpath;
		}
	});
	//jQ("#searchSupportGroups").click(function(){
	//	valS = jQ('#filterState option:selected').attr('value');
	//	alert("hello: "+valS);
	//});
});
