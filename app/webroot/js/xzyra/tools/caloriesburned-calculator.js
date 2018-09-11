/*
WARNING -- Do NOT delete this file without transfering the comments over to the other .js!


This file contains everything to generate the Basal Energy Calculator.
It is exactly the same as for the FamilyGP Version and it should stay this way.


+-------------+-------------+------------------------------------------------+
  09/01/06      SEb             Initial Creation of the tool
+-------------+-------------+------------------------------------------------+


COPYRIGHT 2006 - myDr / MIMS Australia / CMP Medica Australia

*/

/**
 * The following are predefined functions to write the content of the tool.
 * These are meant to make any changes more easy by not having to do it everywhere manually.
 */
var cburn_act = 0;
var cburn_time = 0;
var cburn_rburned = "";
var cburn_phour = 0;


 // simple function to write a div with a specific id
function write_div(id) { document.write('<div id="' + id + '"></div>'); }

// writes the title of the calculator
function write_title(str) { if (str) document.write (str); else document.write('Basal energy expenditure calculator'); }

// write an image - not used directly by the layout
function write_img(src) { document.write('<img alt="Image" src="' + src + '" style="margin:10px;">'); }

// write the body text of the calculator
function write_text() { document.write('<p>Find out how many calories you burn doing different activities. The calculator uses the type of physical activity and your basal metabolic rate to calculate calories burned, so gives a personalised result.</p><p>Knowing roughly how many calories you expend doing different activities can help you with weight loss or maintenance.</p>'); }

// write the form with the HTML objects for the user to insert parameters 
function write_form() {
	write_div('error');
	document.write('<div class="formInput"><div class="ilabel">Gender:</div><label><input type="radio" id="sm" class="contentPrimaryLink" name="s" value="m"/> Male </label>' +
		'<label><input type="radio" name="s" id="sf" value="f"/> Female </label></div>' +
		'<div class="formInput"><div class="ilabel">Height in cm</div><input id="h" pattern="[0-9]*" class="input form-control" type="number" name="h" class="textbox "/></div>' +
		'<div class="formInput"><div class="ilabel">Weight in kg</div><input id="w" type="number" pattern="[0-9]*" class="input form-control" name="w" class="textbox"/></div>' +
		'<div class="formInput"><div class="ilabel">Age(years)</div><input id="a" type="number"pattern="[0-9]*" class="input form-control" name="a" class="textbox"/> </div>' +
		'<div class="formInput"><div class="ilabel">Activity:</div>'+ activity_box() + '</div>' +
		'<div class="formInput"><div class="ilabel">Length of time in minutes</div><input id="time" type="text" pattern="[0-9]*" class="input form-control" name="time" class="textbox" maxlength=3/> </div>');

}

// write the submit and reset buttons
function write_tools(sub_out, sub_over, reset_out, reset_over) { 

if((thisstyle) && (thisstyle != "")) {
document.write('<input type="image" value=" S " src="/'+thisstyle+sub_out+'" onmouseout="this.src=\'/'+thisstyle+sub_out+'\';" onmouseover="this.src=\'/'+thisstyle+sub_over+'\';" onclick="return _submit();" /> <input type="image" value=" R " src="/'+thisstyle+reset_out+'" onmouseout="this.src=\'/'+thisstyle+reset_out+'\';" onmouseover="this.src=\'/'+thisstyle+reset_over+'\';" onclick="return _reset();" />'); 
} else {
document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="return _submit();" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="return _reset();" />') 
}}

