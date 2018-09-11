
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

function hdra() {

	var coef = null;
	var xbar = null;

	var raw = null;
	var risk = null;
	
	this.setDataForGender = function() {
		if (this.raw.gender == 'm') {
			this.coef = [52.00961, 	20.014077, -0.905964, 1.305784, 0.241549, 12.096316, -4.605038, -2.84367, -2.93323];
			this.xbar = [3.8926095, 5.3441475, 3.7731132, 4.8618212, 0.1180474, 0.335602, 20.8111562, 1.2890301, 15.2144965];
			this.factor5 = 0.97635;
			this.factor10 = 0.9402;
		} else {
			this.coef = [31.764001, 22.465206, -1.187731, 2.552905, 0.420251, 13.07543, -5.060998, -2.996945, 0];
			this.xbar = [3.9213204, 5.3628984, 4.0146369, 4.8376494, 0.142802, 0.3236202, 21.0557746, 1.2519882, 0];
			this.factor5 = 0.99555;
			this.factor10 = 0.98767;
		}
	}
	
	this.init = function(obj) {
	
		if (!obj.gender || (obj.gender.toLowerCase() != 'f' && obj.gender.toLowerCase() != 'm')) return alert("hdra.__init__ : 'gender' undefined or invalid value; x = m || f") && false;
		if (!obj.age || parseInt(obj.age) != obj.age || parseInt(obj.age) < 30 || parseInt(obj.age) > 79) return alert("hdra.__init__ : 'age' undefined or invalid value; int, 30 <= x <= 79") && false;
		if (!obj.cholesterol || parseFloat(obj.cholesterol) != obj.cholesterol || parseFloat(obj.cholesterol) < 130 || parseFloat(obj.cholesterol) > 320) return alert("hdra.__init__ : 'cholesterol' undefined or invalid value; int, 130 <= x <= 320") && false;
		if (!obj.hdl || parseFloat(obj.hdl) != obj.hdl || parseFloat(obj.hdl) < 20 || parseFloat(obj.hdl) > 100) return alert("hdra.__init__ : 'hdl' undefined or invalid value; int, 20 <= x <= 100") && false;
		if (!obj.bp || parseFloat(obj.bp) != obj.bp || parseFloat(obj.bp) < 90 || parseFloat(obj.bp) > 200) return alert("hdra.__init__ : 'bp' undefined or invalid value; int, 90 <= x <= 200") && false;
		if (parseInt(obj) <= 120 && typeof obj.hyper == 'undefined') return alert("hdra.__init__ : 'hyper' undefined or invalid value; bool, if bp > 120") && false; 
		if (typeof obj.smoker == 'undefined') return alert("hdra.__init__ : 'smoker' undefined or invalid value; bool") && false; 
		
		this.raw = new Object();
		this.raw.arr = Array();

		this.raw.gender = obj.gender.toLowerCase();
		this.raw.arr[0] = this.raw.gender;
		
		this.raw.age = parseInt(obj.age);
		this.raw.arr[1] = this.raw.age;

		this.raw.cholesterol = parseFloat(obj.cholesterol);
		this.raw.arr[2] = this.raw.cholesterol;
		
		this.raw.hdl = parseFloat(obj.hdl);
		this.raw.arr[3] = this.raw.hdl;
		
		this.raw.bp = parseFloat(obj.bp);
		this.raw.arr[4] = this.raw.bp;
		
		this.raw.hyper = obj.hyper.toString() == 'true' || parseInt(obj.hyper.toString()) > 0;
		this.raw.arr[5] = this.raw.hyper;
		
		this.raw.smoker = obj.smoker.toString() == 'true' || parseInt(obj.smoker.toString()) > 0;
		this.raw.arr[6] = this.raw.smoker;
		
		this.setDataForGender();
		
		return true;
	}
	
	this.calcRisk = function(yrs) {
		// if no years is mention, default to 10
		if (!yrs || parseInt(yrs) != 5) yrs = 10;
		else yrs = parseInt(yrs);
			
		/* First let's calculate the x value for this... */
		this.x = Array();
		
		this.x[0] = Math.log(this.raw.age);
		this.x[1] = Math.log(this.raw.cholesterol);
		this.x[2] = Math.log(this.raw.hdl);
		this.x[3] = Math.log(this.raw.bp);
		this.x[4] = this.raw.bp > 120 && this.raw.hyper ? 1 : 0;
		this.x[5] = this.raw.smoker ? 1 : 0;
		this.x[6] = this.x[0] * this.x[1];
		this.x[7] = this.x[0] * this.x[5];
		this.x[8] = this.x[0] * this.x[0];
		
		/* Then let's have a look at the betaXBar */
		this.betaXBar = Array();
		for(i = 0; i <= 8; i++) this.betaXBar[i] = this.coef[i] * this.xbar[i];

		/* then the betaX... */
		this.betaX = Array();
		for(i = 0; i <= 8; i++) this.betaX[i] = this.coef[i] * this.x[i];
		if (this.raw.age > 70 && this.raw.gender == 'm') this.betaX[7] = this.x[5] * Math.log(70) * this.coef[7];
		else if (this.raw.age > 78 && this.raw.gender == 'f') this.betaX[7] = this.x[5] * Math.log(78) * this.coef[7];
		
		/* and finally the total for those. */
		this.totalBetaXBar = 0;
		this.totalBetaX = 0;
		for(i = 0; i <= 8; i++) {
			this.totalBetaXBar += this.betaXBar[i];
			this.totalBetaX	+= this.betaX[i];
		}
		
		/* finally let's calculate the risk... NOTE: this.factor# must exists (for #yrs estimate) -> declared in setDataForGender */
		var factor;
		eval('factor = this.factor'+yrs+';');
		
		this.risk = 1-Math.pow(factor,Math.exp(this.totalBetaX-this.totalBetaXBar));
		return true;
	}
	
	this.alert = function() {
		
		str = 'Gender : '+this.raw.gender+'\n';
		str += 'Age : '+this.raw.age+'\n';
		str += 'Cholesterol : '+this.raw.cholesterol+'\n';
		str += 'HDL : '+this.raw.hdl+'\n';
		str += 'Blood Pressure : '+this.raw.bp+'\n';
		str += 'Hypertension? : '+(this.raw.hyper?'yes':'no')+'\n';
		str += 'Smoker? : '+(this.raw.smoker?'yes':'no');
		
		alert(str);
	}
	this.printDebug = function(ret) {
		str = "<h2>Calculation Details [Debug Only]</h2>";
		
		str += "<h3>Input:</h3><div style='padding-left:25px;'>";
		
		str += 'Gender : '+this.raw.gender+'<br/>';
		str += 'Age : '+this.raw.age+'<br/>';
		str += 'Cholesterol : '+this.raw.cholesterol+'<br/>';
		str += 'HDL : '+this.raw.hdl+'<br/>';
		str += 'Blood Pressure : '+this.raw.bp+'<br/>';
		str += 'Hypertension? : '+(this.raw.hyper?'yes':'no')+'<br/>';
		str += 'Smoker? : '+(this.raw.smoker?'yes':'no')+'<br/>';
		
		str += "</div>";
		
		str += "<h3>Calculation:</h3><div style='padding-left:25px;'>";
		
		str += '<strong style="text-decoration:underline;">X Values</strong><br/>';
		for(i=0;i<=8;i++)
			str += 'x['+i+'] = '+ this.x[i]+'<br/>';
		if (this.raw.bp <= 120 && this.raw.hyper) str += '<span style="color:#c00;">** bp <= 120, hyper ignored **</span><br/>';
			
		str += '<br/><strong style="text-decoration:underline;">betaXBar Values</strong><br/>';
		for(i=0;i<=8;i++)
			str += 'betaXBar['+i+'] = '+ this.betaXBar[i]+'<br/>';
		
		str += '<br/><strong style="text-decoration:underline;">betaX Values</strong><br/>';
		for(i=0;i<=8;i++)
			str += 'betaX['+i+'] = '+ this.betaX[i]+'<br/>';
		if (this.raw.age > 70 && this.raw.gender == 'm') str += '<span style="color:#c00;">** age > 70 (M), betaX[7] changed **</span><br/>';
		else if (this.raw.age > 78 && this.raw.gender == 'f') str += '<span style="color:#c00;">** age > 78 (F), betaX[7] changed **</span><br/>';
		
		str += '<br/><strong style="text-decoration:underline;">Totals</strong><br/>';
		str += 'SUM(betaXBar) = '+this.totalBetaXBar+'<br/>';
		str += 'SUM(betaX) = '+this.totalBetaX+'<br/>';
		str += "</div>";
		
		str += "<h3>Risk:</h3><div style='padding-left:25px;'>";
		
		str += this.risk+' or '+(Math.round(this.risk*10000)/10000)+'<br/>';
		str += '<strong style="border:1px solid red;padding:5px;margin:5px;display:table;">'+(Math.round(this.risk*10000)/100)+'%</strong><br/>';
		
		str += "</div>";
		
		if (!ret) document.write(str);
		else return str;
			
		return true;
	}

}

