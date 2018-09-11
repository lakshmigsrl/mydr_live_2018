
/*

See basalenergycalc.js for more details.

+-------------+-------------+------------------------------------------------+
25/09.07     Di       Initial Creation of the tool - based on Cholesterol
+-------------+-------------+------------------------------------------------+


COPYRIGHT 2007- myDr / MIMS Australia / CMP Medica Australia

*/


function write_div(id) { document.write('<div id="' + id + '"></div>'); }
function write_title() { document.write('Daily fibre requirements calculator'); }
function write_img(src) { document.write('<img alt="Daily Fibre Calculator" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }
function write_text() { document.write('<strong>How much fibre do you need per day?</strong><br /><br />Fibre is found in fruits and vegetables, wheat and oat bran, legumes such as lentils, beans and peas, and also nuts. Are you getting enough fibre in your diet? Use this handy tool to check the adequate fibre intake for Australians and New Zealanders.'); }
function write_form() { document.write('<div id="error"></div><table class="inputData"><tr><td class="tdLeft">Gender:</td><td><input onclick="checkW()" type="radio" id="sm" class="contentPrimaryLink" name="s" value="m"  /> Male  <input type="radio" onclick="checkW()" name="s" id="sf" value="f"  /> Female</td></tr><!--/table><br/><table id="xtra"--><tr><td class="tdLeft">Age:</td><td><select id="age" style="width:100px;" ><option value="1-3"> 1 - 3 </option><option value="4-8"> 4 - 8 </option><option value="9-13"> 9 - 13 </option><option value="14-16"> 14 - 18 </option><option value="19-30"> 19 - 30 </option><option value="31-50"> 31 - 50 </option><option value="51-70"> 51 - 70 </option><option value="70-150"> over 70 </option></select></td></tr><tr><td class="tdLeft">Are you pregnant?</td><td><input id="py" onclick="woman(0)" name="p" type="radio" disabled="true"  /> Yes   <input id="pn" name="p" checked="true" type="radio" disabled="true"  /> No</td></tr><tr><td class="tdLeft">Are you breast feeding?</td><td><input id="by"  onclick="woman(1)" name="b" type="radio" disabled="true"  /> Yes   <input id="bn" name="b" checked="true" type="radio" disabled="true"  /> No</td></tr></table>'); }
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="_submit()"  /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="_reset();return false;"  />') }
function write_resulti() { document.write('<strong>The adequate intake of fibre for someone of your age and gender is:<br/><br/></strong><p><span id="res"></span></p><p id="text"></p><p><span style="font-weight:normal;color:#444444;"><br/>Increased levels of dietary fibre can help with weight loss, help lower cholesterol (particularly soluble fibre) and reduce the risk of coronary heart disease, but for disease prevention, your intake may need to be higher than adequate intake.  The NHMRC (National Health and Medical Research Council) has stated that increasing fibre intake to 38 g/day for men, and 28 g/day for women should not lead to any adverse effects and may reduce the risk of developing chronic disease. If this additional intake is through extra vegetables, legumes and fruits, you’ll have the added bonus of increasing your intake of antioxidant vitamins and folate, further improving the health benefits.<br /><br /><!--Reference: Australian Government Department of Health and Ageing and NHMRC. <em>Nutrient Reference Values for Australia and New Zealand, including Recommended Dietary Intakes, 2006.</em> Endorsed 9 September 2005.--></span>');}


function write_result() {
	document.write('<div class="resultLevels">');
	document.write('     <div class="level">');
	document.write('	<div class="description"> Your adequate intake of fibre: </div>');
	document.write('     </div>');
	document.write('     <div class="level">');
	document.write('        <div class="value"> <span id="res"></span> </div>');
	document.write('     </div>');
	document.write('     <div class="fullLevel">');
	document.write('        <div class="description"> <span id="text"></span> </div>');
	document.write('     </div>');
	document.write('</div>');
}

function write_mydr() { document.write('<h2>myDr Health Information</h2><table width=100%><tr><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Articles</p><ul><li><a href="/default.asp?article=375">Dietary fibre</a></li></ul></td><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Health Centres</p><ul><li><a href="/default.asp?section=nutrition%26weight"><i>myDr</i> Nutrition & Weight Centre </a></li></ul></td></tr></table>');}

function woman(id) {
	switch (id) {
	// changed because you can be pregnant and breastfeeding.
		case 0 :
			//getObj('bn').checked=true;
			//getObj('mn').checked=true;
			break;
		case 1:
			//getObj('pn').checked=true;
			//getObj('mn').checked=true;
			break;
		default:
			getObj('bn').checked=true;
			getObj('pn').checked=true;
			break;
	}
}

function checkW() {
		
	if (getObj('sf').checked) {
		getObj('py').disabled=false;
		getObj('pn').disabled=false;
		getObj('by').disabled=false;
		getObj('bn').disabled=false;
		//getObj('my').disabled=false;
		//getObj('mn').disabled=false;
	 } else {
		getObj('py').disabled=true;
		getObj('pn').checked=true;
		getObj('pn').disabled=true;
		getObj('by').disabled=true;
		getObj('bn').disabled=true;
		getObj('bn').checked=true;
		//getObj('my').disabled=true;
		//getObj('mn').disabled=true;
	}
}

/**
 * BEGIN Browser Compatibility;
 */
function checkBrowser(){
        this.ver=navigator.appVersion
        this.dom=document.getElementById?1:0
        this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom)?1:0;
        this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
        this.ie4=(document.all && !this.dom)?1:0;
        this.ie=(this.ie6 || this.ie5 || this.ie4)
        this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
        this.ns4=(document.layers && !this.dom)?1:0;
        this.bw=(this.ie || this.ns4 || this.ns5)
        return this
}
bw=new checkBrowser()

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
function _calculate() {
	
	p = getObj('py').checked;
	b = getObj('by').checked;
	//m = getObj('my').checked;
	a = getObj('age').selectedIndex;
	
	
	var std = Array(
			['14','14'], // 1-3
			['18','18'], // 4-8
			['24','20'], // 9-13
			['28','22', '25', '27'], // 14-18
			['30','25', '28', '30'], // 19-30
			['30','25', '28', '30'], // 31-50
			['30','25'], // 51-70
			['30','25'] // 70+
	);
	
	// Working out which item in the array they need //
	itemno = 0;
	if (getObj('sm').checked) { itemno = 0;}
	if (getObj('sf').checked) {itemno = 1;}
	if (p) {itemno = 2;}
	if (b) {itemno = 3;}
	
	
	getObj('res').innerHTML = std[a][itemno] + ' grams per day';
	
	//getObj('text').innerHTML = 'Increased levels of dietary fibre can help with weight loss, help lower cholesterol (particularly soluble fibre) and reduce the risk of coronary heart disease, but for disease prevention, your intake may need to be higher than adequate intake. The NHMRC (National Health and Medical Research Council) has stated that increasing fibre intake to 38 g/day for men, and 28 g/day for women should not lead to any adverse effects and may reduce the risk of developing chronic disease. If this additional intake is through extra vegetables, legumes and fruits, you’ll have the added bonus of increasing your intake of antioxidant vitamins and folate, further improving the health benefits.';
	

	return true;		
}


function _validate() {
if (navigator.appName == "Microsoft Internet Explorer") {

} else {
	//if (!bw.ie || typeof(error) == 'undefined') {
		error = getObj('error');
}
	error.innerHTML = '';
	
	if (!getObj('sm').checked && !getObj('sf').checked) error.innerHTML += '<li>You have not entered a gender</li>';
	a = getObj('age').selectedIndex;
	if ((getObj('py').checked || getObj('by').checked)) {
		if (getObj('sm').checked || a == 0 || a == 1 || a == 7)
		{
			error.innerHTML += '<li>You have entered a biologically implausible value</li>';
		} else 	if ((a == 6 || a == 2) || (getObj('py').checked && getObj('by').checked) ){
			error.innerHTML += '<li>There is no guideline for these circumstances</li>';
		}
	}

	if (error.innerHTML == '') return true;
	else {
		if (error.innerHTML.toLowerCase().lastIndexOf('<li>') > 0) {
			//this should never happen really, as there is only one possible error...!
			error.innerHTML = '<strong>The following errors were encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required fields and resubmit.<br/><br/>';
		} else
			error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please check data and resubmit.<br/><br/>';
		return false;
	}
		
}

/**
 * Function to launch the process of displaying the result
 */
function _submit() {
	
	if (_validate() && _calculate()) {
		
		getObj('error').style.display='none';
		getObj('resultContainer').style.display='block';
	
		getObj('py').disabled=true;
		getObj('pn').disabled=true;
		getObj('by').disabled=true;
		getObj('bn').disabled=true;
		//getObj('my').disabled=true;
		//getObj('mn').disabled=true;
		getObj('sm').disabled=true;
		getObj('sf').disabled=true;
		getObj('age').disabled=true;
	} else {
		getObj('error').style.display='block';
		getObj('resultContainer').style.display='none';
	}
}

/**
 * Function to reset the form
 */
function _reset() {
	
	// Re-enables the dropdown list
	// hides the result div
	getObj('resultContainer').style.display='none';
	getObj('error').style.display='none';
	getObj('py').disabled=true;
	getObj('pn').disabled=true;
	getObj('by').disabled=true;
	getObj('bn').disabled=true;
	//getObj('my').disabled=false;
	//getObj('mn').disabled=false;
	getObj('sm').disabled=false;
	getObj('sf').disabled=false;
	getObj('age').disabled=false;
	getObj('py').checked=false;
	getObj('bn').checked = false;
	getObj('pn').checked = false;
	getObj('by').checked = false;
	getObj('sm').checked = false;
	getObj('sf').checked = false;
	getObj('age').selectedIndex = 0;
	
	return false;
}
