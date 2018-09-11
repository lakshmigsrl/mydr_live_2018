


function pre_calculate_smoking_cost(){
	document.Cigarretes.Number_Of_Cigarettes.optional=false;
	document.Cigarretes.Number_Of_Cigarettes.min=1;
	document.Cigarretes.Number_Of_Cigarettes.max=100;
	document.Cigarretes.Number_Of_Cigarettes.numeric=true;
	document.Cigarretes.Number_Of_Cigarettes.username='Number of cigarettes';
	document.Cigarretes.Cost_Of_A_Pack.optional=false;
	document.Cigarretes.Cost_Of_A_Pack.min=1;
	document.Cigarretes.Cost_Of_A_Pack.max=100;
	document.Cigarretes.Cost_Of_A_Pack.numeric=true;
	document.Cigarretes.Cost_Of_A_Pack.username='Cost of a pack';
	document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.optional=false;
	document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.min=5;
	document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.max=100;
	document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.numeric=true;
	document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.username='Number of cigarettes in a pack';
	document.smokingCostResult.year_result.optional=true;
	document.smokingCostResult.month_result.optional=true;
	calculate_Smoking_Costs(document.Cigarretes);
}

// Begin Form Validation Functions
function isBlankElement(s)
{
	// This function read each of the fields that are in the form and returns true if the
	// form element contatins only whitespace characters.
	for (i=0; i < s.length; i++)
	{
		var c = s.charAt(i);
		if ((c != ' ' ) && (c != '\n') && (c !='\t')) return false;
	}
	 return true;
}
	
function isNumeric(s)
{
	for (i=0; i < s.length; i++)
	{
		var c = s.charAt(i);	
		if (  (  !( (c >= '0' ) && (c <= '9') ) )   &&   ((c !='.') && (c !=',')) 	)
		{
		 	return false;
		}
	}
	return true;
}	
		// This if the function that perfroms from validation. It will be invoked from the
		// from onSubmit event handler. The handler should return whatever value this function returns
		//
function verifyToolkitForm(f)
{
	var OverallWarning = "Sorry this page could not be processed.\n\n";
	var AlphaWarning = "";
	var MissingWarning = "";
	var EmptyMessage = "";
	var WarningMessage = "";
	var WarnAtAll = false;
				
		// Loop throught the elements of the form, looking for all text and textarea elements that
		// don't have an "optional" properety defined
		// Then check for fields taht are empty and make a list of them
		// Also, if any of these elements have a min or max poreperty defined then veriy that they are
		// and that they are in the right range
		// put toghter error esaged based on the problems found
		f = ['Number_Of_Cigarettes', 'Number_Of_Cigarettes_In_A_Pack', 'Cost_Of_A_Pack'];
		for( var i=0; i<f.length; i++)
		{
			var e = eval('document.Cigarretes.' + f[i]);

			
			if ((e.type == "text") || (e.type == "textarea"))
			{
				// fisrt check to see if the field is empty
				if (((e.value == null) || (e.value == "" ) || isBlankElement(e.value)) && !e.optional)
				{
					MissingWarning += e.username + " is a mandatory field, please complete the field to proceed.\n";
					EmptyMessage = "This may be because you haven't filled in all the required boxes: please check again.\n\n"
					WarnAtAll = true;					
					continue;
				}
				
				// now check for field that are supposed to be numeric
				if ((e.numeric != null) && (e.numeric))
				{
					//alert(e.value);
					if (isNumeric(e.value))
					{
						var v = parseFloat(e.value);
						if ((( e.min != null) && (v < e.min)) ||
							(( e.max != null) && (v > e.max)))
						{
							MissingWarning += "For " + e.username + " ensure you enter a number between " + e.min + " and " +e.max +".\n";
							WarnAtAll = true;										
						}	
					}
					else
					{
						AlphaWarning = "For " + e.username + " ensure you enter numbers only, with no letters of the alphabet.\n\n";
						WarnAtAll = true;	
					}
				}							
			}// if type is of text
			 
		} // for each element loop
						
	// now. if there was any errors, display the messages and return false
	// otherwise return true and submit the form
	
	if(WarnAtAll) 
	{	
		WarningMessage = OverallWarning + EmptyMessage + AlphaWarning + MissingWarning;  
		alert(WarningMessage);
		return false;
	}
	else
	{
		return true;
	}
	
}


if (document.images) 
{
	Calculateover = new Image(86,19);
	ClearAllover = new Image(111,19);
	
	Calculateover.src = "/files/images/tools/calculate.gif";
	ClearAllover.src = "/files/images/tools/resetvalues.gif";
	
	Calculateout = new Image(86,19);
	ClearAllout = new Image(111,19);
	
	Calculateout.src = "/files/images/tools/calculate_o.gif";
	ClearAllout.src = "/files/images/tools/resetvalues_o.gif";
}

// Roll Over Stuff
function rollOver(img, target) {
	if (document.images) {
		document[target].src = eval(img + "over.src");
	}
}

function rollOut(img, target) {
	if (document.images) {
		document[target].src = eval(img + "out.src");
	}
}
//End Of Rollover Stuff


function clearAll()
{
	document.Cigarretes.Number_Of_Cigarettes.value = "";
	document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.value = "";	
	document.Cigarretes.Cost_Of_A_Pack.value = "";
	document.smokingCostResult.year_result.value = "";
	document.smokingCostResult.month_result.value = ""
}

function calculate_Smoking_Costs(formdata)
{
	var no_of_cigs;
	var no_of_cigs_in_a_pack;
	var cost_per_pack;
	var end_cost;
	var month_cost;
	
	// Initialise
	no_of_cigs = document.Cigarretes.Number_Of_Cigarettes.value;
	no_of_cigs_in_a_pack = document.Cigarretes.Number_Of_Cigarettes_In_A_Pack.value;	
	cost_per_pack = document.Cigarretes.Cost_Of_A_Pack.value;

	// Validation stuff		
	if (verifyToolkitForm(formdata))
	{
		// Set the end results
		end_cost = Math.round((no_of_cigs/no_of_cigs_in_a_pack) * cost_per_pack * 365);
		document.smokingCostResult.year_result.value = end_cost;	
		
		month_cost = Math.round(((no_of_cigs/no_of_cigs_in_a_pack) * cost_per_pack * 365)/12);
		document.smokingCostResult.month_result.value = month_cost;									
	}
	else
	{
		document.smokingCostResult.year_result.value = "";
		document.smokingCostResult.month_result.value = "";	
	}
}