// writes the result to an hidden div.
function write_result() {
	document.write('<div id="ResultContent" class="text-left">');
	document.write('  <h2>Calories Burned</h2>');
	document.write('  <div id="age_err" style="margin-bottom: 10px;"></div>');
	document.write('  <p>This is an estimate of the calories (kilocalories) you burn doing a particular activity.</p>');
	document.write('  <div class="rowHolder"><div class="ResultLabel3">Activity: <span class="ResultField"><span id="act" style="border: none;">XX</span></span> </div></div>');
	document.write('  <div class="rowHolder"><div class="ResultLabel3">Time: <span class="ResultField"><span id="t" style="border: none;">XX</span></span></div></div>');
	document.write('        <div class="ResultBottomFiled">');
	document.write('                                <div class="ResultLabel3">Energy burned: </div>');
	document.write('                                <div class="ResultField1"><span id="res" style="border: none;">XX</span></div>');
	document.write('        </div>');
	document.write('                             <div class="rowHolder">');
	document.write('                                <div class="ResultLabel3">Energy burned per hour: </div>');
	document.write('                                <div class="ResultField"><span id="kph" style="border: none;">XX</span></div>');
	document.write('                             </div>');

	document.write('<h3 class="resultLabel"><a class="btnPrintResult" href="#" onclick="print_caloriesburned_result();">Print your results</a></h3>');
	document.write('</div>');
/*
	document.write('<p>     The calculator uses your basal metabolic rate and the MET value (see below) for an activity to calculate calories burned. It does not take into ');
	document.write('account environmental factors, such as running into the wind or up hills, or a person\'s body composition, i.e. the amount of muscle versus ');
	document.write('fat (muscle burns more calories than fat).<br /><br />');
	document.write('The intensity at which you perform the activity will also affect how many calories you burn, however, this is factored in only for activities such as ');
	document.write('cycling or running where the pace can be easily measured.<br /><br />');
	document.write('A MET is a concept used to compare the energy cost of different physical activities. One MET is equivalent to a metabolic rate consuming 1 kilocalorie per ');
	document.write('kg of bodyweight per hour, and is equivalent to your resting metabolic rate that is the energy your body uses to stay functioning at rest. An activity of ');
	document.write('8 METs, such as singles tennis, would use 8 times as much energy as you do at rest. <br /><br />');
	document.write('Find out your <a href="/tools/basal-energy-calculator">Basal Metabolic Rate</a> to see how many calories your body burns at rest.</p>');
*/
}

function write_mydr() { document.write('<h2>myDr Health Information</h2><table><tr><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Health Centres</p><ul><li><a href="/default.asp?Section=nutrition%26weight"><i>myDr</i> Nutrition & Weight Centre</a></li><li><a href="/default.asp?Section=sport%26fitness"><i>myDr</i> Sports & Fitness Centre</a></li></ul><p class="seeAlsoHead2">myDr Health Tools</p><ul><li><a href="basalenergycalc.asp">Basal Metabolic Rate Calculator</a></li><li><a href="bodymass.asp">Body Mass Index (BMI) Calculator</a></li><li><a href="weight.asp">Ideal Weight Calculator</a></li></ul></td></tr></table>');}

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
	
	try {
		h = getObj('h').value;
		w = getObj('w').value;
		a = getObj('a').value;
		time = getObj('time').value;
		getObj('t').innerHTML = time + " minutes";
		act2 = getObj('activity')[getObj('activity').selectedIndex].value;
		activity1 = act2.split("#");
		activity12 = activity1[0];
		mets = activity1[1];
		getObj('act').innerHTML = activity12;

			
		if (getObj('sm').checked) 
			v = 66.5 + (13.75 * w) + (5.003 * h) - (6.775 * a);
		else
			v = 655.1 + (9.563 * w) + (1.85 * h) - (4.676 * a);
			
		v = (v * mets)/24;//gives amount per hour
		v2 = v * 4.184;//gives amount per hour
		getObj('kph').innerHTML = Math.round(v)+" kcal / "+Math.round(v2)+" kJ";

		vres = v*time/60;		
		vres = Math.round(vres);//*1000)/1000;
		reskJ = v2*time/60;		
		reskJ = Math.round(reskJ);
		getObj('res').innerHTML = String(vres)+" kcal / "+String(reskJ)+" kJ";
		//getObj('res').innerHTML = vres;

		cburn_act = activity12;
		cburn_time = time;
		cburn_rburned = String(vres)+" kcal / "+String(reskJ)+" kJ";
		cburn_phour = Math.round(v)+" kcal / "+Math.round(v2)+" kJ";
		//alert(cburn_rburned);
	
		return true;
	
	} catch (e) {
		// this should not happen much really, unless there is a javascript error in the code!
		alert(e.message);
		return false;		
	}
}


