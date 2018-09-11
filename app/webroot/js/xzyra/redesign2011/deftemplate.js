// When the document loads do everything inside here ...
var searchMode = 'Health Info';
var jQ = jQuery.noConflict();
jQ(document).ready(function(){
        
        jQ("#SearchContainerTopMobile a.SearchButton").click(function(){
			goSearchMobile();
        });
        jQ("#SearchContainerTop a.SearchButton").click(function(){
			//alert(jQ('#Search').attr('value'));
			goSearch();
        });

	
        jQ("#HealthInfoDropMobile a.searchdropdown").click(function(){
			//alert(">"+jQ(this).html()+"<");
			searchMode = jQ(this).html();
			jQ('.jq_dropdown_content').hide();

        });
        jQ("#HealthInfoDrop a.searchdropdown").click(function(){
			//alert(">"+jQ(this).html()+"<");
			searchMode = jQ(this).html();
			jQ('.jq_dropdown_content').hide();

        });
		
		jQ("#LoginbuttonContainer img").click(function(){
			jQ("#UserLogin").attr('value', jQ("#usernameTextfield").attr('value'));
			jQ("#UserPwd").attr('value', jQ("#passwordTextfield").attr('value'));
			jQ("#UserLoginForm").submit();
		});
		
		jQ("#Search, #SearchMobile").keypress(function(e){
            code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
				//alert(jQ(this).attr('value'));
				if(searchMode == 'Medicines'){
					window.location.href = "/search/cmi?q=" + jQ(this).attr('value');
				}else{
					window.location.href = "/search/health-information?q=" + jQ(this).attr('value');
				}
			}
        });
});

function goSearchMobile(){
	//?q=paracetamol 
	searchStr = jQ('#SearchMobile').attr('value');
	if(searchStr=='Enter Keyword'){
		searchStr = '';
	}
	if(searchMode == 'Medicines'){
		window.location.href = "/search/cmi?q=" + searchStr;
	}else{
		window.location.href = "/search/health-information?q=" + searchStr;
	}
	//alert(jQ('#searchSel').attr('value'));
}
function goSearch(){
	//?q=paracetamol 
	searchStr = jQ('#Search').attr('value');
	if(searchStr=='Enter Keyword'){
		searchStr = '';
	}
	if(searchMode == 'Medicines'){
		window.location.href = "/search/cmi?q=" + searchStr;
	}else{
		window.location.href = "/search/health-information?q=" + searchStr;
	}
	//alert(jQ('#searchSel').attr('value'));
}

