
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
/*
function write_text() {
	document.write('<p>Find out your risk of developing a stroke in the next 10 years.</p>');
	document.write('<p>The calculator estimates your risk using information from a well-known US study called the Framingham Heart Study. You will need to know your systolic blood pressure (the higher of the 2 blood pressure readings).</p>');
	document.write('<p class="indentP">Note that this tool:<ul><li>is not suitable for people who have already suffered a stroke; and</li><li>is only suitable for people aged 55 to 84.</li></ul></p>'); 
}
*/

// write the form with the HTML objects for the user to insert parameters 
function write_form() { 
	
	document.write ('<span style="color:black;font-weight:bold;">Enter your information to find out your risk</span><br/><br/>');
	
	write_div('error'); 
	str = '<div class="fullWidthInputs">';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">Gender</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input type="radio" id="male" name="gender" class="contentPrimaryLink" value="true" /> Male</label><label class="yesno"><input type="radio" id="female" name="gender" value="false"/> Female</label>';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">Age</div>';
	str += '		<div class="inputBox">';
	str += '			<input type="text" pattern="[0-9]*" id="age" class="input" maxlength="2"/> years';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">Systolic blood pressure<br />';
	str += '			<div style="color:#666;font-size:9px;">Your bloox pressure is usually displayed as 2 measurements e.g. 130/90. The higher number is the systolic pressure - here it would be 130.</div>';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<input type="text" pattern="[0-9]*" id="sbp" class="input" maxlength="3"/> mmHg';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">';
	str += '			Are you taking blood pressure medications?';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input id="hyper" type="radio" name="hyper" value="true" /> Yes </label><label class="yesno"><input id="hyper2" type="radio" name="hyper" value="false"/> No </label>';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">';
	str += '			Do you have diabetes?';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input type="radio" id="hasDiabetes" name="diabetes" value="true" /> Yes </label><label class="yesno"><input type="radio" id="noDiabetes" name="diabetes" value="false"/> No </label>';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">';
	str += '			Smoker?';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input type="radio" id="smoker" name="smoker" value="true" /> Yes </label><label class="yesno"><input type="radio" id="smoker2" name="smoker" value="false"/> No </label>';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">';
	str += '			Do you have cardiovascular disease?';
	str += '			<div style="clear: both; color:#666;font-size:9px;">(specifically history of heart attack, angina, coronary insufficiency, congestive heart failure or intermittent claudication - pain or cramping in legs brought on by walking and caused by poor peripheral circulation)</div>';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input type="radio" id="hasCardio" name="cardio" value="true" /> Yes </label><label class="yesno"><input type="radio" id="noCardio" name="cardio" value="false"/> No </label>';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">';
	str += '			Do you have a history of atrial fibrillation (AF)?';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input type="radio" id="hasAf" name="af" value="true" /> Yes </label><label class="yesno"><input type="radio" id="noAf" name="af" value="false"/> No </label>';
	str += '		</div>';
	str += '	</div>';
	str += '	<div class="toolInputs">';
	str += '		<div class="labelBox">';
	str += '			Do you have left ventricular hypertrophy (enlargement of the left ventricle of the heart) that has been confirmed on an electrocardiogram (ECG)?';
	str += '		</div>';
	str += '		<div class="inputBox">';
	str += '			<label class="yesno"><input type="radio" id="hasEcg" name="ecg" value="true" /> Yes </label><label class="yesno"><input type="radio" id="noEcg" name="ecg" value="false"/> No </label>';
	str += '		</div>';
	str += '	</div>';
	str += '</div><!-- fullWidthInputs -->';

	document.write(str);
}

// write the submit and reset buttons
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="return _submit();" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="return _reset();" />') }

