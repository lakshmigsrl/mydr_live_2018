/* Values for printing... */
var iwc_height=0;
var iwc_result=0;

jQ(document).ready(function(){
	var weight_inputVal;
	jQ('input.weightInputs').focus(function(){
		weight_inputVal = this.value;
		this.value = "";
	});
	jQ('input.weightInputs').focusout(function(){
		if(this.value==""){
			this.value = weight_inputVal;
		}
	});

	jQ('input.weightInputs').keypress(function(e){
		if(e.which == 13) {
			init_submit();
			return false;
		}
	});
});

function init_submit(){
	document.Weight.Height.optional=false;
	document.Weight.Height.min=120;
	document.Weight.Height.max=210;			
	document.Weight.Height.username='Height';
	document.Weight.Height.numeric=true;
	document.weightResult.weight1.optional=true;
	document.weightResult.weight2.optional=true;
	calulate(document.Weight);
	return false;
}





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
<!--
// Begin Form Validation Functions

function isBlankElement(s)
// This function read each of the fields that are in the form and returns true if the
// form element contatins only whitespace characters.
//
{
	for (i=0; i < s.length; i++)
	{
		var c = s.charAt(i);
		if ((c != " " ) && (c != "\n") && (c !="\t")) return false;
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
//-->



<!--
if (document.images) {
	Calculateover = new Image(86,19);
	ClearAllover = new Image(111,19);
	
	Calculateover.src = "/files/images/tools/calculate.gif";
	ClearAllover.src = "/files/images/tools/resetvalues.gif";
	
	Calculateout = new Image(86,19);
	ClearAllout = new Image(111,19);
	still_scale = new Image(96,60)
	
	still_scale.src = "/files/images/tools/scales_animated.gif";	
	Calculateout.src = "/files/images/tools/calculate_o.gif";
	ClearAllout.src = "/files/images/tools/resetvalues_o.gif";
}

function clearAll()
{
	document.Weight.reset();
	document.Weight.Height.focus();
	document["animated_scales"].src = still_scale.src;	
	jQ('a.btnPrintResult').hide();
}

function calulate(formdata)
{
var weight1;
var weight2;
var height1;

	if (verifyToolkitForm(formdata))
	{
		height1 = document.Weight.Height.value/100;
		weight1 = Math.round((height1 * height1)*20);
		weight2 = Math.round((height1 * height1)*25);
		document.weightResult.weight1.value=weight1 + " kg";
		document.weightResult.weight2.value=weight2 + " kg";
//		document.Weight.weight2.value="" + document.Weight.weight2.value;
		document["animated_scales"].src = still_scale.src;
		jQ('a.btnPrintResult').show();
	}
	else
	{
		document.weightResult.weight1.value="";
		document.weightResult.weight2.value="";
		document["animated_scales"].src = still_scale.src;	
	}

	iwc_height = document.Weight.Height.value+' cm';
	iwc_result = weight1+" - "+weight2+" kg";
}

function print_result(){
	var rWindow=window.open('/tools/bodymass','','width=700, height=800' );
	rWindow.document.write('<html><head><title>Print Results</title>');
	rWindow.document.write('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">');
	rWindow.document.write('<link href="/css/redesign2011/global.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/redesign2011/netstarter/Styles_Structural.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/style.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/patienthandout.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/print.css" rel="stylesheet" type="text/css" media="print"/>');
	rWindow.document.write('</head><body style="padding: 20px; height:900px;">');
	rWindow.document.write('<div id="printToolResult">');
	rWindow.document.write('<a href="#" onclick="print(); return false;" id="print-article" style="float: right;">PRINT</a>');
	rWindow.document.write('<a href="/"><img src="/img/mydr2011__printlogo.gif" alt="myDr Header Logo" border="0"><div id="originalurl">Original article: <a href="/tools/ideal-weight-calculator">http://www.mydr.com.au/tools/ideal-weight-calculator</a></div>');
	rWindow.document.write('<div id="ResultContent"><strong>Your Ideal Weight</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div>');
	rWindow.document.write('  <div class="ResultLabel">Height</div><div class="ResultField"><span>'+iwc_height+'</span></div>');
	rWindow.document.write('  <div class="ResultBottomFiled">');
	rWindow.document.write('      <div class="ResultLabel3">Ideal Weight</div><div class="ResultField1"><span>'+iwc_result+'</span></div>');
	rWindow.document.write('  </div>');
	rWindow.document.write('</div>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;"></p>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;">Remember that your personal ideal weight will depend on whether you are a man or a woman, and whether you have a light, medium or heavy-set body frame.</p>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;">Ask your doctor for a weight assessment next time you\'re in the surgery, and don\'t forget to check out the myDr site for useful articles on nutrition and weight.</p>');


	rWindow.document.write(jQ('#ReferenceLinkContainer').html());
	rWindow.document.write('<div id="printdisclaimer"><a href="http://mydr.com.au"><b><i>myDr</i>.com.au</b></a><br><i>myDr</i> is a free Australian website dedicated to providing Australian consumers with the most comprehensive and relevant health information resource in Australia.<br><br>This information does not take the place of independent professional advice from your qualified health professional.<br><br>To find out more, search the <i>myDr</i> website for comprehensive health information or talk to your health professional.</div>');
	rWindow.document.write('</div>');
	rWindow.document.write('</body></html>');
	rWindow.focus();
	rWindow.document.close();
	//rWindow.close();
	//setTimeout('', 1000);
	//rWindow.print();

}