// validation, returns true or false and displays a detailed error message if false.
function _validate() {
//alert(navigator.appName);
	if (navigator.appName == "Microsoft Internet Explorer") {

} else {
	//if (!bw.ie || typeof(error) == 'undefined') {
		error = getObj('error');
}
	
	error.innerHTML = '';
	
	if (!getObj('sm').checked && !getObj('sf').checked) error.innerHTML += '<li>You have not entered a gender</li>';
	
	if (getObj('h').value == '') error.innerHTML += '<li>You have not entered your height</li>';
	else if (isNaN(getObj('h').value)) error.innerHTML += '<li>You have not entered a valid height</li>';
		
	if (getObj('w').value == '') error.innerHTML += '<li>You have not entered your weight</li>';
	else if (isNaN(getObj('w').value)) error.innerHTML += '<li>You have not entered a valid weight</li>';
		
	if (getObj('a').value == '') error.innerHTML += '<li>You have not entered your age</li>';
	else if (isNaN(getObj('a').value)) error.innerHTML += '<li>You have not entered a valid age</li>';
	else if (getObj('a').value < 18 || getObj('a').value > 120) error.innerHTML += '<li>Age value must be between 18 and 120.</li>';
	
	if (getObj('activity').selectedIndex <1 ) error.innerHTML += '<li>You have not entered an activity</li>';
	
	if (getObj('time').value == '') error.innerHTML += '<li>You have not entered length of time</li>';
	else if (isNaN(getObj('time').value)) error.innerHTML += '<li>You have not entered a valid length of time</li>';
	

	
	if (error.innerHTML == '') return true;
	else {

		if (error.innerHTML.toLowerCase().lastIndexOf('<li>') > 0)
			error.innerHTML = '<strong>The following errors were encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required fields and resubmit.<br/><br/>';
		else
			error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required field and resubmit.<br/><br/>';
	getObj('time').disabled=false;
	getObj('activiy').disabled=false;
	getObj('w').disabled=false;
	getObj('a').disabled=false;
	getObj('h').disabled=false;
	getObj('sf').disabled=false;
	getObj('sm').disabled=false;
		return false;
	}
		
}


/**
 * Function to launch the process of displaying the result
 */
function _submit() {
	if (_validate() && _calculate()) {

		document.getElementById("beforeResult").style.display = "none";
		document.getElementById("afterResult").style.display = "block";

		getObj('error').style.display='none';
		getObj('container').style.display='block';
	/*	getObj('w').disabled=true;
		getObj('a').disabled=true;
		getObj('h').disabled=true;
		getObj('sf').disabled=true;
		getObj('sm').disabled=true;
		getObj('time').disabled=true;
		getObj('activity').disabled=true;*/
		
	} else {
		getObj('error').style.display='block';
		getObj('container').style.display='none';
	}
	return false;
}

/**
 * Function to reset the form
 */
function _reset() {
	
	// Re-enables the dropdown list
	// hides the result div
	getObj('container').style.display='none';
	getObj('error').style.display='none';
	getObj('time').disabled=false;
	getObj('activity').disabled=false;
	getObj('w').disabled=false;
	getObj('a').disabled=false;
	getObj('h').disabled=false;
	getObj('sf').disabled=false;
	getObj('sm').disabled=false;
	getObj('w').value='';
	getObj('a').value='';
	getObj('h').value='';
	getObj('time').value='';
	getObj('activity')[0].selected = true;
	getObj('sf').checked=false;
	getObj('sm').checked=false;
	
	return false;
}

function activity_box() {
	activity_box = "<select class='dropdowns styled-select' name='activity' id='activity'><option></option>";
	Activities = activity_array();
	ActivityValues = activity_values();
	for (var i = 1; i<=159; i++) {
		activity_box += "<option value='" + Activities[i] + "#" + ActivityValues[i] + "' class='dropdowns' style='z-index:99999;'>" + Activities[i] + "</option>";
	}
	activity_box += "</select>";
	return activity_box;
	
}