// writes the result to an hidden div.
function write_result() { 

	resUp = '<div class="resultLevels">';
	resUp += '	<div class="indication maxWidth">';
	resUp += '		<div class="label">';
	resUp += '			Stroke Risk Test Result';
	resUp += '		</div>';
	resUp += '		<div class="description">';
	resUp += '			<p>';

	resDn = '			</p>';
	resDn += '		</div>';
	resDn += '	</div>';
	resDn += '</div>';
	document.write('<h2 class="resultLabel">Results</h2>');
	document.write('<div id="age_err"></div>');

	document.write(resUp);
	document.write('<p><b>Your risk score</b><br /><br />Your risk score is <span id="res">XX</span> per cent.</p>');
	document.write('<p>This means that <span id="res2">XX</span> of 100 people who have the same risk as you will have a stroke in the next 10 years. The lower your risk score the less likely it is that you will have a stroke in the next 10 years.</p>');
	document.write('<p><b>Average risk score</b><br /><br />The average risk score is <span id="res4">XX</span> per cent.<br /><br />This is the average 10-year probability of <span id="res3">XX</span> years having a stroke. See your doctor if you\'d like to find out ways that you could reduce your risk of stroke.</p><span style="font-weight:normal;color:#444444;"></span>');
	document.write(resDn);

}


/**
 * A cross-browser compatible getElementById()
 */
function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

function getPercentageFromPoints(point, gender) {
	if (gender == "m") {
		return	point <= 0 ? 'less than 3' :
						point > 0 && point <= 2 ? '3' : 
						point <= 4 ? '4' : 
						point <= 6 ? '5' : 
						point == 7 ? '6' : 
						point == 8 ? '7' : 
						point == 9 ? '8' : 
						point == 10 ? '10' : 
						point == 11 ? '11' : 
						point == 12 ? '13' : 
						point == 13 ? '15' : 
						point == 14 ? '17' : 
						point == 15 ? '20' : 
						point == 16 ? '22' : 
						point == 17 ? '26' : 
						point == 18 ? '29' : 
						point == 19 ? '33' : 
						point == 20 ? '37' : 
						point == 21 ? '42' : 
						point == 22 ? '47' : 
						point == 23 ? '52' : 
						point == 24 ? '57' : 
						point == 25 ? '63' : 
						point == 26 ? '68' : 
						point == 27 ? '74' : 
						point == 28 ? '79' : 
						point == 29 ? '84' : 
						point == 30 ? '88' : 'over 88';
	} 
	else {
		return	point <= 0 ? 'less than 1' :
						point > 0 && point <= 2 ? '1' : 
						point <= 5 ? '2' :
						point == 6 ? '3' :
						point <= 8 ? '4' :
						point == 9 ? '5' :
						point == 10 ? '6' :
						point == 11 ? '8' :
						point == 12 ? '9' :
						point == 13 ? '11' :
						point == 14 ? '13' :
						point == 15 ? '16' :
						point == 16 ? '19' :
						point == 17 ? '23' :
						point == 18 ? '27' :
						point == 19 ? '32' :
						point == 20 ? '37' :
						point == 21 ? '43' :
						point == 22 ? '50' :
						point == 23 ? '57' :
						point == 24 ? '64' :
						point == 25 ? '71' :
						point == 26 ? '78' :
						point == 27 ? '84' : 'over 84';
	
	}
}

function getProbability(age, gender) {
	if (gender == "m") {
		return	age > 54 && age < 60 ? '5.9' :
						age < 65 ? '7.8' :
						age < 70 ? '11' :
						age < 75 ? '13.7' :
						age < 80 ? '18' :
						age < 85 ? '22.3' : 'over 22.3';
	}
	else {
		return	age > 54 && age < 60 ? '3' :
						age < 65 ? '4.7' :
						age < 70 ? '7.2' :
						age < 75 ? '10.9' :
						age < 80 ? '15.5' :
						age < 85 ? '23.9' : 'over 23.9';	
	}

}

