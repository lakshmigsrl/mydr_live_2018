jQ(document).ready(function(){
	jQ("#ageInputText").keypress(function(e) {
	    if(e.which == 13) {
        	preCalculate();
	     }
	});
});


if (document.images) {
	pic9over = new Image(75,26);
	pic9over.src = "/files/images/generic/search_o.gif";	
	pic9out = new Image(75,26);
	pic9out.src = "/files/images/generic/search.gif";	
	
	pic10over = new Image(75,26);
	pic10over.src = "/files/images/generic/reset_o.gif";	
	pic10out = new Image(75,26);
	pic10out.src = "/files/images/generic/reset.gif";	
}
function preCalculate(){
                document.Heartrate.txtage.optional=false;
                document.Heartrate.txtage.min=1;
                document.Heartrate.txtage.max=99;
                document.Heartrate.txtage.username='Age';
                document.Heartrate.txtage.numeric=true;
                document.Heartrate.txtmaxrate.optional=true;
                document.Heartrate.txtmaxzone.optional=true;
                document.Heartrate.txtminzone.optional=true;
                calculate(document.Heartrate);
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
		
		for( var i=0; i<f.length; i++)
		{
			var e = f.elements[i];
			
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
// End Form Validation Functions

if (document.images) {
	Calculateover = new Image(86,19);
	ClearAllover = new Image(111,19);
	
	Calculateover.src = "/files/images/tools/calculate.gif";
	ClearAllover.src = "/files/images/tools/resetvalues.gif";
	
	
	
	Calculateout = new Image(86,19);
	ClearAllout = new Image(111,19);	
	
	Calculateout.src = "/files/images/tools/calculate_o.gif";
	ClearAllout.src = "/files/images/tools/resetvalues_o.gif";
	
}

function clearAll()
{
	preanimation = new Image(305,138);
	preanimation.src = "/files/images/animations/heartgraph/grafback.gif";
	
	heart = new Image(40,40);
	heart.src = "/files/images/categories/heartattack/aniheart.gif";
	
	document.GraphImage.src = preanimation.src;
	document.HeartGif.src = heart.src
	
	document.Heartrate.reset();
	document.Heartrate.txtage.focus();
}

function calculate(Heartrate)  
{ 
	animation = new Image(305,138);
	animation.src = "/files/images/animations/heartgraph/anigraf2.gif";
	
	heart = new Image(40,40);
	heart.src = "/files/images/categories/heartattack/aniheart.gif";
	
    
	if (verifyToolkitForm(Heartrate)) 
	{		
		age = document.Heartrate.txtage.value;
		
		if (age > 70)
		{
		alert("WARNING\nIf you are over 70, you should seek your doctor's advice before you exercise.") 
		}
		
		maxrate = 220 - age;
		document.Heartrate.txtmaxrate.value = maxrate;

		minzone = (maxrate)*(.6);
		document.Heartrate.txtminzone.value = parseInt(minzone);

		maxzone = (maxrate)*(.8);
		document.Heartrate.txtmaxzone.value = parseInt(maxzone);
		
        document.GraphImage.src = animation.src;
		
		document.HeartGif.src = heart.src
	}
	else
	{
		document.Heartrate.txtmaxrate.value = "";
		document.Heartrate.txtmaxzone.value = "";
		document.Heartrate.txtminzone.value = "";
	}
}



