/* Values for printing... */
var bmi_height=0;
var bmi_weight=0;
var bmi_result=0;
var bmi_resDesc="";

jQ(document).ready(function(){
	var bmi_inputVal;
	jQ('input.bmi_inputs').focus(function(){
		bmi_inputVal = this.value;
		this.value = "";
	});
	jQ('input.bmi_inputs').focusout(function(){
		if(this.value==""){
			this.value = bmi_inputVal;
		}
	});

	jQ('input.bmi_inputs').keypress(function(e){
		if(e.which == 13) {
			mini_init_submit();
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

function mini_init_submit() {
	document.mini_FrontPage_Form1.mini_height.optional=false;
	document.mini_FrontPage_Form1.mini_height.min=120;document.mini_FrontPage_Form1.mini_height.max=210;
	document.mini_FrontPage_Form1.mini_height.numeric=true;
	document.mini_FrontPage_Form1.mini_height.username='Height';
	document.mini_FrontPage_Form1.mini_weight.optional=false;
	document.mini_FrontPage_Form1.mini_weight.min=25;
	document.mini_FrontPage_Form1.mini_weight.max=200;
	document.mini_FrontPage_Form1.mini_weight.numeric=true;
	document.mini_FrontPage_Form1.mini_weight.username='Weight';
	document.mini_ResultPage_Form1.mini_txtbmi.optional=true;
	mini_btncalcbmi(document.mini_FrontPage_Form1);
}


// Begin Form Validation Functions

function mini_isblank(s)
// This function read each of the fields that are in the form and returns true if the
// form element contatins only whitespace characters.
//
{
			for (i=0; i < s.length; i++)
			{
				var c = s.charAt(i);
				if ((c != ' ' ) && (c != '\n') && (c !='\t')) return false;
			}
			 return true;
		}
		
		// This if the function that perfroms from validation. It will be invoked from the
		// from onSubmit event handler. The handler should return whatever value this function returns
		//


// ************ Start POPHELPJS Include ************

//######################
//	Help pop up code
//######################
//	defaults
	FixedWidth = 640
	PopW = 500
	PopH = 300
	YOffset = 200;
	var BrName = navigator.appName;

	// PopPath = "PopUps/"
	PopPath = "/search-help"
	// PopFile = "inc"
	PopDone = 0
//######################
// Ziad, Changed this function to work with help.asp
function mini_PopUp(URL) {
	if(PopDone ==1)
		{PopWindow.focus; 
		 PopDone = 0;
		}
	XOffset = (FixedWidth - PopW )/2; 
	// URL = PopPath  + URL + "." + PopFile 
	URL = PopPath  + "?helparea=" + URL 
	if (BrName == "Netscape"){
		XOffset=XOffset+parent.screenX;
		YOffset=YOffset+parent.screenY;
	}
	if (BrName == "Microsoft Internet Explorer"){
		XOffset = screen.availHeight/3;
		YOffset =screen.availWidth/3;
	}
	PopWindow = window.open(URL,"","status=no,width=" + PopW + ",height=" + PopH + ",screenX=" + XOffset + ",screenY=" + YOffset + ",top=" + YOffset + ",left=" + XOffset + ", scrollbars=yes,resizable=yes,border=no,setHotKeys=no,menubar=no,locationbar=no")
	PopWindow.opener = self;
	PopWindow.focus; 
	PopDone = 1
}

//######################
//	Media pop up code
//######################
function mini_PopUpMedia(Type,ID,PopW,PopH) {
	if (PopW == null) {PopW = 200;}
	if (PopH == null) {PopH = 200;}

	if(PopDone == 1)
		{PopWindow.focus; 
		 PopDone = 0;
		}
	XOffset = (FixedWidth - PopW )/2; 
	
	URL='/mediadisplay.asp?id=' + ID + '&Type=' + Type;
	if (BrName == "Netscape"){
		XOffset=XOffset+parent.screenX;
		YOffset=YOffset+parent.screenY;
	}
	if (BrName == "Microsoft Internet Explorer"){
		XOffset = screen.availHeight/3;
		YOffset =screen.availWidth/3;
	}
	PopWindow = window.open(URL,"","status=no,width=" + PopW + ",height=" + PopH + ",screenX=" + XOffset + ",screenY=" + YOffset + ",top=" + YOffset + ",left=" + XOffset + ", scrollbars=no,resizable=yes,border=no,setHotKeys=no,menubar=no,locationbar=no")
	PopWindow.opener = self;
	PopWindow.focus;
	PopDone = 1
}

//######################
//	Login pop up code
//######################
//	defaults
	LoginFixedWidth = 680
	LoginPopW = 320
	LoginPopH = 230
	LoginYOffset = 200;
	var LoginBrName = navigator.appName;
	LoginPopPath = "/Login/"
	LoginPopFile = "asp"
	LoginPopDone = 0
//######################
function mini_LoginPopUp(LoginURL) {

	if(LoginPopDone ==1) {
		LoginPopWindow.focus;
		LoginPopDone = 0;
	}
	
	LoginXOffset = (LoginFixedWidth - LoginPopW )/2; 
	LoginURL = LoginPopPath  + LoginURL + "." + LoginPopFile 
	
	
	if (LoginBrName == "Netscape") {
		LoginXOffset=LoginXOffset+parent.screenX;LoginYOffset=LoginYOffset+parent.screenY;
	}
	
	if (BrName == "Microsoft Internet Explorer") {
		LoginXOffset = screen.availHeight/2;
		LoginYOffset =screen.availWidth/3;
	}
	LoginPopWindow = window.open(LoginURL,"","status=no,width=" + LoginPopW + ",height=" + LoginPopH + ",screenX=" + LoginXOffset + ",screenY=" + LoginYOffset + ",top=" + LoginYOffset + ",left=" + LoginXOffset + ", scrollbars=auto,resizable=yes,border=no,setHotKeys=no,statusbar=no,menubar=no,locationbar=no")
	LoginPopWindow.opener = self;
	LoginPopWindow.focus;
	LoginPopDone = 1
}

//######################
//	Dr MimiWeb pop up code
//######################
//	defaults
var MiniWebWindow = null;

function mini_MiniWebPopup(PopupURL)
{
	if (MiniWebWindow == null)
	{
		MiniWebWindow = window.open(PopupURL, "MiniWeb", "status=yes,width=700,height=500,screenX=20,screenY=20,top=20,left=20,scrollbars=yes,resizable=yes")
		//MiniWebWindow.opener = self;
	}
	else
	{
		if (MiniWebWindow.closed)
		{
			// Reopen the window if needed
			MiniWebWindow = window.open(PopupURL, "MiniWeb", "status=yes,width=700,height=500,screenX=20,screenY=20,top=20,left=20,scrollbars=yes,resizable=yes")
		}
		else
		{
			//reset what the page is to see.
			MiniWebWindow.location = PopupURL;
		}
	}	
	MiniWebWindow.focus();
	//alert("Finished after focus")
}
//************ End POPHELPJS Include ************
//-->

var WndPopUp;

function mini_WindowPopUp(iUrl, iWidth, iHeight)
{
	var popW = iWidth, popH = iHeight;
	var ns = (document.layers) ? true : false;
	var scrnW = (ns) ? window.innerWidth : document.body.offsetWidth;
	var scrnH = (ns) ? window.innerHeight: document.body.offsetHeight;
	var posX, posY;
	if (scrnW && scrnH)
	{
		posX = (scrnW / 2) - (popW / 2);
		if (posX < 0)
		{
			posX = 10;
		}
		posY = (scrnH / 2) - (popH / 2);
		if (posY < 0)
		{
			posY = 10;
		}
	}
	else
	{
		posX = 10;
		posY = 10;
	}
	if (WndPopUp)
	{
		WndPopUp.close();
	};
	WndPopUp = window.open(iUrl, '', 'resizable=yes,scrollbars=yes,width=' + popW + ',height=' + popH + ',left=' + posX + ',top=' + posY);
	WndPopUp.focus();
}

function mini_ExternalLinkClick(iUrl, iNewWindow, iWidth, iHeight)
{
	iUrl = '/ExtDisclaimer.asp?newwin=' + iNewWindow + '&targeturl=' + iUrl;
	mini_WindowPopUp(iUrl, 500, 405);
	return false;
}
// Begin Form Validation Functions

function mini_isBlankElement(s)
// This function read each of the fields that are in the form and returns true if the
// form element contatins only whitespace characters.
//
{
	for (i=0; i < s.length; i++)
	{
		var c = s.charAt(i);
		if ((c != ' ' ) && (c != '\n') && (c !='\t')) return false;
	}
	 return true;
}
	
function mini_isNumeric(s)
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
function mini_verifyToolkitForm(f)
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
				if (((e.value == null) || (e.value == "" ) || mini_isBlankElement(e.value)) && !e.optional)
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
					if (mini_isNumeric(e.value))
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
//document.mini_FrontPage_Form1.mini_height.focus();

function mini_clearAll()
{
	document.mini_FrontPage_Form1.reset();
	document.mini_ResultPage_Form1.reset();
	document.getElementById("mini_resultsWrapper").style.display = "none";
	highlightCell(0);
}

function mini_highlightCell(numberOfCell)
{
	if(IE4)
	{
		mini_clearAllCells();
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

function mini_clearAllCells()
{
	if(IE4)
	{
		First_Row.style.backgroundColor="white";
		Second_Row.style.backgroundColor="white";
		Third_Row.style.backgroundColor="white";
		Fourth_Row.style.backgroundColor="white";
	}
	document.getElementById("mini_resultsWrapper").style.display = "none";
}

function mini_setMessage(message)
{
	document.mini_FrontPage_Form1.txtresult.value = message;				
}


function mini_calcbmi(ht, wt) 
{	
	return (wt/(Math.pow(ht, 2)));
}

function mini_converttometers(ht)
{
    return (ht/100);
}


function mini_btncalcbmi(formdata) 
{	
	var ht; 
	var wt; 
	var b;
		
	if (!mini_verifyToolkitForm(formdata))
	{
			document.mini_ResultPage_Form1.mini_txtbmi.value = ""
			document.getElementById("mini_resultsWrapper").style.display = "none";
	}
	else	
	{
			bmi_height=document.mini_FrontPage_Form1.mini_height.value;
			bmi_weight=document.mini_FrontPage_Form1.mini_weight.value;
			ht=(mini_converttometers(document.mini_FrontPage_Form1.mini_height.value));	
			wt=(document.mini_FrontPage_Form1.mini_weight.value);	
				
			b_deci=mini_calcbmi(ht, wt);		
			b=Math.round(b_deci);
			bmi_result=b;
			document.mini_ResultPage_Form1.mini_txtbmi.value = parseInt(b);
			jQ('div#mini_resultsWrapper div.mini_resultLevels').hide();
			jQ('#mini_bmiValue').show();
			

			if ( b_deci < 18.5)
			{			
				jQ('#mini_bmiUnderWeight').show();
				bmi_resDesc="mini_bmiUnderWeight";
			}
			else 
			{
				if ( 18.5 <= b_deci && b_deci < 25)
				{
					jQ('#mini_bmiAcceptable').show();
					bmi_resDesc="mini_bmiAcceptable";
					if(b_deci >= 24.5){		//Force display 24 as upper limit is 24.9
						document.mini_ResultPage_Form1.mini_txtbmi.value = 24;
						bmi_result=24;
					}
				}
				else
				{
					if ( 25 <= b_deci && b_deci < 30 )
					{
						jQ('#mini_bmiOverWeight').show();
						bmi_resDesc="mini_bmiOverWeight";
						if(b_deci >= 29.5){		//Force display 29 as upper limit is 29.9
							document.mini_ResultPage_Form1.mini_txtbmi.value = 29;
							bmi_result=29;
						}
					}	
					else
					{
						if ( b_deci > 30 )
						{
							jQ('#mini_bmiObese').show();
							bmi_resDesc="mini_bmiObese";
						}		
						else
						{
							highlightCell(0);	
						}
					}				
				}			
			}	
			document.getElementById("mini_resultsWrapper").style.display = "";
	}
}

function mini_print_bmi_result(){
	var rWindow=window.open('/tools/bodymass','','width=700, height=800' );
	rWindow.document.write('<html><head><title>Print Results</title>');
	rWindow.document.write('<link href="/css/redesign2011/global.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/redesign2011/netstarter/Styles_Structural.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/style.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/patienthandout.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/print.css" rel="stylesheet" type="text/css" media="print"/>');
	rWindow.document.write('</head><body style="padding: 20px; height:900px;">');
	rWindow.document.write('<a href="#" onclick="print(); return false;" id="print-article" style="float: right;">PRINT</a>');
	rWindow.document.write('<a href="/"><img src="/img/mydr2011__printlogo.gif" alt="myDr Header Logo" border="0"><div id="originalurl">Original article: <a href="/tools/bodymass">http://www.mydr.com.au/tools/bodymass</a></div>');
	rWindow.document.write('<div id="ResultContent"><strong>Your Body Mass Index</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div>');
	rWindow.document.write('  <div class="ResultLabel">Height</div><div class="ResultField"><span>'+bmi_height+' cm</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Weight</div><div class="ResultField"><span>'+bmi_weight+' kg</span></div>');
	rWindow.document.write('  <div class="ResultBottomFiled">');
	rWindow.document.write('      <div class="ResultLabel3">Body Mass Index</div><div class="ResultField1"><span>'+bmi_result+'</span></div>');
	rWindow.document.write('  </div>');
	rWindow.document.write('</div>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;"></p>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;">A healthy BMI is between 18.5 and 24.9. A result below 18.5 indicates that you may be underweight; a figure above 24.9 indicates that you may be overweight.</p>');

	rWindow.document.write('  <div id="bodymassindexCalculator">');
	rWindow.document.write('     <div id="resultsWrapper">');
	rWindow.document.write('        <div class="resultLevels" style="display: block;">');
	rWindow.document.write(			jQ('#'+bmi_resDesc).html());
	rWindow.document.write('        </div>');
	rWindow.document.write('     </div>');
	rWindow.document.write('  </div>');

	rWindow.document.write(jQ('#ReferenceLinkContainer').html());
	rWindow.document.write('<div id="printdisclaimer"><a href="http://mydr.com.au"><b><i>myDr</i>.com.au</b></a><br><i>myDr</i> is a free Australian website dedicated to providing Australian consumers with the most comprehensive and relevant health information resource in Australia.<br><br>This information does not take the place of independent professional advice from your qualified health professional.<br><br>To find out more, search the <i>myDr</i> website for comprehensive health information or talk to your health professional.</div>');
	rWindow.document.write('</body></html>');
	rWindow.focus();
	rWindow.document.close();
	//rWindow.close();
	//setTimeout('', 1000);
	//rWindow.print();

}