/**

	1. switch gender
	2. get point for each items
	3. add points
	4. look up
	5. average by age

**/
function _calculate() {

	var points = 0;

		gender					= getObj('male').checked?'m':'f',
		age							= getObj('age').value,
		bp							= getObj('sbp').value,
		hyper						= getObj('hyper').checked?true:false,
		diabetes				= getObj('hasDiabetes').checked?true:false,
		smoker					= getObj('smoker').checked?true:false,
		cardiovascular	= getObj('hasCardio').checked?true:false,
		af							= getObj('hasAf').checked?true:false,
		ecg							= getObj('hasEcg').checked?true:false
		
		if (gender == "m") {
			// add points from age
			points += age > 53 && age < 57 ? 0 : 
								age < 60 ? 1 : 
								age < 63 ? 2 : 
								age < 66 ? 3 : 
								age < 69 ? 4 : 
								age < 73 ? 5 : 
								age < 76 ? 6 : 
								age < 79 ? 7 : 
								age < 82 ? 8 : 
								age < 85 ? 9 : 
								age == 85 ? 10 : 10;								
			
			if (hyper) {
				// add points from hyper
				points += bp > 96 && bp < 106 ? 0 :
								bp < 113 ? 1 :
								bp < 118 ? 2 :
								bp < 124 ? 3 :
								bp < 130 ? 4 :
								bp < 136 ? 5 :
								bp < 143 ? 6 :
								bp < 151 ? 7 :
								bp < 162 ? 8 :
								bp < 177 ? 9 :
								bp < 206 ? 10 : 10;
			} else {								
				// add points drom sbp
				points += bp > 96 && bp < 106 ? 0 :
								bp < 116 ? 1 :
								bp < 126 ? 2 :
								bp < 136 ? 3 :
								bp < 146 ? 4 :
								bp < 156 ? 5 :
								bp < 166 ? 6 :
								bp < 176 ? 7 :
								bp < 186 ? 8 :
								bp < 196 ? 9 :
								bp < 206 ? 10 : 10;
			}
								
			// add points from diabetes
			points += diabetes ? 2 : 0;
			
			// add points from smoking
			points += smoker ? 3 : 0;
			
			// add points from cvd
			points += cardiovascular ? 4 : 0;
			
			// add points from af
			points += af ? 4 : 0;
			
			// add points from lvh
			points += ecg ? 5 : 0;
		}
		else {
			// add points from age
			points += age > 53 && age < 57 ? 0 : 
								age < 60 ? 1 : 
								age < 63 ? 2 : 
								age < 65 ? 3 : 
								age < 68 ? 4 : 
								age < 71 ? 5 : 
								age < 74 ? 6 : 
								age < 77 ? 7 : 
								age < 79 ? 8 : 
								age < 82 ? 9 : 
								age < 85 ? 10 : 10;					
											
			if (hyper) {								
			// add points from hyper
			points += bp > 94 && bp < 107 ? 1 :
								bp < 114 ? 2 :
								bp < 120 ? 3 :
								bp < 126 ? 4 :
								bp < 132 ? 5 :
								bp < 140 ? 6 :
								bp < 149 ? 7 :
								bp < 161 ? 8 :
								bp < 205 ? 9 :
								bp < 217 ? 10 : 10;
			} else {
				// add points drom sbp
				points += bp > 94 && bp < 107 ? 1 :
								bp < 119 ? 2 :
								bp < 131 ? 3 :
								bp < 144 ? 4 :
								bp < 156 ? 5 :
								bp < 168 ? 6 :
								bp < 181 ? 7 :
								bp < 193 ? 8 :
								bp < 205 ? 9 :
								bp < 217 ? 10 : 10;	
			}
								
			// add points from diabetes
			points += diabetes ? 3 : 0;
			
			// add points from smoking
			points += smoker ? 3 : 0;
			
			// add points from cvd
			points += cardiovascular ? 2 : 0;
			
			// add points from af
			points += af ? 6 : 0;
			
			// add points from lvh
			points += ecg ? 4 : 0;
		}
		
		prob1 = getPercentageFromPoints(points, gender);
		prob2 = getProbability(age, gender);
		
		getObj('res').innerHTML = prob1;
		getObj('res2').innerHTML = prob1;
		getObj('res3').innerHTML = gender == 'm' ? 'a man aged ' + age : 'a woman aged ' + age;
		getObj('res4').innerHTML = prob2;
		
		getObj('container').style.display='block';
}