function activity_array() {
ActivityArray = new Array();
ActivityArray[1]='Aqua aerobics';
ActivityArray[2]='Athletics, high jump, long jump, triple jump, javelin, pole vault';
ActivityArray[3]='Athletics, shot, discus, hammer';
ActivityArray[4]='Athletics, steeplechase, hurdles';
ActivityArray[5]='Badminton, competitive';
ActivityArray[6]='Badminton, social';
ActivityArray[7]='Baseball';
ActivityArray[8]='Basketball, game';
ActivityArray[9]='Basketball, shooting baskets';
ActivityArray[10]='Bowling';
ActivityArray[11]='Boxing, punching bag';
ActivityArray[12]='Boxing, sparring';
ActivityArray[13]='Calisthenics, heavy, vigorous effort';
ActivityArray[14]='Calisthenics, light or moderate effort';
ActivityArray[15]='Canoeing, rowing, light effort';
ActivityArray[16]='Canoeing, rowing, moderate effort';
ActivityArray[17]='Canoeing, rowing, vigorous effort';
ActivityArray[18]='Carpentry, general';
ActivityArray[19]='Carpentry, rain gutters, fencing';
ActivityArray[20]='Carpentry, sawing hardwood';
ActivityArray[21]='Carpet laying/removal';
ActivityArray[22]='Carrying groceries upstairs';
ActivityArray[23]='Chopping wood';
ActivityArray[24]='Circuit training, general';
ActivityArray[25]='Cleaning gutters';
ActivityArray[26]='Cleaning, house, general';
ActivityArray[27]='Conditioning exercise, health club exercise, general';
ActivityArray[28]='Conditioning exercise, stretching, hatha yoga';
ActivityArray[29]='Cricket [batting, bowling]';
ActivityArray[30]='Cycling, less than 16.1 km/h';
ActivityArray[31]='Cycling, 16.1-19.2 km/h';
ActivityArray[32]='Cycling, 19.3-22.4 km/h';
ActivityArray[33]='Cycling, 22.5-25.6 km/h';
ActivityArray[34]='Cycling, 25.7-30.6 km/h, racing not drafting';
ActivityArray[35]='Cycling, drafting at more than 30.6 km/h, very fast, racing general';
ActivityArray[36]='Cycling, more than 32.2 km/h, racing not drafting';
ActivityArray[37]='Cycling, BMX or mountain';
ActivityArray[38]='Cycling, general';
ActivityArray[39]='Cycling, stationary, 50 watts, very light effort';
ActivityArray[40]='Cycling, stationary, 100 watts, light effort';
ActivityArray[41]='Cycling, stationary, 150 watts, moderate effort';
ActivityArray[42]='Cycling, stationary, 200 watts, vigorous effort';
ActivityArray[43]='Cycling, stationary, 250 watts, very vigorous effort';
ActivityArray[44]='Dancing, aerobic general';
ActivityArray[45]='Dancing, ballet, modern, jazz, tap, jitterbug';
ActivityArray[46]='Dancing, ballroom, slow';
ActivityArray[47]='Dancing, Greek, Middle Eastern, hula, flamenco, belly, swing';
ActivityArray[48]='Diving, springboard or platform';
ActivityArray[49]='Elliptical trainer';
ActivityArray[50]='Fencing';
ActivityArray[51]='Fishing, general';
ActivityArray[52]='Football, competitive';
ActivityArray[53]='Frisbee, general';
ActivityArray[54]='Frisbee, ultimate';
ActivityArray[55]='Gardening, digging';
ActivityArray[56]='Gardening, general';
ActivityArray[57]='Gardening, mowing lawn';
ActivityArray[58]='Gardening, planting trees';
ActivityArray[59]='Gardening, raking lawn';
ActivityArray[60]='Golf, general';
ActivityArray[61]='Gymnastics';
ActivityArray[62]='Handball, team';
ActivityArray[63]='Hockey, field or ice';
ActivityArray[64]='Horseback riding, general';
ActivityArray[65]='Household cleaning, general';
ActivityArray[66]='Household tasks, moderate effort';
ActivityArray[67]='Hunting, general';
ActivityArray[68]='Ice skating';
ActivityArray[69]='Ironing';
ActivityArray[70]='Judo, jujitsu, karate, kickboxing, tae kwan do';
ActivityArray[71]='Kayaking';
ActivityArray[72]='Lacrosse';
ActivityArray[73]='Lawn bowls';
ActivityArray[74]='Motorcross';
ActivityArray[75]='Moving furniture, household items, carrying boxes';
ActivityArray[76]='Orienteering';
ActivityArray[77]='Painting, papering, plastering';
ActivityArray[78]='Pilates';
ActivityArray[79]='Polo';
ActivityArray[80]='Rock climbing, ascending';
ActivityArray[81]='Rock climbing, rappelling';
ActivityArray[82]='Rollerblading';
ActivityArray[83]='Rollerskating';
ActivityArray[84]='Roofing';
ActivityArray[85]='Rowing machine, general';
ActivityArray[86]='Rugby';
ActivityArray[87]='Running, 3 mins 26 secs per km';
ActivityArray[88]='Running, 3 mins 44 secs per km';
ActivityArray[89]='Running, 4 mins 9 secs per km';
ActivityArray[90]='Running, 4 mins 20 secs per km';
ActivityArray[91]='Running, 4 mins 40 secs per km';
ActivityArray[92]='Running, 5 mins per km';
ActivityArray[93]='Running, 5.5 mins per km';
ActivityArray[94]='Running, 6 mins 12 secs per km';
ActivityArray[95]='Running, 7 mins 10 secs per km';
ActivityArray[96]='Running, 7.5 mins per km';
ActivityArray[97]='Running, cross country';
ActivityArray[98]='Running, jog/walk combination';
ActivityArray[99]='Running, up stairs';
ActivityArray[100]='Sailing, competition';
ActivityArray[101]='Sailing, general';
ActivityArray[102]='Scuba diving';
ActivityArray[103]='Sexual activity, light effort';
ActivityArray[104]='Sexual activity, moderate effort';
ActivityArray[105]='Sexual activity, vigorous effort';
ActivityArray[106]='Skateboarding';
ActivityArray[107]='Skiing';
ActivityArray[108]='Skipping, with rope';
ActivityArray[109]='Sledding, tobogganing';
ActivityArray[110]='Snorkelling';
ActivityArray[111]='Snow shoeing';
ActivityArray[112]='Soccer, casual';
ActivityArray[113]='Soccer, competitive';
ActivityArray[114]='Softball';
ActivityArray[115]='Softball, pitching';
ActivityArray[116]='Speed skating competitive';
ActivityArray[117]='Squash';
ActivityArray[118]='Stair-treadmill ergometer, general';
ActivityArray[119]='Step aerobics, high step';
ActivityArray[120]='Step aerobics, low step';
ActivityArray[121]='Stretching';
ActivityArray[122]='Surfing, body or board';
ActivityArray[123]='Sweeping floors, carpets';
ActivityArray[124]='Swimming laps, freestyle, moderate or light effort';
ActivityArray[125]='Swimming laps, freestyle, vigorous';
ActivityArray[126]='Swimming, backstroke';
ActivityArray[127]='Swimming, breaststroke';
ActivityArray[128]='Swimming, butterfly';
ActivityArray[129]='Table tennis [ping pong]';
ActivityArray[130]='Tai chi';
ActivityArray[131]='Tennis, doubles';
ActivityArray[132]='Tennis, general';
ActivityArray[133]='Tennis, singles';
ActivityArray[134]='Touch football';
ActivityArray[135]='Trampoline';
ActivityArray[136]='Vacuuming';
ActivityArray[137]='Volleyball, 6-9 member team';
ActivityArray[138]='Volleyball, beach';
ActivityArray[139]='Volleyball, indoor competitive';
ActivityArray[140]='Walk/run, playing with animals - moderate';
ActivityArray[141]='Walk/run, playing with children - moderate';
ActivityArray[142]='Walking the dog';
ActivityArray[143]='Walking, 3.2 kph';
ActivityArray[144]='Walking, 4.02 kph';
ActivityArray[145]='Walking, 4.82 kph';
ActivityArray[146]='Walking, 5.6 kph';
ActivityArray[147]='Walking, 6.4 kph';
ActivityArray[148]='Walking, 7.24 kph';
ActivityArray[149]='Walking, 8 kph';
ActivityArray[150]='Watching TV, sitting quietly';
ActivityArray[151]='Water aerobics';
ActivityArray[152]='Water jogging';
ActivityArray[153]='Water polo';
ActivityArray[154]='Waterskiiing';
ActivityArray[155]='Weight lifting, light or moderate effort';
ActivityArray[156]='Weight lifting, vigorous effort';
ActivityArray[157]='Wiring, plumbing';
ActivityArray[158]='Wrestling match';
ActivityArray[159]='Yoga, hatha';

return ActivityArray;
}