function convertUnit(value) {
	return value * 38.7;
}


/**
 * The following are predefined functions to write the content of the tool.
 * These are meant to make any changes more easy by not having to do it everywhere manually.
 */
 // simple function to write a div with a specific id
function write_div(id) { document.write('<div id="' + id + '"></div>'); }

// write an image - not used directly by the layout
function write_img(src) { document.write('<img alt="Image" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }

// write the body text of the calculator
function write_text() { document.write('<p>This tool estimates your chance of developing coronary heart disease over the next 10 years. This is your risk of developing angina, having a heart attack or dying from coronary heart disease.</p><p>The calculator estimates your risk using information from a well-known US study called the Framingham Heart Study. You will need to know your cholesterol test results.</p><p>Note that this calculator:<ul><li>is suitable for adults between the ages of 30 and 79 only;</li><li>is not suitable for people who already have known heart disease or diabetes; and</li><li>is not validated for people of Aboriginal or Torres Strait Islander descent.</li></ul></p>'); }

// write the form with the HTML objects for the user to insert parameters 
function write_form() { 
	
	document.write ('<span style="color:black;font-weight:bold;">Enter your information to find out your risk</span><br/><br/>');
	
	write_div('error'); 
	
	str = '<table>';
	
	str += '<tr><td>Gender:</td><td style="padding: 12px 0;"><label class="yesno"><input id="male" type="radio" name="gender" class="contentPrimaryLink" value="m" checked="CHECKED"/> Male </label><label class="yesno"><input type="radio"  id="female" name="gender" value="f"/> Female </label></td></tr>';
	
	str += '<tr><td>Age:</td><td><input type="text" id="age" pattern="[0-9]*" class="input" maxlength="2"/> years</td></tr>';
	
	str += '<tr><td>Total cholesterol:</td><td><input type="number" step="0.01" id="chol" class="input" maxlength="5"/> mmol/L</td></tr>';
	
	str += '<tr><td>HDL cholesterol:</td><td><input type="number" step="0.01" id="hdl" class="input" maxlength="5"/> mmol/L</td></tr>';
	
	//str += '<tr><td>Systolic blood pressure:<div style="color:#666;font-size:9px;">Your blood pressure is usually displayed <br/>as 2 measurements e.g. 130/90. The higher <br/>number is the systolic pressure - here it <br/>would be 130.</div></td><td><input type="text" id="sbp" pattern="[0-9]*" class="input" maxlength="3"/> mmHg</td></tr>';
	str += '<tr><td>Systolic blood pressure:</td><td><input type="text" id="sbp" pattern="[0-9]*" class="input" maxlength="3"/> mmHg</td></tr>';
	str += '<tr><td colspan="2"><div class="infoNote">Your blood pressure is usually displayed as 2 measurements e.g. 130/90. The higher number is the systolic pressure - here it would be 130.</div></td></tr>';

	str += '<tr><td style="padding: 12px 0;">Are you taking blood <br/>pressure medications?:</td><td><label class="yesno"><input id="hyper" type="radio" name="hyper" value="true" checked="CHECKED"/> Yes </label><label class="yesno"><input id="hyper2" type="radio" name="hyper" value="false"/> No </label></td></tr>';

	str += '<tr><td style="padding: 6px 0;">Smoker:</td><td><label class="yesno"><input type="radio" id="smoker" name="smoker" value="true" checked="CHECKED"/> Yes </label> <label class="yesno"><input type="radio" id="smoker2" name="smoker" value="false"/> No </label></td></tr>';
	
	str += '</table>';

	document.write(str);
}

// write the submit and reset buttons
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="return _submit();" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="return _reset();" />') }

// writes the result to an hidden div.
function write_result() { 
	resUp = '<div class="resultLevels">';
	resUp += '	<div class="indication maxWidth">';
	resUp += '		<div class="label">';
	resUp += '			Heart Disease Risk Result';
	resUp += '		</div>';
	resUp += '		<div class="description">';
	resUp += '			<p>';

	resDn = '			</p>';
	resDn += '		</div>';
	resDn += '	</div>';
	resDn += '</div>';
	document.write('<h2 class="resultLabel">RESULTS</h2>');
	document.write('<div id="age_err"></div>');
	document.write(resUp);
	document.write('<p>Your risk score is <span id="res">XX</span> per cent.</p>');
	document.write('<p>This means that <span id="res2">XX</span> of 100 people who have the same risk as you will have a heart attack, angina or die of heart disease in the next 10 years. The lower your risk score the less likely it is that you will have a coronary heart disease event such as these in the next 10 years.</p>');
	document.write(resDn);
	document.write('<span style="font-weight:normal;color:#444444;"><br/>Source: <i>National Cholesterol Education Program of the National Institutes of Health (NIH) National Heart, Lung, and Blood Institute. Third Report of the Expert Panel on Detection, Evaluation, and Treatment of High Blood Cholesterol in Adults (Adult Treatment Panel III).</i></span>');
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
var calc = new hdra();

function _calculate() {
	
	calc.init({
		gender:getObj('male').checked?'m':'f',
		age:getObj('age').value,
		cholesterol:(getObj('chol').value*38.7),
		hdl:(getObj('hdl').value*38.7),
		bp:getObj('sbp').value,
		hyper:getObj('hyper').checked?true:false,
		smoker:getObj('smoker').checked?true:false
	});

	calc.calcRisk();
	//calc.printDebug(false);
	var risk = calc.risk;
	risk = Math.round(risk*1000)/10;
	
	if (risk > 30) risk = 'greater than 30';
	else if (risk < 1) risk = 'less than 1';
	else risk = Math.round(risk);
		
	getObj('res').innerHTML = risk;
	
	if (risk == 'less than 1')
		getObj('res2').innerHTML = 'fewer than 1';
	else if (risk == 'greater than 30')
		getObj('res2').innerHTML = 'more than 30';
	else	
		getObj('res2').innerHTML = risk;
		
	getObj('container').style.display='block';
	
	//getObj('debug').innerHTML = calc.printDebug(true);
}


// validation, returns true or false and displays a detailed error message if false.
function _validate() {
	
	if (navigator.appName == "Microsoft Internet Explorer") {

} else {
	//if (!bw.ie || typeof(error) == 'undefined') {
		error = getObj('error');
}
	
	error.innerHTML = '';
	
	dat = getObj('age').value;
	if (dat == '') error.innerHTML += '<li>You have not entered an age</li>';
	else if (dat != parseInt(dat) || parseInt(dat) < 30 || parseInt(dat) > 79) error.innerHTML += '<li>Age value must be between 30 and 79</li>';
	
	dat = getObj('chol').value;
	if (dat == '') error.innerHTML += '<li>You have not entered a total cholesterol value</li>';
	else if (dat != parseFloat(dat) || parseFloat(dat) < (130/38.7) || parseFloat(dat) > (320/38.7)) error.innerHTML += '<li>Total cholesterol value must be between 3.36 and 8.27</li>';
		
	dat = getObj('hdl').value;
	if (dat == '') error.innerHTML += '<li>You have not entered an HDL cholesterol value</li>';
	else if (dat != parseFloat(dat) || parseFloat(dat) < (20/38.7) || parseFloat(dat) > (100/38.7)) error.innerHTML += '<li>HDL cholesterol value must be between 0.52 and 2.59 </li>';
	
	dat = getObj('sbp').value;
	if (dat == '') error.innerHTML += '<li>You have not entered a Systolic BP value</li>';
	else if (dat != parseFloat(dat) || parseFloat(dat) < 90 || parseFloat(dat) > 200) error.innerHTML += '<li>Systolic BP value between must be 90 and 200</li>';
		
	if (error.innerHTML == '') return true;
	else {

		if (error.innerHTML.toLowerCase().lastIndexOf('<li>') > 0)
			error.innerHTML = '<strong>The following errors were encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required fields and resubmit.<br/><br/>';
		else
			error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required field and resubmit.<br/><br/>';
		error.style.display='block';
		return false;
	}
		
}


/**
 * Function to launch the process of displaying the result
 */
function _submit() {
	
	
	if (_validate()) {
		getObj('age').disabled = true;
		getObj('chol').disabled = true;
		getObj('hdl').disabled = true;
		getObj('sbp').disabled = true;
		getObj('hyper').disabled = true;
		getObj('hyper2').disabled = true;
		getObj('smoker').disabled = true;
		getObj('smoker2').disabled = true;
		getObj('male').disabled = true;
		getObj('female').disabled = true;
	
		_calculate();
	}
	else return false;
	
	return true;
}

/**
 * Function to reset the form
 */
function _reset() {
	
	// Re-enables the dropdown list
	// hides the result div
	getObj('container').style.display='none';
	getObj('error').style.display='none';
	
	getObj('age').value = '';
	getObj('chol').value = '';
	getObj('hdl').value = '';
	getObj('sbp').value = '';
	getObj('hyper').checked = true;
	getObj('male').checked = true;
	getObj('smoker').checked = true;
	
	getObj('age').disabled = false;
	getObj('chol').disabled = false;
	getObj('hdl').disabled = false;
	getObj('sbp').disabled = false;
	getObj('hyper').disabled = false;
	getObj('hyper2').disabled = false;
	getObj('smoker').disabled = false;
	getObj('smoker2').disabled = false;
	getObj('male').disabled = false;
	getObj('female').disabled = false;
	
	return false;
}
