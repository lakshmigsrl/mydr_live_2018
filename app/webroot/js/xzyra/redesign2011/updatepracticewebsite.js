var jQ = jQuery.noConflict();

jQ(document).ready(function(){
        
		jQ("#suburbText").autocomplete({
						source: "/homepages/ajaxpractice",
						minLength: 1,
						appendTo: "#suburbTextContainer",
						select: function(event, ui){
									//alert(ui.item.id);
									jQ('#postcodeText').attr('value', ui.item.postcode);
									jQ('#stateText').attr('value', ui.item.state);
								}
		});
        
        
});

function validateForm(usesCheckbox){
	adminLastname = jQ('#PracticeUserLastname').val();
	adminFirstname = jQ('#PracticeUserFirstname').val();
	adminEmail = jQ('#PracticeUserEmail').val();
	//alert(jQ('#check').attr('checked'));
	//alert(adminLastname+":"+adminFirstname+":"+adminEmail);

	if(adminFirstname=="" || adminFirstname==null){
		return false;
	}
	if(adminLastname=="" || adminLastname==null){
		return false;
	}
	if(adminEmail=="" || adminEmail==null){
		return false;
	}
	if(usesCheckbox==1){
		if(jQ('#check').attr('checked')!="checked"){
			//alert("You must give permisssion to myDr by ticking on the checkbox.");
			return false;
		}
	}

	return true;
}

if (jQ.browser.msie && parseInt(jQ.browser.version) < 9) {
  var inputs = jQ('.custom-checkbox input');
  inputs.live('change', function(){
    var ref = jQ(this),
        wrapper = ref.parent();
    if(ref.is(':checked')) wrapper.addClass('checked');
    else wrapper.removeClass('checked');
  });
  inputs.trigger('change');
}


function isChecked_checkbox(){
	if(jQ('#check').attr('checked')!="checked"){
		alert("You must agree to the Terms and Conditions by ticking on the checkbox before it.");
		return false;
	}
	return true;
}
function validateRequiredFields(arrIDs){
		//arrIDs = ['ElementID1', 'ElementID2', 'ElementID3', ... 'ElementIDN'];
		x=0;
		while(arrIDs[x]){
			jElement = jQ('#'+arrIDs[x]);
			if(jElement.val()==null || jElement.val()==""){
                if(jElement.attr('title')!=null){
                    alert(jElement.attr('title')+' must be filled.');
                }else{
                    alert("Required fields(*) must be filled.");
                }
				return false;
			}
			x++;
		}
		return true;
}