// validation, returns true or false and displays a detailed error message if false.
function _validate() {
	
if (navigator.appName == "Microsoft Internet Explorer") {

} else {
	//if (!bw.ie || typeof(error) == 'undefined') {
		error = getObj('error');
}
	
	error.innerHTML = '';
	



	

	questions = [['male','female'],['hyper', 'hyper2'],['hasDiabetes','noDiabetes'], ['smoker','smoker2'], ['hasCardio','noCardio'], ['hasAf','noAf'], ['hasEcg','noEcg']];
	nullcount = false;
	for (var i=0; i < questions.length; i++) {
	thisquestion = questions[i];
		if ((getObj(thisquestion[0]).checked == false)&& (getObj(thisquestion[1]).checked == false)) {
			nullcount = true;
		}
		
	}	
if (nullcount != false) error.innerHTML += '<li>You have not answered all the questions.</li>';

	tmpG = getObj('male').checked?'m':'f';
	// check age ranges
	dat = getObj('age').value;
	if (dat == '') error.innerHTML += '<li>You have not entered an age</li>';
	else if (tmpG == 'm') {
		if (dat != parseInt(dat) || parseInt(dat) < 55 || parseInt(dat) > 84) error.innerHTML += '<li>Age value must be between 55 and 84</li>';
	} else {
		if (dat != parseInt(dat) || parseInt(dat) < 55 || parseInt(dat) > 84) error.innerHTML += '<li>Age value must be between 55 and 84</li>';
	}	
	
		// check systolic blood pressure	
	dat = getObj('sbp').value;
	if (dat == '') error.innerHTML += '<li>You have not entered a Systolic blood pressure value</li>';
	else if (tmpG == 'm') {
	if (dat != parseFloat(dat) || parseFloat(dat) < 97 || parseFloat(dat) > 205) error.innerHTML += '<li>Systolic Blood Pressure value must be between 97 and 205</li>';
	} else {
	if (dat != parseFloat(dat) || parseFloat(dat) < 95 || parseFloat(dat) > 216) error.innerHTML += '<li>Systolic Blood Pressure value must be between 95 and 216</li>';
	}
	
	
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
		getObj('sbp').disabled = true;
		getObj('hyper').disabled = true;
		getObj('hyper2').disabled = true;
		getObj('hasDiabetes').disabled = true;
		getObj('noDiabetes').disabled = true;
		getObj('smoker').disabled = true;
		getObj('smoker2').disabled = true;
		getObj('hasCardio').disabled = true;
		getObj('noCardio').disabled = true;
		getObj('hasAf').disabled = true;
		getObj('noAf').disabled = true;
		getObj('hasEcg').disabled = true;
		getObj('noEcg').disabled = true;
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
	getObj('sbp').value = '';
	getObj('male').checked = false;
	getObj('hyper').checked = false;
	getObj('hasDiabetes').checked = false;
	getObj('smoker').checked = false;
	getObj('hasCardio').checked = false;
	getObj('hasAf').checked = false;
	getObj('hasEcg').checked = false;
	getObj('female').checked = false;
	getObj('hyper2').checked = false;
	getObj('noDiabetes').checked = false;
	getObj('smoker2').checked = false;
	getObj('noCardio').checked = false;
	getObj('noAf').checked = false;
	getObj('noEcg').checked = false;
	
	getObj('age').disabled = false;
	getObj('sbp').disabled = false;
	getObj('hyper').disabled = false;
	getObj('hyper2').disabled = false;
	getObj('hasDiabetes').disabled = false;
	getObj('noDiabetes').disabled = false;
	getObj('smoker').disabled = false;
	getObj('smoker2').disabled = false;
	getObj('hasCardio').disabled = false;
	getObj('noCardio').disabled = false;
	getObj('hasAf').disabled = false;
	getObj('noAf').disabled = false;
	getObj('hasEcg').disabled = false;
	getObj('noEcg').disabled = false;
	getObj('male').disabled = false;
	getObj('female').disabled = false;

	return false;
}
