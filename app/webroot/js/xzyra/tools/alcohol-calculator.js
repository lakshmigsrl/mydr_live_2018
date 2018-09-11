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
	
	Calculateover.src = "/files/images/tools/calculate_bmi.gif";
	ClearAllover.src = "/files/images/tools/resetvalues.gif";
	
	Calculateout = new Image(86,19);
	ClearAllout = new Image(111,19);
	
	Calculateout.src = "/files/images/tools/calculate_bmi_o.gif";
	ClearAllout.src = "/files/images/tools/resetvalues_o.gif";
}

// initialise variables
var NS4;
var IE4;
var ver4;

NS4 = (document.layers) ? 1 : 0;
IE4 = (document.all) ? 1 : 0;
ver4 = (NS4 || IE4) ? 1 : 0;	

//set focus
//document.FrontPage_Form1.height.focus();

function clearAll()
{
	document.FrontPage_Form1.reset();
	highlightCell(0);
}

function highlightCell(numberOfCell)
{
	if(IE4)
	{
		clearAllCells();
		switch (numberOfCell)
		{
			case 1: 
				First_Row.style.backgroundColor="#e8edf9";
				break;
			case 2:
				Second_Row.style.backgroundColor="#e8edf9";
				break;
			case 3: 
				Third_Row.style.backgroundColor="#e8edf9";
				break;
			case 4:
				Fourth_Row.style.backgroundColor="#e8edf9";
				break;	
		}
	}
}

function clearAllCells()
{
	if(IE4)
	{
		First_Row.style.backgroundColor="white";
		Second_Row.style.backgroundColor="white";
		Third_Row.style.backgroundColor="white";
		Fourth_Row.style.backgroundColor="white";
	}
}

function setMessage(message)
{
	document.FrontPage_Form1.txtresult.value = message;				
}


function calcbmi(ht, wt) 
{	
	return (wt/(Math.pow(ht, 2)));
}

function converttometers(ht)
{
    return (ht/100);
}


