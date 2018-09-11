
/* Values for printing... */
var bmi_height=0;
var bmi_weight=0;
var bmi_result=0;
var bmi_resDesc="";


$(document).ready(function() {
	var bmi_inputVal;
	$('input.bmi_inputs').focus(function(){
		bmi_inputVal = this.value;
		this.value = "";
	});
	$('input.bmi_inputs').focusout(function(){
		if(this.value==""){
			this.value = bmi_inputVal;
		}
	});
	$('input.bmi_inputs').keypress(function(e){
		if(e.which == 13) {
			init_submit();
		}
	});
});


// if (document.images) {
// 	pic9over = new Image(75,26);
// 	pic9over.src = "/files/images/generic/search_o.gif";
// 	pic9out = new Image(75,26);
// 	pic9out.src = "/files/images/generic/search.gif";
//
// 	pic10over = new Image(75,26);
// 	pic10over.src = "/files/images/generic/reset_o.gif";
// 	pic10out = new Image(75,26);
// 	pic10out.src = "/files/images/generic/reset.gif";
// }

function init_submit() {
	document.FrontPage_Form1.height.optional=false;
	document.FrontPage_Form1.height.min=120;
	document.FrontPage_Form1.height.max=210;
	document.FrontPage_Form1.height.numeric=true;
	document.FrontPage_Form1.height.username='Height';
	document.FrontPage_Form1.weight.optional=false;
	document.FrontPage_Form1.weight.min=25;
	document.FrontPage_Form1.weight.max=200;
	document.FrontPage_Form1.weight.numeric=true;
	document.FrontPage_Form1.weight.username='Weight';
	// document.ResultPage_Form1.txtbmi.optional=true;
	btncalcbmi(document.FrontPage_Form1);
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

function isblank(s)
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
function PopUp(URL) {
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
function PopUpMedia(Type,ID,PopW,PopH) {
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
function LoginPopUp(LoginURL) {

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

function MiniWebPopup(PopupURL)
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

function WindowPopUp(iUrl, iWidth, iHeight)
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

function ExternalLinkClick(iUrl, iNewWindow, iWidth, iHeight)
{
	iUrl = '/ExtDisclaimer.asp?newwin=' + iNewWindow + '&targeturl=' + iUrl;
	WindowPopUp(iUrl, 500, 405);
	return false;
}
// Begin Form Validation Functions

function isBlankElement(s)
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

	// Calculateover.src = "/files/images/tools/calculate_bmi.gif";
	// ClearAllover.src = "/files/images/tools/resetvalues.gif";

	Calculateout = new Image(86,19);
	ClearAllout = new Image(111,19);

	// Calculateout.src = "/files/images/tools/calculate_bmi_o.gif";
	// ClearAllout.src = "/files/images/tools/resetvalues_o.gif";
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
	$('div#bmi_value').html('0');
	$('div#result_text').html('-');
	document.FrontPage_Form1.reset();
	document.ResultPage_Form1.reset();
	document.getElementById("resultsWrapper").style.display = "none";
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
	document.getElementById("resultsWrapper").style.display = "none";
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
			document.ResultPage_Form1.txtbmi.value = ""
			document.getElementById("resultsWrapper").style.display = "none";
	}
	else
	{
			bmi_height=document.FrontPage_Form1.height.value;
			bmi_weight=document.FrontPage_Form1.weight.value;
			ht=(converttometers(document.FrontPage_Form1.height.value));
			wt=(document.FrontPage_Form1.weight.value);

			b_deci=calcbmi(ht, wt);
			b=Math.round(b_deci);
			bmi_result=b;
			// document.ResultPage_Form1.txtbmi.value = parseInt(b);
			$('div#bmi_value').text(b);
			$('div.resultContent').hide();
			$('#bmiValue').show();


			if ( b_deci < 18.5)
			{
				$('#spanSuitableCategory').html('underweight');
				bmi_resDesc="bmiUnderWeight";
			}
			else
			{
				if ( 18.5 <= b_deci && b_deci < 25)
				{
					$('#bmiAcceptable').show();
					$('div#result_text').text('HEALTHY WEIGHT(BMI of 18.5 - 24.9)');
					$('#spanSuitableCategory').html('have a health weight');
					bmi_resDesc="bmiAcceptable";
					if(b_deci >= 24.5){		//Force display 24 as upper limit is 24.9
						// document.ResultPage_Form1.txtbmi.value = 24;
						$('div#bmi_value').text(24);
						bmi_result=24;
					}
				}
				else
				{
					if ( 25 <= b_deci && b_deci < 30 )
					{
						$('#bmiOverWeight').show();
						$('div#result_text').text('OVER WEIGHT(BMI of 25 - 29.9)');
						$('#spanSuitableCategory').html('overweight');
						bmi_resDesc="bmiOverWeight";
						if(b_deci >= 29.5){		//Force display 29 as upper limit is 29.9
							// document.ResultPage_Form1.txtbmi.value = 29;
							bmi_result=29;
							// document.ResultPage_Form1.txtbmi.value = 29;
							$('div#bmi_value').text(29);
						}
					}
					else
					{
						if ( b_deci > 30 )
						{
							$('#bmiObese').show();
							$('#spanSuitableCategory').html('obese');
							$('div#result_text').text('OBESE(BMI of 30 +)');
							bmi_resDesc="bmiObese";
						}
						else
						{
							highlightCell(0);
						}
					}

					targetW = 24.9 * (ht * ht);
					toLooseW = Math.round(wt - targetW);
					$('.bmi_targetOverWeight').html(toLooseW);
				}
			}
			document.getElementById("resultsWrapper").style.display = "";
	}
}

function print_bmi_result(){
	var rWindow=window.open('/tools/bodymass','','width=700, height=1000, scrollbars=1' );
	rWindow.document.write('<html><head><title>Print Results</title>');
	rWindow.document.write('<link href="/css/tools/bmi/redesign2011/global.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/bmi/redesign2011/netstarter/Styles_Structural.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/bmi/style.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/bmi/patienthandout.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/bmi/print.css" rel="stylesheet" type="text/css" media="print"/>');
	rWindow.document.write('</head><body style="padding: 20px; height:900px;">');
	rWindow.document.write('<a href="#" onclick="print(); return false;" id="print-article" style="float: right;">PRINT</a>');
	rWindow.document.write('<a href="/"><img src="/img/mydr2011__printlogo.gif" alt="myDr Header Logo" border="0"><div id="originalurl">Original article: <a href="/tools/bmi-calculator">http://www.mydr.com.au/tools/bmi-calculator</a></div>');
	rWindow.document.write('<div id="ResultContent"><strong>Your Body Mass Index</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div>');
	rWindow.document.write('  <div class="ResultLabel">Height</div><div class="ResultField"><span>'+bmi_height+' cm</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Weight</div><div class="ResultField"><span>'+bmi_weight+' kg</span></div>');
	rWindow.document.write('  <div class="ResultBottomFiled">');
	rWindow.document.write('      <div class="ResultLabel3">Body Mass Index</div><div class="ResultField1"><span>'+bmi_result+'</span></div>');
	rWindow.document.write('  </div>');
	rWindow.document.write('</div>');

	rWindow.document.write('  <div id="bodymassindexCalculator">');
	rWindow.document.write('     <div id="resultsWrapper">');
	rWindow.document.write('        <div class="resultLevels" style="display: block;">');
	rWindow.document.write(			$('#'+bmi_resDesc).html());
	rWindow.document.write(			$('#resultsFoot').html());
	rWindow.document.write('        </div>');
	rWindow.document.write('     </div>');
	rWindow.document.write('     <p class="MainCopy" style="clear:both;"></p>');
	rWindow.document.write('  </div>');

	rWindow.document.write($('#ReferenceLinkContainer').html());
	rWindow.document.write('<div id="printdisclaimer"><a href="http://mydr.com.au"><b><i>myDr</i>.com.au</b></a><br><i>myDr</i> is a free Australian website dedicated to providing Australian consumers with the most comprehensive and relevant health information resource in Australia.<br><br>This information does not take the place of independent professional advice from your qualified health professional.<br><br>To find out more, search the <i>myDr</i> website for comprehensive health information or talk to your health professional.</div>');
	rWindow.document.write('</body></html>');
	rWindow.focus();
	rWindow.document.close();
	//rWindow.close();
	//setTimeout('', 1000);
	//rWindow.print();

}