function activity_values() {
ActivityValue = new Array();
ActivityValue[1]=4;
ActivityValue[2]=6;
ActivityValue[3]=4;
ActivityValue[4]=10;
ActivityValue[5]=7;
ActivityValue[6]=4.5;
ActivityValue[7]=5;
ActivityValue[8]=8;
ActivityValue[9]=4.5;
ActivityValue[10]=3;
ActivityValue[11]=6;
ActivityValue[12]=9;
ActivityValue[13]=8;
ActivityValue[14]=3.5;
ActivityValue[15]=3;
ActivityValue[16]=7;
ActivityValue[17]=12;
ActivityValue[18]=3;
ActivityValue[19]=6;
ActivityValue[20]=7.5;
ActivityValue[21]=4.5;
ActivityValue[22]=7.5;
ActivityValue[23]=6;
ActivityValue[24]=8;
ActivityValue[25]=5;
ActivityValue[26]=3;
ActivityValue[27]=5.5;
ActivityValue[28]=2.5;
ActivityValue[29]=5;
ActivityValue[30]=4;
ActivityValue[31]=6;
ActivityValue[32]=8;
ActivityValue[33]=10;
ActivityValue[34]=12;
ActivityValue[35]=12;
ActivityValue[36]=16;
ActivityValue[37]=8.5;
ActivityValue[38]=8;
ActivityValue[39]=3;
ActivityValue[40]=5.5;
ActivityValue[41]=7;
ActivityValue[42]=10.5;
ActivityValue[43]=12.5;
ActivityValue[44]=6.5;
ActivityValue[45]=4.79999999999999;
ActivityValue[46]=3;
ActivityValue[47]=4.5;
ActivityValue[48]=3;
ActivityValue[49]=7;
ActivityValue[50]=6;
ActivityValue[51]=3;
ActivityValue[52]=9;
ActivityValue[53]=3;
ActivityValue[54]=8;
ActivityValue[55]=5;
ActivityValue[56]=4;
ActivityValue[57]=5.5;
ActivityValue[58]=4.5;
ActivityValue[59]=4.29999999999999;
ActivityValue[60]=4.5;
ActivityValue[61]=4;
ActivityValue[62]=8;
ActivityValue[63]=8;
ActivityValue[64]=4;
ActivityValue[65]=3;
ActivityValue[66]=3.5;
ActivityValue[67]=5;
ActivityValue[68]=7;
ActivityValue[69]=2.29999999999999;
ActivityValue[70]=10;
ActivityValue[71]=5;
ActivityValue[72]=8;
ActivityValue[73]=3;
ActivityValue[74]=4;
ActivityValue[75]=6;
ActivityValue[76]=9;
ActivityValue[77]=3;
ActivityValue[78]=3.5;
ActivityValue[79]=8;
ActivityValue[80]=11;
ActivityValue[81]=8;
ActivityValue[82]=12.5;
ActivityValue[83]=7;
ActivityValue[84]=6;
ActivityValue[85]=7;
ActivityValue[86]=10;
ActivityValue[87]=18;
ActivityValue[88]=16;
ActivityValue[89]=15;
ActivityValue[90]=14;
ActivityValue[91]=13.5;
ActivityValue[92]=12.5;
ActivityValue[93]=11;
ActivityValue[94]=10;
ActivityValue[95]=9;
ActivityValue[96]=8;
ActivityValue[97]=9;
ActivityValue[98]=6;
ActivityValue[99]=15;
ActivityValue[100]=5;
ActivityValue[101]=3;
ActivityValue[102]=7;
ActivityValue[103]=1;
ActivityValue[104]=1.3;
ActivityValue[105]=1.5;
ActivityValue[106]=5;
ActivityValue[107]=7;
ActivityValue[108]=10;
ActivityValue[109]=7;
ActivityValue[110]=5;
ActivityValue[111]=8;
ActivityValue[112]=7;
ActivityValue[113]=10;
ActivityValue[114]=5;
ActivityValue[115]=6;
ActivityValue[116]=15;
ActivityValue[117]=12;
ActivityValue[118]=9;
ActivityValue[119]=10;
ActivityValue[120]=8.5;
ActivityValue[121]=2.5;
ActivityValue[122]=3;
ActivityValue[123]=3.29999999999999;
ActivityValue[124]=7;
ActivityValue[125]=10;
ActivityValue[126]=7;
ActivityValue[127]=10;
ActivityValue[128]=11;
ActivityValue[129]=4;
ActivityValue[130]=4;
ActivityValue[131]=6;
ActivityValue[132]=7;
ActivityValue[133]=8;
ActivityValue[134]=8;
ActivityValue[135]=3.5;
ActivityValue[136]=3.5;
ActivityValue[137]=3;
ActivityValue[138]=8;
ActivityValue[139]=8;
ActivityValue[140]=4;
ActivityValue[141]=4;
ActivityValue[142]=3;
ActivityValue[143]=2.5;
ActivityValue[144]=3;
ActivityValue[145]=3.29999999999999;
ActivityValue[146]=3.79999999999999;
ActivityValue[147]=5;
ActivityValue[148]=6.29999999999999;
ActivityValue[149]=8;
ActivityValue[150]=1;
ActivityValue[151]=4;
ActivityValue[152]=8;
ActivityValue[153]=10;
ActivityValue[154]=6;
ActivityValue[155]=3;
ActivityValue[156]=6;
ActivityValue[157]=3;
ActivityValue[158]=6;
ActivityValue[159]=2.5;

return ActivityValue;
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

function print_caloriesburned_result(){
	var rWindow=window.open('/tools/waist-to-hip-calculator','','width=700, height=800' );
	rWindow.document.write('<html><head><title>Print Results</title>');
	rWindow.document.write('<link href="/css/redesign2011/global.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/redesign2011/netstarter/Styles_Structural.css?refr=005" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/style.css?refr=09" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/patienthandout.css" rel="stylesheet" type="text/css" />');
	rWindow.document.write('<link href="/css/tools/print.css" rel="stylesheet" type="text/css" media="print"/>');
	rWindow.document.write('</head><body style="padding: 20px; height:900px;">');
	rWindow.document.write('<div id="printToolResult">');
	rWindow.document.write('<a href="#" onclick="print(); return false;" id="print-article" style="float: right;">PRINT</a>');
	rWindow.document.write('<a href="/"><img src="/img/mydr2011__printlogo.gif" alt="myDr Header Logo" border="0"><div id="originalurl">Original article: <a href="/tools/calories-burned-calculator">http://www.mydr.com.au/tools/calories-burned-calculator</a></div>');
	rWindow.document.write('<div id="ResultContent" class="caloriesBurnedToolPrint"><strong>Calories Burned Result</strong><br /><br /><div id="age_err" style="margin-bottom: 10px;"></div>');
	rWindow.document.write('  <div class="ResultLabel">Activity</div><div class="ResultField"><span>'+cburn_act+'</span></div>');
	rWindow.document.write('  <div class="ResultLabel">Time</div><div class="ResultField"><span>'+cburn_time+' minutes</span></div>');
	rWindow.document.write('  <div class="ResultBottomFiled">');
	rWindow.document.write('      <div class="ResultLabel3">Kilocalories burned: </div><div class="ResultField1"><span>'+cburn_rburned+'</span></div>');
	rWindow.document.write('  </div>');
	rWindow.document.write('  <div class="ResultLabel">Kilocalories burned per hour</div><div class="ResultField"><span>'+cburn_phour+'</span></div>');
	rWindow.document.write('</div>');
	rWindow.document.write('  <p class="MainCopy" style="clear:both;"></p>');

	rWindow.document.write("<h3>Is the calculator accurate?</h3><p class='MainCopy'>The calculator uses your <a href='/tools/basal-energy-calculator'>basal metabolic rate</a> (how much energy your body burns at rest) and the MET value (see below) for an activity to calculate calories burned. It does not take into account environmental factors, such as running into the wind or up hills, or a person's body composition, i.e. the amount of muscle versus fat (muscle burns more calories than fat).</p><h3>What about exercise intensity?</h3><p class='MainCopy'>The intensity at which you perform the activity will also affect how many calories you burn, however, this is factored in only for activities such as cycling or running where the pace can be easily measured.</p><h3>How many calories to lose a kg of weight?</h3><p class='MainCopy'>To lose <b>1 kg</b> of weight, you need an energy deficit of <b>7500 kcals</b> - assuming that your weight is stable and not increasing. That's equivalent to <b>31,380 kJ</b>.</p><h3>Background information</h3><p class='MainCopy'>1 kilocalorie (kcal) = 1 Calorie = 4.184 kilojoules (kJ)</p><h3>METS</h3><p class='MainCopy'>A MET is a concept used to compare the energy cost of different physical activities. One MET is equivalent to a metabolic rate consuming 1 kilocalorie per kg of bodyweight per hour, and is equivalent to your resting metabolic rate that is the energy your body uses to stay functioning at rest. An activity of 8 METs, such as singles tennis, would use 8 times as much energy as you do at rest.</p>");

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