function btncalcbmi(formdata) 
{	

var ht; 
var wt; 
var b;
	
if (!verifyToolkitForm(formdata))
{
		document.FrontPage_Form1.txtbmi.value = ""
}
else	
{
	ht=(converttometers(document.FrontPage_Form1.height.value));	
	wt=(document.FrontPage_Form1.weight.value);	
		
	b=calcbmi(ht, wt);		
	b=Math.round(b);
	document.FrontPage_Form1.txtbmi.value = parseInt(b);
	
	if ( b < 20)
	{				
		highlightCell(1);
	}
	else 
	{	
		if ( 20 <= b && b < 26 )
		{
			highlightCell(2);

		}
		else
		{
				if ( 26 <= b && b <= 30 )
				{
					highlightCell(3);
				}	
				else
				{
					if ( b > 30 )
					{
						highlightCell(4);
					}		
					else
					{
							highlightCell(0);	
					}
				}				
		}	
	}	
}
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

function ConvertFloat(num)
{
	if (isNumeric(num) == false)
	{
		return 0;
	}
	num = (num != "" ) ? parseFloat(num) :0;
	return num;
}

function calculate()
{
	Row1 = (
			   ConvertFloat(document.frmMain.txtm1.value) + 
			   ConvertFloat(document.frmMain.txtt1.value) + 
			   ConvertFloat(document.frmMain.txtw1.value) + 
			   ConvertFloat(document.frmMain.txth1.value) + 
			   ConvertFloat(document.frmMain.txtf1.value) + 
			   ConvertFloat(document.frmMain.txts1.value) + 
			   ConvertFloat(document.frmMain.txtu1.value)
			   ) * 1;
	Row2 = (
			   ConvertFloat(document.frmMain.txtm2.value) + 
			   ConvertFloat(document.frmMain.txtt2.value) + 
			   ConvertFloat(document.frmMain.txtw2.value) + 
			   ConvertFloat(document.frmMain.txth2.value) + 
			   ConvertFloat(document.frmMain.txtf2.value) + 
			   ConvertFloat(document.frmMain.txts2.value) + 
			   ConvertFloat(document.frmMain.txtu2.value)
			   ) * 1.8;
	Row3 = (
			   ConvertFloat(document.frmMain.txtm3.value) + 
			   ConvertFloat(document.frmMain.txtt3.value) + 
			   ConvertFloat(document.frmMain.txtw3.value) + 
			   ConvertFloat(document.frmMain.txth3.value) + 
			   ConvertFloat(document.frmMain.txtf3.value) + 
			   ConvertFloat(document.frmMain.txts3.value) + 
			   ConvertFloat(document.frmMain.txtu3.value)
			   ) * 1;
	Row4 = (
			   ConvertFloat(document.frmMain.txtm4.value) + 
			   ConvertFloat(document.frmMain.txtt4.value) + 
			   ConvertFloat(document.frmMain.txtw4.value) + 
			   ConvertFloat(document.frmMain.txth4.value) + 
			   ConvertFloat(document.frmMain.txtf4.value) + 
			   ConvertFloat(document.frmMain.txts4.value) + 
			   ConvertFloat(document.frmMain.txtu4.value)
			   ) * 1;
	Row5 = (
			   ConvertFloat(document.frmMain.txtm5.value) + 
			   ConvertFloat(document.frmMain.txtt5.value) + 
			   ConvertFloat(document.frmMain.txtw5.value) + 
			   ConvertFloat(document.frmMain.txth5.value) + 
			   ConvertFloat(document.frmMain.txtf5.value) + 
			   ConvertFloat(document.frmMain.txts5.value) + 
			   ConvertFloat(document.frmMain.txtu5.value)
			   ) * 0.8;
	Row6 = (
			   ConvertFloat(document.frmMain.txtm6.value) + 
			   ConvertFloat(document.frmMain.txtt6.value) + 
			   ConvertFloat(document.frmMain.txtw6.value) + 
			   ConvertFloat(document.frmMain.txth6.value) + 
			   ConvertFloat(document.frmMain.txtf6.value) + 
			   ConvertFloat(document.frmMain.txts6.value) + 
			   ConvertFloat(document.frmMain.txtu6.value)
			   ) * 0.8;
	Row7 = (
			   ConvertFloat(document.frmMain.txtm7.value) + 
			   ConvertFloat(document.frmMain.txtt7.value) + 
			   ConvertFloat(document.frmMain.txtw7.value) + 
			   ConvertFloat(document.frmMain.txth7.value) + 
			   ConvertFloat(document.frmMain.txtf7.value) + 
			   ConvertFloat(document.frmMain.txts7.value) + 
			   ConvertFloat(document.frmMain.txtu7.value)
			   ) * 1.5;
	Row8 = (
			   ConvertFloat(document.frmMain.txtm8.value) + 
			   ConvertFloat(document.frmMain.txtt8.value) + 
			   ConvertFloat(document.frmMain.txtw8.value) + 
			   ConvertFloat(document.frmMain.txth8.value) + 
			   ConvertFloat(document.frmMain.txtf8.value) + 
			   ConvertFloat(document.frmMain.txts8.value) + 
			   ConvertFloat(document.frmMain.txtu8.value)
			   ) * 1.5;
	Row9 = (
			   ConvertFloat(document.frmMain.txtm9.value) + 
			   ConvertFloat(document.frmMain.txtt9.value) + 
			   ConvertFloat(document.frmMain.txtw9.value) + 
			   ConvertFloat(document.frmMain.txth9.value) + 
			   ConvertFloat(document.frmMain.txtf9.value) + 
			   ConvertFloat(document.frmMain.txts9.value) + 
			   ConvertFloat(document.frmMain.txtu9.value)
			   ) * 1.4;
	Row10 = (
			   ConvertFloat(document.frmMain.txtm10.value) + 
			   ConvertFloat(document.frmMain.txtt10.value) + 
			   ConvertFloat(document.frmMain.txtw10.value) + 
			   ConvertFloat(document.frmMain.txth10.value) + 
			   ConvertFloat(document.frmMain.txtf10.value) + 
			   ConvertFloat(document.frmMain.txts10.value) + 
			   ConvertFloat(document.frmMain.txtu10.value)
			   ) * 1.2;
	Row11 = (
			   ConvertFloat(document.frmMain.txtm11.value) + 
			   ConvertFloat(document.frmMain.txtt11.value) + 
			   ConvertFloat(document.frmMain.txtw11.value) + 
			   ConvertFloat(document.frmMain.txth11.value) + 
			   ConvertFloat(document.frmMain.txtf11.value) + 
			   ConvertFloat(document.frmMain.txts11.value) + 
			   ConvertFloat(document.frmMain.txtu11.value)
			   ) * 1;
			   
	document.frmMain.AlcoholUnit.value = Row1+Row2+Row3+Row4+Row5+Row6+Row7+Row8+Row9+Row10+Row11;
	document.frmMain.Result.value = 1;
	
	//	write out results
	//document.getElementById("calcResult_Name").innerHTML = document.frmMain.txtName.value;
	//document.getElementById("calcResult_Week").innerHTML = document.frmMain.txtWeek.value;
	document.getElementById("calcResult_Units").innerHTML = Math.round(document.frmMain.AlcoholUnit.value, 2) + " units or standard drinks";
	 
	 //	hide calculator - show result
	 document.getElementById("calcForm").style.display = "none";
	if(document.frmMain.gender.value=="male"){
		document.getElementById("calcResultMen").style.display = "block";
	}else{
		document.getElementById("calcResultWomen").style.display = "block";
	}
	// document.getElementById("calcResult").style.display = "block";
		window.location.hash = 'TOP';
}

function resetFrm ()
{
	document.frmMain.reset();

	 //	show calculator - hide result
	 document.getElementById("calcForm").style.display = "block";
	 document.getElementById("calcResult").style.display = "none";
}
