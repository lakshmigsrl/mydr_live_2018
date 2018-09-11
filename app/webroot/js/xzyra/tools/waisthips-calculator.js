/* Values for printing... */
var w2h_waist=0;
var w2h_hip=0;
var w2h_gender=0;
var w2h_result=0;
var w2h_resDesc="";


var jQ = jQuery.noConflict();
jQ(document).ready(function(){
	var textInputVal;
	var isVisible=false;
	jQ('input.textInputs').focus(function(){
		textInputVal = this.value;
		this.value = "";
	});
	jQ('input.textInputs').focusout(function(){
		if(this.value==""){
			this.value = textInputVal;
		}
	});

	jQ('input.textInputs').keypress(function(e){
		if(e.which == 13) {
			init_submit();
		}
	});

	jQ('a.infoImg').click(function(){
		if(isVisible==true){
			jQ("p.inputDef").hide();
			isVisible=false;
		}else{
			jQ(this).next("p").show();
			isVisible=true;
		}
			
		return false;
	});
	jQ('p.inputDef').click(function(){
		jQ(this).hide();
		isVisible=false;
	});

});

	function init_submit(){
		document.frmTool.waist.optional=false;
		document.frmTool.waist.numeric=true;
		document.frmTool.waist.username='waist';
		document.frmTool.hip.optional=false;
		document.frmTool.hip.numeric=true;
		document.frmTool.hip.username='hip';
		document.ResultPage_Form1.txtRatio.optional=true;
		get_Waist2HipsResult(document.frmTool);
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

		Calculateover.src = "/files/images/generic/calculate.gif";
		ClearAllover.src = "/files/images/generic/resetvalues.gif";

		Calculateout = new Image(86,19);
		ClearAllout = new Image(111,19);

		Calculateout.src = "/files/images/generic/calculate_o.gif";
		ClearAllout.src = "/files/images/generic/resetvalues_o.gif";
	}

	// initialise variables
	var NS4;
	var IE4;
	var ver4;

	NS4 = (document.layers) ? 1 : 0;
	IE4 = (document.all) ? 1 : 0;
	ver4 = (NS4 || IE4) ? 1 : 0;

	function clearAll()
	{
		document.getElementById("resultsWrapper").style.display = "none";
		document.frmTool.reset();
		//highlightCell(0);
		return false;
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
			}
		}
	}

	function clearAllCells()
	{
		if(IE4)
		{
			First_Row.style.backgroundColor="white";
			Second_Row.style.backgroundColor="white";
		}
	}

	function setMessage(message)
	{
		document.frmTool.txtresult.value = message;
	}


	function calcbmi(ht, wt)
	{
		return (wt/(Math.pow(ht, 2)));
	}

	function converttometers(ht)
	{
		return (ht/100);
	}


	function get_Waist2HipsResult(formdata)
	{
		var ht;
		var wt;
		var b;
		jQ('div#resultMale').hide();
		jQ('div#resultFemale').hide();
		jQ('div#resultMaleHealthy').hide();
		jQ('div#resultFemaleHealthy').hide();


		if (!verifyToolkitForm(formdata))
		{
			document.frmTool.txtratio.value = ""
		}else{
			w=(document.frmTool.waist.value);
			h=(document.frmTool.hip.value);

			c=w/h;
			if (! isFinite(c)){
				c = 0;
			}


			document.ResultPage_Form1.txtRatio.value = c.toFixed(2);
			jQ("#resultsWrapper").show();

			sex = jQ('input:radio[name=sex]:checked').val();
			if(sex=="m"){
				if(c>0.9){
					jQ('div#resultMale').show();
					w2h_resDesc = "resultMale";
				}else{
					jQ('div#resultMaleHealthy').show();
					w2h_resDesc = "resultMaleHealthy";
				}
			}else{
				if(c>0.8){
					jQ('div#resultFemale').show();
					w2h_resDesc = "resultFemale";
				}else{
					jQ('div#resultFemaleHealthy').show();
					w2h_resDesc = "resultFemaleHealthy";
				}
			}
			w2h_waist = w;
			w2h_hip = h;
			w2h_gender = sex;
			w2h_result = c.toFixed(2);

		}
		//alert(jQ('#frmTool input:radio[name=sex]:checked').val());
	}

function print_result(){
	var rWindow=window.open('/tools/waist-to-hip-calculator','','width=700, height=800' );
	rWindow.document.write('<html><head><title>Print Results</title>');
	rWindow.document.write('<link href="/css/redesign2011/global.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/redesign2011/netstarter/Styles_Structural.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/style.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/patienthandout.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/print.css" rel="stylesheet" type="text/css" media="print"/>');
	rWindow.document.write('</head><body style="padding: 20px; height:900px;">');
	rWindow.document.write('<div id="printToolResult">');
	rWindow.document.write('<a href="#" onclick="print(); return false;" id="print-article" style="float: right;">PRINT</a>');
	rWindow.document.write('<a href="/"><img src="/img/mydr2011__printlogo.gif" alt="myDr Header Logo" border="0"><div id="originalurl">Original article: <a href="/tools/waist-to-hip-calculator">http://www.mydr.com.au/tools/waist-to-hip-calculator</a></div>');
	rWindow.document.write('<div id="ResultContent"><strong>Your Waist to Hip Ratio</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div>');
	rWindow.document.write('  <div class="ResultLabel">Waist</div><div class="ResultField"><span>'+w2h_waist+' cm</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Hip</div><div class="ResultField"><span>'+w2h_hip+' cm</span></div>');
	rWindow.document.write('  <div class="ResultBottomFiled">');
	rWindow.document.write('      <div class="ResultLabel3">Waist to Hip Ratio: </div><div class="ResultField1"><span>'+w2h_result+'</span></div>');
	rWindow.document.write('  </div>');
	rWindow.document.write('</div>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;"></p>');
	rWindow.document.write('  <div id="waist2hipCalculator">');
	rWindow.document.write('     <div id="resultsWrapper" class="resultsWrapperBlue">');
	rWindow.document.write('        <div class="resultLevels" style="display: block;">');
	rWindow.document.write(			jQ('#'+w2h_resDesc).html());
	rWindow.document.write('        </div>');
	rWindow.document.write('     </div>');
	rWindow.document.write('  </div>');

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
