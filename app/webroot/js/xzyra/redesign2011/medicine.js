// When the document loads do everything inside here ...
var jQ = jQuery.noConflict();

jQ(document).ready(function(){
        
        jQ("#SearchFromContainer a.GoButtonContainer").click(function(){
			goSearch();
        });
        
        jQ("#SearchFromContainer input.SearchMediTxtinput").keypress(function(e){
            code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
				goSearch();
			}
        });
        
        jQ("#SearchMediHeader a").click(function (event){
 
                    window.open(jQ(this).attr('href'),"Window1",
                        "menubar=no,width=430,height=360,scrollbars=yes,toolbar=no,location=no,status=no");
                    return false;
 
        });


	jQ("#searchMediByName").autocomplete({
			source: "/search/ajax/searchCMIMedicine",
			minLength: 3,
                        appendTo: "#medicinesTextContainer",
			select: function(event, ui){
					if(!ui.item.id){
						alert('nah');
					}else{
						jQ("#Box3 a.GoButtonContainer").attr('href',ui.item.id);
					}
				}
	});
	jQ("#searchMediByName").keyup(function(event){
		if(event.keyCode == 13){
			goSearchMedicineName(jQ("input#searchMediByName").val());
		}
	});
	jQ("#searchMediByCond").keyup(function(event){
		if(event.keyCode == 13){
			goSearchMedicineCond(jQ("input#searchMediByCond").val());
		}
	});
});

function goSearch(){
	searchStr=jQ('#SearchBoxContainer input').attr('value');
	if(jQ('#jumpMenu').attr('value')=='medicine'){
		window.location.href = "/search/cmi?q=" + searchStr;
	}else{
		window.location.href = "/search/cmi?Condition=" + searchStr;
	}
}

function goSearchMedicineName(searchStr){
		window.location.href = "/search/cmi?q=" + searchStr;
}
function goSearchMedicineCond(searchStr){
		window.location.href = "/search/cmi?Condition=" + searchStr;
}
