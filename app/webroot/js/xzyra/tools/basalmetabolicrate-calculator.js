$(document).ready(function(){
        $('#sm').focus();
        $('#ResultContainer').hide();
});


/*
WARNING -- Do NOT delete this file without transfering the comments over to the other .js!


This file contains everything to generate the Basal Energy Calculator.
It is exactly the same as for the FamilyGP Version and it should stay this way.


+-------------+-------------+------------------------------------------------+
  09/01/06      SEb             Initial Creation of the tool
+-------------+-------------+------------------------------------------------+


COPYRIGHT 2006 - myDr / MIMS Australia / CMP Medica Australia

*/

/*
Edited: 18oct2013 - LiNo
Changed cosmetically to match the current frontend design created by netstarter.
Corresponding html elements that this script works in tandem is in the database(cake_doctor->tools->[id]8, [title]Basal Metabolic Rate Calculator).

*/
function checkBrowser(){
        this.ver=navigator.appVersion
        this.dom=document.getElementById?1:0
        this.ie7=(this.ver.indexOf("MSIE 7")>-1 && this.dom)?1:0;
        this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom)?1:0;
        this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
        this.ie4=(document.all && !this.dom)?1:0;
        this.ie=(this.ie7 || this.ie6 || this.ie5 || this.ie4)
        this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
        this.ns4=(document.layers && !this.dom)?1:0;
        this.bw=(this.ie || this.ns4 || this.ns5)
        return this
}
bw=new checkBrowser()

/**
 * The following are predefined functions to write the content of the tool.
 * These are meant to make any changes more easy by not having to do it everywhere manually.
 */
 // simple function to write a div with a specific id
function write_div(id) { document.write('<div id="' + id + '"></div>'); }

// writes the title of the calculator
function write_title(str) { if (str) document.write (str); else document.write('Basal energy expenditure calculator'); }

