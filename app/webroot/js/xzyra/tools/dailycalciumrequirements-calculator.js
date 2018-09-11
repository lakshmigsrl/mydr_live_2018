
function write_div(id) { document.write('<div id="' + id + '"></div>'); }
function write_title() { document.write('Daily calcium requirements calculator'); }
function write_img(src) { document.write('<img alt="Daily Calcium Requirements Calculator" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }
function write_text() { document.write('How much calcium do you need per day? Find out what your daily calcium requirements are using our easy calculator.'); }
function write_form() { document.write('<div id="error"></div><table class="inputData"><tr><td class="tdLeft">Gender:</td><td><input onclick="checkW()" type="radio" id="sm" class="contentPrimaryLink" name="s" value="m"/> Male  <input type="radio" onclick="checkW()" name="s" id="sf" value="f"/> Female</td></tr><!--/table><br/><table id="xtra"--><tr><td class="tdLeft">Age:</td><td><select id="age" style="width:100px;"><option value="1-3"> 1 - 3 </option><option value="4-8"> 4 - 8 </option><option value="9-11"> 9 - 11 </option><option value="12-13"> 12 - 13 </option><option value="14-16"> 14 - 18 </option><option value="19-30"> 19 - 30 </option><option value="31-50"> 31 - 50 </option><option value="51-70"> 51 - 70 </option><option value="70-150"> over 70 </option></select></td></tr><tr><td class="tdLeft">Are you pregnant?</td><td><input id="py" onclick="woman(0)" name="p" type="radio"/> Yes   <input id="pn" name="p" checked="true" type="radio"/> No</td></tr><tr><td class="tdLeft">Are you breast feeding?</td><td><input id="by"  onclick="woman(1)" name="b" type="radio"/> Yes   <input id="bn" name="b" checked="true" type="radio"/> No</td></tr><!--tr><td>Have you gone through<br/>menopause?</td><td><input id="my"  onclick="woman(2)" name="m" type="radio"/> Yes ��<input name="m" id="mn" checked="true" type="radio"/> No</td></tr--></table>'); }
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="_submit()" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="_reset();return false;" />') }
function write_resulti() { document.write('<strong>Your suggested Recommended Daily Intake (RDI) of calcium is:</strong><p><span id="res"></span></p><p id="text"></p><p><span style="font-weight:normal;color:#444444;"><br/></span>');}

function write_result() {
	document.write('<div class="resultLevels">');
	document.write('     <div class="level">');
	document.write('	<div class="description"> Your suggested Recommended Daily Intake (RDI) of calcium is: </div>');
	document.write('     </div>');
	document.write('     <div class="level">');
	document.write('        <div class="value"> <span id="res"></span> </div>');
	document.write('     </div>');
	document.write('     <div class="fullLevel">');
	document.write('        <div class="description"> <span id="text"></span> </div>');
	document.write('     </div>');
	document.write('</div>');
}

function write_mydr() { document.write('<h2>myDr Health Information</h2><table><tr><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Articles</p><ul><li><a href="/default.asp?article=3731">Boost your calcium intake to prevent osteoporosis</a></li><li><a href="/default.asp?article=3483">A��Z of <i>myDr</i> articles on osteoporosis</a></li></ul></td><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Health Centres</p><ul><li><a href="/default.asp?section=women%60shealth"><i>myDr</i> Women\'s Health Centre</a></li></ul></td></tr></table>');}

function woman(id) {
	switch (id) {
		case 0 :
			getObj('bn').checked=true;
			//getObj('mn').checked=true;
			break;
		case 1:
			getObj('pn').checked=true;
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
		getObj('pn').disabled=true;
		getObj('by').disabled=true;
		getObj('bn').disabled=true;
		//getObj('my').disabled=true;
		//getObj('mn').disabled=true;
	}
}

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
	
	/* 
		Previously, there was no age consideration.
		
	if (getObj('sm').checked) 
		// MALE
		v = Array(800,'The Australian RDI for calcium for men of all ages is 800 mg. Some evidence points to older men needing more calcium, because of age-related changes in calcium and vitamin D metabolism.');
	else if (p)
		// WOMAN Pregnant
		v = Array(1100, 'In pregnancy, an additional 300 mg/day is recommended on top of the baseline 800 mg, making a total of 1100 mg/day.');
	else if (b)
		// WOMAN Breastfeeding / Lactating
		v = Array(1200, 'Lactating women are recommended to have an additional 400 mg/day on top of the baseline 800 mg of calcium, making a total of 1200 mg.');
	else if (m)
		// WOMAN menopause
		v = Array(1000, 'After menopause women should increase their daily calcium to 1000 mg/day. Osteoporosis Australia suggest 1000 mg after age 54 years.');	
	else 
		// WOMAN 
		v = Array(800, 'Women aged over 18 who haven't yet gone through menopause are recommended to have 800 mg of calcium per day.');
	
	getObj('res').innerHTML = v[0] + ' mg';
	getObj('text').innerHTML = v[1];
	*/
	
	var std = Array(
			['500','500'], // 1-3
			['700','700'], // 4-8
			['1,000','1,000'], // 9-11
			['1,300','1,300'], // 12-13
			['1,300','1,300'], // 14-18
			['1,000','1,000'], // 19-30
			['1,000','1,000'], // 31-50
			['1,000','1,300'], // 51-70
			['1,300','1,300'] // 70+
	);
	
	// theoretically we should probably have a different array for pregnant and for lactating women.. however because the values are exactly the same... there is no point really! //
	
	getObj('res').innerHTML = std[a][(getObj('sm').checked?0:1)] + ' mg';
	getObj('text').innerHTML = 'This recommendation is based on the <em>Nutrient Reference Values for Australia and New Zealand</em>, 2006.';
	

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

	if (error.innerHTML == '') return true;
	else {
		if (error.innerHTML.toLowerCase().lastIndexOf('<li>') > 0) {
			//this should never happen really, as there is only one possible error...!
			error.innerHTML = '<strong>The following errors were encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required fields and resubmit.<br/><br/>';
		} else
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
	getObj('py').disabled=false;
	getObj('pn').disabled=false;
	getObj('by').disabled=false;
	getObj('bn').disabled=false;
	//getObj('my').disabled=false;
	//getObj('mn').disabled=false;
	getObj('sm').disabled=false;
	getObj('sf').disabled=false;
	getObj('age').disabled=false;
	//getObj('mn').checked = true;
	getObj('bn').checked = true;
	getObj('pn').checked = true;
	getObj('sm').checked = false;
	getObj('sf').checked = false;
	getObj('age').selectedIndex = 0;
	
	return false;
}

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
