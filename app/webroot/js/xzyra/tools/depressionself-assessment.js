
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


function write_title(str) { if (str) document.write (str); else document.write('Depression self-assessment'); }
function write_div(id) { document.write('<div id="' + id + '"></div>'); }
function write_img(src) { document.write('<img alt="Image" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }
var writeText = '';
writeText += '<p>Take our depression self-assessment to see if you are showing signs and symptoms of depression. This questionnaire cannot diagnose depression, only a doctor can do that, but it can prompt you to seek professional help.</p>';
writeText += '<p>This tool is not suitable for people under 18.</p>';
writeText += '';

var headTool = '';
headTool += '<b>Over the last 2 weeks have you felt or noticed any of the following:</b><br /><br /><b>Select the statements that apply to you.</b><br /><br />';

var qm = Array (
	['dut', 'Depressed, unhappy or tearful'],
	['lip', 'A loss of interest or pleasure in activities']
	);

var q = Array(
	['ctr', 'Constantly tired or "run down"?'],
	['caw', 'Significant changes in your appetite or weight?'],
	['sdd', 'Sleep disturbance, such as difficulty falling asleep, awakening frequently during the night, awakening very early in the morning or sleeping more than usual?'],
	['sms', 'Slowing of your movements or speech, or restlessness?'],
	['pct', 'Poor concentration or thinking; difficulty making decisions?'],
	['fwg', 'Feelings of worthlessness or excessive guilt?'],
	['tds', 'Thoughts of death or suicide?']
	);
	
function write_text() { document.write(writeText); }
function write_form() {

	document.write(headTool);
	document.write('<div id="error"></div><table cellspacing=0 cellpadding="5" class="frmTbl + brTbl" width="100%">');	

	linkPrimary="contentPrimaryLink";
	for(i=0;i<qm.length;i++) {
		document.write('<tr><td class="'+(i%2?'evenrow':'oddrow')+'" style="width:110px"> <label class="yesno"> <input class="yes-no '+linkPrimary+'" id="'+qm[i][0]+'Y" name="'+qm[i][0]+'" class="yes-no" type="radio" value="y"/> Yes </label><label class="yesno">  <input id="'+qm[i][0]+'N" name="'+qm[i][0]+'" type="radio" value="no"/> No </label></td><td class="'+(i%2?'evenrow':'oddrow')+'"><p>'+qm[i][1]+'?</p></td></tr>');
		linkPrimary="";
	}
	
	document.write('</table><table><tr><td height="2px"></td></tr></table><table cellspacing=0 cellpadding="5" class="frmTbl + brTbl" width="100%">');
	
	for(i=0;i<q.length;i++) {		
		document.write('<tr><td class="'+(i%2?'evenrow':'oddrow')+'" style="width:110px"> <label class="yesno"> <input class="yes-no" id="'+q[i][0]+'Y" name="'+q[i][0]+'" class="yes-no" type="radio" value="y"/> Yes </label><label class="yesno"> <input id="'+q[i][0]+'N" name="'+q[i][0]+'" type="radio" value="no"/> No </label></td><td class="'+(i%2?'evenrow':'oddrow')+'"><p>'+q[i][1]+'</p></td></tr>');
	}	

	document.write('</table>');
}
	
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="_submit()" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="_reset();return false;" />') }
function write_result() { }

function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

function _validate() {

	var objs = document.getElementsByTagName('input');
	for (i = 0; i < objs.length; i++) {
		if (objs[i].className == 'yes-no' && getYesNoValue(objs[i].name) == '')
			return false;
	}

	for (i = 0; i < objs.length; i++) {
		if (objs[i].className == 'yes-no') {
			objs[i].disabled = true;
			getObj(objs[i].name + 'N').disabled = true;
		}
	}

	return true;
}

/**
 * Function to launch the process of displaying the result
 */
function _submit() {
if (navigator.appName == "Microsoft Internet Explorer") {

} else {
	//if (!bw.ie || typeof(error) == 'undefined') {
		error = getObj('error');
		container = getObj('container');
}

			
	if (!_validate()) {

		error.innerHTML = '<li>It appears that you have not answered all the questions in the quiz.</li>';
		error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required field and resubmit.<br/><br/>';
		error.style.display = 'block';
		container.style.display = 'none';
		window.scrollTo(0,0);

	} else {

		error.style.display = 'none';
		container.style.display = 'block';

		var risk = false;
		var objs = document.getElementsByTagName('input');

		var y = 0; yy = 0;
		var n = 0; nn = 0;
		var j = -1;
		var headResult = "";
		
		for (i = 0; i < objs.length; i++) {
			if (objs[i].className == 'yes-no') {
				j++;
				if (getYesNoValue(objs[i].name) == 'y') {
					if (j<=1) {	
						yy++;	
						headResult += 'y'; 
					} else {
						y++; 
					}
				}	
				else {
					if (j<=1) {	
						nn++;	
						headResult += 'n';	
					} else {
						n++;
					}
				}
			}
		}
		
		headResult = headResult == 'yy' ? '<b>' + qm[0][1] + "</b> and <b>" + qm[1][1] + '</b>':
									headResult == 'yn' ? '<b>' + qm[0][1] + '</b>':
									headResult == 'ny' ? '<b>' + qm[1][1] + '</b>' : 
																		"<i>not</i> " + '<b>' + qm[0][1] + '</b>' + " and <i>not</i> " + '<b>' + qm[1][1] + '</b>';
		var res = ""; ped = ""; scb = "";
		
		scb += '<table class=\'scbTbl\' border=\'0\' align=\'center\' width=\'95%\'>';
		scb += '<tr><td align=\'left\' valign=\'top\'>';
		scb += '<p class=\'strongbold\'>If you have feelings of wanting to harm yourself or of suicide, please contact a doctor or other healthcare professional immediately.</p></b>';
		scb += '<p class=\'strongbold\'>Alternatively, immediately contact one of the telephone helplines:</b><br />';
		scb += '<li class=\'idnt\'>Lifeline Australia Helpline - 13 11 14 (24 hours, 7 days - local call charge)</li>';
		scb += '<li class=\'idnt\'>SANE Helpline Mon-Fri, 9-5 (EST) ph: 1800 18 SANE (7263)</li>';
		scb += '<li class=\'idnt\'>Kids Help Line 1800 551 800 (24 hours)</li></p>';
		scb += '</td></tr></table>';
		//res += '<table><tr><td align=\'left\'>You are ' + headResult.toLowerCase() + '.</td></tr><tr><td> </td></tr></table>';
		//

									
		//res += '<b> RESULTS</b><br /><br /><table><tr><td><strong>Your score:</strong><td><strong>Yes: </strong>';
		//res += (yy+y) + '</td></tr><tr><td> </td>';
		//res += '<td><strong>No: </strong>' + (nn+n) + '</td></tr></table>';
		res += '<h2 class="resultLabel">Results</h2>';
		res += '<div class="resultLevels">';
		res += '	<div class="indication maxWidth">';
		res += '		<div class="label">';
		res += '			Your score';
		res += '		</div>';
		res += '		<div class="description">';
		res += '			<p>Yes: '+(yy+y)+'</p>';
		res += '		</div>';
		res += '		<div class="description">';
		res += '			<p>No: '+(nn+n)+'</p>';
		res += '		</div>';
		res += '	</div>';
		res += '</div>';

		var cat = yy == 2 && nn == 0 && y >= 4 && y <= 8 ? 'A' :
							yy == 2 && nn == 0 && y >= 0 && y <= 3 ? 'B' :
							yy == 1 && nn == 1 && y == 0 ? 'C' :
							yy == 1 && nn == 1 && y >= 1 && y <= 8 ? 'D' :
							yy == 0 && nn == 2 && y > 0 ? 'E' : 'F';
					
		if (cat == 'A') {
			ped += '<p>You have answered \'yes\' to the first 2 questions which are key features of depression.</p>';
			ped += '<p>You have also answered \'yes\' to having ' + y + ' other signs and symptoms of depression.</p>';
			ped += '<p>A diagnosis of depression is normally made when a person has at least one of the 2 key features of depression in addition to others from the list in the same 2-week period. </p>';
			ped += '<p>As you have symptoms indicative of depression you should seek medical advice as soon as possible. Print this sheet out and make an appointment to talk about it with a doctor as soon as you can. </p>'
		} else if (cat == 'B') {
			ped += '<p>You have answered \'yes\' to the first 2 questions which are key features of depression.</p>';
			ped += '<p>You have also answered \'yes\' to having ' + y + ' other signs and symptoms of depression.</p>';
			ped += '<p>A diagnosis of depression is normally made when a person has at least one of the 2 key features of depression in addition to others from the list in the same 2-week period.</p>';
			ped += '<p>As you have symptoms indicative of depression you should seek medical advice. Print this sheet out and make an appointment to talk about it with a doctor as soon as you can. </p>';
		} else if (cat == 'C') {		
			ped += '<p>You have answered "yes" to one of the first 2 questions, which are key features of depression, and "no" to all of the other questions.</p>';
			ped += '<p>A diagnosis of depression is normally made when a person has at least one of the 2 key features of depression in addition to others from the list in the same 2-week period.</p>';
			ped += '<p>As you have one of the key symptoms indicative of depression you should seek medical advice. Print this sheet out and make an appointment to talk about it with a doctor as soon as you can.</p>';
		}else if (cat == 'D') {
			ped += '<p>You have answered "yes" to one of the first 2 questions, which are key features of depression, and "yes" to ' + (y) + ' of the other questions.</p>';
			ped += '<p>A diagnosis of depression is normally made when a person has at least one of the 2 key features of depression in addition to others from the list in the same 2-week period.</p>';
			ped += '<p>As you have symptoms indicative of depression you should seek medical advice as soon as possible. Print this sheet out and make an appointment to talk about it with a doctor as soon as you can.</p>';
		} else if (cat == 'E') {
			ped += '<p>You have answered \'no\' to the first 2 questions, which are the key features of depression, but \'yes\' to some other questions</p>';
			ped += '<p>A diagnosis of depression is normally made when a person has at least one of the 2 key features of depression in addition to others from the list in the same 2-week period, however, everyone is different.</p>';
			ped += '<p>As you have some symptoms indicative of depression or another medical condition it may be wise to seek medical advice. Print this sheet out and make an appointment to talk about it with a doctor if you are concerned about depression.</p>';
			
			
		} else if (cat == 'F') {
			ped += '<p>You have answered \'no\' to all of these common signs and symptoms of depression.  However, if you are concerned about depression or your mood, talk with your doctor.</p>';
		} else {
			ped = "";
		}

		pedA="";
		pedB="";
		pedA += '<div class="resultLevels">';
		pedA += '	<div class="indication maxWidth">';
		pedA += '		<div class="label">';
		pedA += '		Depression Self-Assessment Result';
		pedA += '		</div>';
		pedA += '		<div class="description">';
		pedA += '			<p>';
		pedB += '			</p>';
		pedB += '		</div>';
		pedB += '	</div>';
		pedB += '</div>';
		ped = pedA + ped + pedB;
		
		ped += scb;

		container.innerHTML = res + ped;
	}
}

/**
 * Function to reset the form
 */
function _reset() {
		var objs = document.getElementsByTagName('input');
		for (i = 0; i < objs.length; i++) {
		if (objs[i].className == 'yes-no') {
			var y = getObj(objs[i].name+'Y');
			var n = getObj(objs[i].name+'N');
			y.checked = false;
			n.checked = false;
			y.disabled = false;
			n.disabled = false;
		}
		getObj('error').style.display='none';
		getObj('container').style.display='none';
	}
}


function getYesNoValue(name) {

	if (getObj(name+'Y') && getObj(name+'Y').checked)	return 'y';
	else if (getObj(name+'N') && getObj(name+'N').checked)	return 'n';
	else return '';

}