// write an image - not used directly by the layout
function write_img(src) { document.write('<img alt="Image" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }

// write the body text of the calculator
function write_text() { document.write('<p>Find out how many calories your body needs at rest just to fuel its normal metabolic activity. Knowing your Basal Metabolic Rate can help with a weight management programme because it can help you to calculate how much energy you spend in a day.</p>'); }

// write the form with the HTML objects for the user to insert parameters 
function write_form() { write_div('error'); document.write('<table><tr><td>Gender:</td><td><input class="contentPrimaryLink" type="radio" id="sm" name="s" value="m"/> Male  <input type="radio" name="s" id="sf" value="f"/> Female</td></tr><tr><td>Height:</td><td><input id="h" class="input" type="text" name="h" class="textbox"/> cm</td></tr><tr><td>Weight:</td><td><input id="w" type="text" class="input" name="w" class="textbox"/> kg</td></tr><tr><td>Age:</td><td><input id="a" type="text" class="input" name="a" class="textbox"/> years</td></tr></table>'); }

// write the submit and reset buttons
function write_tools(sub_out, sub_over, reset_out, reset_over) { 
if((thisstyle) && (thisstyle != "")) {
document.write('<input type="image" value=" S " src="/'+thisstyle+sub_out+'" onmouseout="this.src=\'/'+thisstyle+sub_out+'\';" onmouseover="this.src=\'/'+thisstyle+sub_over+'\';" onclick="return _submit();" /> <input type="image" value=" R " src="/'+thisstyle+reset_out+'" onmouseout="this.src=\'/'+thisstyle+reset_out+'\';" onmouseover="this.src=\'/'+thisstyle+reset_over+'\';" onclick="return _reset();" />'); 
} else {
document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="return _submit();" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="return _reset();" />') 
}}

// writes the result to an hidden div.
function write_result() { document.write('<h2 class="resultLabel">Results <a class="btnPrintResult" href="#" onclick="print_result();">Print your results</a></h2><div id="ResultContent"><strong>Your Basal Energy Expenditure</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div><div class="ResultBottomFiled"><div class="ResultLabel3">Kilocalories per day</div><div class="ResultField1"><span id="res" style="border: none;">XX</span></div></div></div><p class="MainCopy">Basal Energy Expenditure - also known as basal metabolic rate (BMR) or (incorrectly) as resting metabolic rate (RMR) - is the minimum number of calories your body needs at rest to fuel its metabolic activity, for example to maintain functions such as heart beat, breathing and temperature. (A kilocalorie, commonly referred to as a calorie, is equivalent to approximately 4.1868 kilojoules.)</p><p class="MainCopy">Basal energy expenditure usually accounts for about 50-80 per cent of total energy needs. </p><p class="MainCopy">Your total daily energy expenditure is made up of three components: <div class="ResultBottomFiled" style="padding:4px; width:98%; border: none;"><ul style="color: #3687c8;"><li style="font-size: 14px;">basal energy expenditure;</li><li style="font-size: 14px;">energy needed for physical activity; and </li><li style="font-size: 14px;">energy required to metabolise your food.</li></ul></div></p><p class="MainCopy">Your BEE in kilocalories per day has been calculated by the Harris-Benedict equation. There are other equations used by experts to calculate BEE, and different equations may be more accurate in different populations.</p><p class="MainCopy">Because basal metabolism is affected by factors such as body fat and hormones, illness or infections, medications, or fasting, the BEE values predicted by these equations may overestimate (some say by up to 20 per cent) or underestimate the true value. However, they are sufficiently accurate in the majority of people to fall within about 10 per cent of the true value.</p><p class="MainCopy">To find out caloried burned up doing physical activity and exercise, use the <a href="/tools/calories-burned-calculator">Calories Burned Calculator</a>.</p><span style="font-weight:normal;color:#444444;"><br/><br/></span>');}

/**
 * A cross-browser compatible getElementById()
 */
function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

/**
 * END Browser Compatibility;
 */

/**
 * Function to display the calculated result 
 */
var bmr_result;
var bmr_gender;
var bmr_height;
var bmr_weight;
var bmr_age;
function _calculate() {
	
	try {
		h = getObj('h').value;
		w = getObj('w').value;
		a = getObj('a').value;
		bmr_height=h;
		bmr_weight=w;
		bmr_age=a;
			
		if (getObj('sm').checked) {
			v = 66.5 + (13.75 * w) + (5.003 * h) - (6.775 * a);
			bmr_gender='Male';
		}else{
			v = 655.1 + (9.563 * w) + (1.85 * h) - (4.676 * a);
			bmr_gender='Female';
		}
		v = Math.round(v);//*1000)/1000;
		
		getObj('res').innerHTML = v;
		bmr_result = v;
		
		if (getObj('a').value < 18) 
			getObj('age_err').innerHTML = '<br/>This calculator may not be suitable for infants, children or teenagers.<br/>';
	
		return true;
	
	} catch (e) {
		// this should not happen much really, unless there is a javascript error in the code!
		alert(e.message);
		return false;		
	}
}


// validation, returns true or false and displays a detailed error message if false.
function _validate() {
	
	if (navigator.appName == "Microsoft Internet Explorer") {

} else {
	//if (!bw.ie || typeof(error) == 'undefined') {
		error = getObj('error');
}
	
	error.innerHTML = '';
	
	if (!getObj('sm').checked && !getObj('sf').checked) error.innerHTML += '<li style="background: none;">You have not entered a gender</li>';
	
	if (getObj('h').value == '') error.innerHTML += '<li style="background: none;">You have not entered a height</li>';
	else if (isNaN(getObj('h').value)) error.innerHTML += '<li style="background: none;">You have not entered a valid height</li>';
	//else if (getObj('h').value < 10 || getObj('h').value > 200) error.innerHTML += '<li>Please enter a height which makes sense!</li>';
		
	if (getObj('w').value == '') error.innerHTML += '<li style="background: none;">You have not entered a weight</li>';
	else if (isNaN(getObj('w').value)) error.innerHTML += '<li style="background: none;">You have not entered a valid weight</li>';
	//else if (getObj('w').value < 1 || getObj('w').value > 300) error.innerHTML += '<li>Please enter a weight makes sense!</li>';
		
	if (getObj('a').value == '') error.innerHTML += '<li style="background: none;">You have not entered an age</li>';
	else if (isNaN(getObj('a').value)) error.innerHTML += '<li style="background: none;">You have not entered a valid age</li>';
	//else if (getObj('a').value < 18) error.innerHTML += '<li>This calculator may not be suitable for infants, children or teenagers.</li>';
	//else if (getObj('a').value < 1 || getObj('a').value > 115) error.innerHTML += '<li>Please enter an age which makes sense!</li>';
	
	if (error.innerHTML == '') return true;
	else {

		if (error.innerHTML.toLowerCase().lastIndexOf('<li style="background: none;">') > 0)
			error.innerHTML = '<strong>The following errors were encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required fields and resubmit.<br/><br/>';
		else
			error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required field and resubmit.<br/><br/>';
		return false;
	}
		
}


/**
 * Function to launch the process of displaying the result
 */
function _submit() {
	
	if (_validate() && _calculate()) {
		
		getObj('error').style.display='none';
		getObj('ResultContainer').style.display='block';
		//getObj('w').disabled=true;
		//getObj('a').disabled=true;
		//getObj('h').disabled=true;
		//getObj('sf').disabled=true;
		//getObj('sm').disabled=true;
		
	} else {
		getObj('ResultContainer').style.display='none';
		getObj('error').style.display='block';
	}
	return false;
}

/**
 * Function to reset the form
 */
function _reset() {
	
	// Re-enables the dropdown list
	// hides the result div
	getObj('ResultContainer').style.display='none';
	getObj('error').style.display='none';
	getObj('w').disabled=false;
	getObj('a').disabled=false;
	getObj('h').disabled=false;
	getObj('sf').disabled=false;
	getObj('sm').disabled=false;
	getObj('w').value='';
	getObj('a').value='';
	getObj('h').value='';
	getObj('sf').checked=false;
	getObj('sm').checked=false;
	
	return false;
}

function getKeyResponse(e){
	if (e.keyCode == 13) {
		_submit();
	}
}

function print_result(){
	var rWindow=window.open('/tools/basal-energy-calculator','','width=700, height=800' );
	rWindow.document.write('<html><head><title>Print Results</title>');
	rWindow.document.write('<link href="/css/redesign2011/global.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/redesign2011/netstarter/Styles_Structural.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/style.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/patienthandout.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/print.css" rel="stylesheet" type="text/css" media="print"/>');
	rWindow.document.write('</head><body style="padding: 20px; height:900px;">');
	rWindow.document.write('<a href="#" onclick="print(); return false;" id="print-article" style="float: right;">PRINT</a>');
	rWindow.document.write('<a href="/"><img src="/img/mydr2011__printlogo.gif" alt="myDr Header Logo" border="0"><div id="originalurl">Original article: <a href="/tools/basal-energy-calculator">http://www.mydr.com.au/tools/basal-energy-calculator</a></div>');
	rWindow.document.write('<div id="ResultContent"><strong>Your Basal Energy Expenditure</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div>');
	rWindow.document.write('  <div class="ResultLabel">Gender</div><div class="ResultField"><span>'+bmr_gender+'</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Height</div><div class="ResultField"><span>'+bmr_height+'</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Weight</div><div class="ResultField"><span>'+bmr_weight+'</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Age</div><div class="ResultField"><span>'+bmr_age+'</span></div>');
	rWindow.document.write('  <div class="ResultBottomFiled">');
	rWindow.document.write('      <div class="ResultLabel3">Kilocalories per day</div><div class="ResultField1"><span>'+bmr_result+'</span></div>');
	rWindow.document.write('  </div>');
	rWindow.document.write('</div>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;">Basal Energy Expenditure - also known as basal metabolic rate (BMR) or (incorrectly) as resting metabolic rate (RMR) - is the minimum number of calories your body needs at rest to fuel its metabolic activity, for example to maintain functions such as heart beat, breathing and temperature. (A kilocalorie, commonly referred to as a calorie, is equivalent to approximately 4.1868 kilojoules.)</p>');
	rWindow.document.write('  <p class="MainCopy">Basal energy expenditure usually accounts for about 50-80 per cent of total energy needs. </p>');
	rWindow.document.write('  <p class="MainCopy">Your total daily energy expenditure is made up of three components: </p>');
	rWindow.document.write('  <div class="ResultBottomFiled" style="padding:4px; width:100%; border: none; clear: both;"><ul style="color: #3687c8;"><li style="font-size: 14px;">basal energy expenditure;</li><li style="font-size: 14px;">energy needed for physical activity; and </li><li style="font-size: 14px;">energy required to metabolise your food.</li></ul></div>');
	rWindow.document.write('  <p class="MainCopy">Your BEE in kilocalories per day has been calculated by the Harris-Benedict equation. There are other equations used by experts to calculate BEE, and different equations may be more accurate in different populations.</p>')
	rWindow.document.write('  <p class="MainCopy">Because basal metabolism is affected by factors such as body fat and hormones, illness or infections, medications, or fasting, the BEE values predicted by these equations may overestimate (some say by up to 20 per cent) or underestimate the true value. However, they are sufficiently accurate in the majority of people to fall within about 10 per cent of the true value.</p>');
	rWindow.document.write('<p class="MainCopy">To find out caloried burned up doing physical activity and exercise, use the <a href="/tools/calories-burned-calculator">Calories Burned Calculator</a>.</p><br /><br />');
	rWindow.document.write($('#ReferenceLinkContainer').html());
	rWindow.document.write('<div id="printdisclaimer"><a href="http://mydr.com.au"><b><i>myDr</i>.com.au</b></a><br><i>myDr</i> is a free Australian website dedicated to providing Australian consumers with the most comprehensive and relevant health information resource in Australia.<br><br>This information does not take the place of independent professional advice from your qualified health professional.<br><br>To find out more, search the <i>myDr</i> website for comprehensive health information or talk to your health professional.</div>');
	rWindow.document.write('</body></html>');
	rWindow.focus();
	rWindow.document.close();
	//rWindow.close();
	//setTimeout('', 1000);
	//rWindow.print();

}
