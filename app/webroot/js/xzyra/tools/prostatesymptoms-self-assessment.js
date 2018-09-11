var jQ = jQuery.noConflict();
jQ(function() {
	jQ('#resultContainer').hide();
});



var cpr = '<span class="cpr">Reproduced from <a href="http://www.mydr.com.au" target="mydr">www.mydr.com.au</a>. Copyright UBM Medica Australia 2007.</span>';

window.onload = _reset;

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

var r = '';
var lc = Array (
	[0, -1],
	[1, -1],
	[2, -1],
	[3, -1],
	[4, -1],
	[5, -1],
	[6, -1],
	[7, -1]
);
	
var sr = Array (
	['a', '<p>These scores suggest that your urinary symptoms are mild and that they don\'t give you much trouble.</p><p>Mild urinary symptoms don\'t usually require treatment; however, you should discuss the symptoms with your doctor if they get worse.</p>'],
	['b', '<p>These scores suggest that your urinary symptoms are mild, but that they bother you somewhat. Although mild urinary symptoms don\'t usually require treatment, it\'s important to consider the way your symptoms affect you. Your doctor is the best person to talk to regarding how to cope with your symptoms and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['c', '<p>These scores suggest that your urinary symptoms are mild, but that they are disrupting your life. Although mild urinary symptoms don\'t usually require treatment, it\'s important to consider the way your symptoms affect you. Your doctor is the best person to talk to regarding how to cope with your symptoms and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['d', '<p>These scores suggest that your urinary symptoms are moderate, but that they don\'t give you much trouble. Moderate urinary symptoms may or may not need to be treated, this varies from person to person. Several treatment options are available. If you feel that your urinary symptoms are getting more troublesome, your doctor is the best person to talk to regarding how to cope with your symptoms and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['e', '<p>These scores suggest that your urinary symptoms are moderate, and that they are giving you some trouble. Moderate urinary symptoms may or may not need to be treated, this varies from person to person. Several treatment options are available. Your doctor is the best person to talk to regarding how to cope with your symptoms and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['f', '<p>These scores suggest that your urinary symptoms are moderate, and that they are disrupting your life. Moderate urinary symptoms may or may not need to be treated, this varies from person to person. Several treatment options are available. Your doctor is the best person to talk to regarding how to cope with your symptoms and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['g', '<p>These scores suggest that your urinary symptoms are severe, but that they are giving you little trouble. Severe urinary symptoms often benefit from treatment, and several treatment options are available. However, it\'s important to take your feelings about the symptoms into account. Your doctor is the best person to talk to regarding how to cope with your symptoms, the possible complications of an enlarged prostate and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['h', '<p>These scores suggest that your urinary symptoms are severe, and that they are giving you some trouble. Severe urinary symptoms often benefit from treatment, and several treatment options are available. Your doctor is the best person to talk to regarding how to cope with your symptoms, the possible complications of an enlarged prostate and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>'],
	['i', '<p>These scores suggest that your urinary symptoms are severe, and that they are disrupting your life. Severe urinary symptoms often benefit from treatment, and several treatment options are available. Your doctor is the best person to talk to regarding how to cope with your symptoms, the possible complications of an enlarged prostate and the risks and benefits of treatments for an enlarged prostate. Take a print-out of these questionnaire results with you to your doctor to help discuss your symptoms.</p>']
);


function write_img(src) { document.write('<img alt="Image" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }

var intro = '<p>Find out how severe your prostate symptoms are and rate how much they trouble you using this self-assessment based on the International Prostate Symptom Score, a tool often used by doctors. Take your questionnaire results with you to your doctor to help discuss your symptoms.</p>';
intro += '<p>This assessment is designed for men who have already been diagnosed with an enlarged prostate (benign prostatic hyperplasia, BPH). As urinary symptoms can be caused by conditions other than an enlarged prostate, you should always see your doctor in the first instance if you have urinary difficulties.</p>';

function write_text() { document.write(intro); }

function write_form() {

	var questions = Array (
		['0', 'During the past month, how often have you had a sensation that your bladder was not completely empty after you finished urinating?'],
		['1', 'During the past month, how often have you had to urinate twice or more within 2 hours?'],
		['2', 'During the past month, how often has your urine stream stopped and started several times during urination?'],
		['3', 'During the past month, how often have you found it difficult to postpone urination?'],
		['4', 'During the past month, how often has your urinary stream been weak?'],
		['5', 'During the past month, how often have you had to push or strain to start the flow of urine?'],
		['6', 'During the past month, how many times did you typically get up during the night to urinate (from the time you went to bed at night to the time you got up in the morning)?'],
		['7', 'If your urinary condition remained the way it is now for the rest of your life, how would you feel about that?']
	);
	
	var q1 = Array(
	['0','Not at all'],
	['1','Less than one time in 5'],
	['2','Less than half the time'],
	['3','About half the time'],
	['4','More than half the time'],
	['5','Almost always']);
	
	var q2 = Array(
	['0','None'],
	['1','Once'],
	['2','Twice'],
	['3','3 times'],
	['4','4 times'],
	['5','5 times or more']);
	
	var q3 = Array(
	['0','Delighted'],
	['1','Pleased'],
	['2','Mostly satisfied'],
	['3','Mixed - about equally satisfied and dissatisfied'],
	['4','Mostly dissatisfied'],
	['5','Unhappy'],
	['6','Terrible']);
	
	document.write('<b>Please answer the following questions about your urinary symptoms during the past month.</b><br /><br />');
	document.write('<div id="error"></div>');
	
	linkPrimary="contentPrimaryLink";
	for (var q=0;q<questions.length;q++) {
		document.write('<table border="0" width="98%" cellspacing="0" cellpadding="3">');
		document.write('<tr><td colspan=\'2\' align=\'left\' valign=\'top\'><b>' + (q+1) + '. ' + questions[q][1] + '</b></td></tr>');
		
		if (q <= 5) {		
			for(i=0;i<q1.length;i++) {
				document.write('<tr><td class="'+(i%2?'evenrow':'oddrow')+'"><label><input onclick=\'javascript:sm(this);\' class="yes-no '+linkPrimary+'" id="q_' + q + '" name="q_' + q + '" class="yes-no" type="radio" value="' + (parseInt(q1[i][0]) + 1) + '"/><span id="t6_' + q + '_' + i + '">'+q1[i][1]+'</span></label></td></tr>');
				linkPrimary="";
			}		
		} else {
			if (q == 6) {		
				for(i=0;i<q2.length;i++) {
					document.write('<tr><td class="'+(i%2?'evenrow':'oddrow')+'"><label><input onclick=\'javascript:sm(this);\' class="yes-no '+linkPrimary+'" id="q_' + q + '" name="q_' + q + '" class="yes-no" type="radio" value="' + (parseInt(q2[i][0]) + 1) + '"/><span id="t6_' + q + '_' + i + '">'+q2[i][1]+'</span></label></td></tr>');				
					linkPrimary="";
				}
			} else if (q == 7) {		
				for(i=0;i<q3.length;i++) {
					document.write('<tr><td class="'+(i%2?'evenrow':'oddrow')+'"><label><input onclick=\'javascript:sm(this);\' class="yes-no '+linkPrimary+'" id="q_' + q + '" name="q_' + q + '" class="yes-no" type="radio" value="' + (parseInt(q3[i][0]) + 1) + '"/><span id="t7_' + q + '_' + i + '">'+q3[i][1]+'</span></label></td></tr>');				
					linkPrimary="";
				}
			}
		}
		document.write('</table><br />');
	}
}

function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" id=\'sm\' value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="_submit()" /> <input type="image" id=\'rs\' value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="_reset();return false;" />') }

function write_result() { }

function write_mydr() { document.write('<h2>myDr Health Information</h2><table><tr><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Articles</p><ul><li><a href="/default.asp?article=3481">A-Z of <i>myDr</i> articles about prostate cancer and prostate health</a></li><li><a href="/default.asp?article=4168">Animation: Prostate enlargement</a></li></ul></td><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Health Centres</p><ul><li><a href="/default.asp?Section=men%60shealth"><i>myDr</i> Men\'s Health Centre</a></li></ul></td></tr></table>');}

/**
 * A cross-browser compatible getElementById()
 */
function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

/**
 * END Browser Compatibility;
 */

function _validate() {

	var objs = document.getElementsByTagName('input');
	
	for (var i=0; i < lc.length; i++) {
		if (parseInt(lc[i][1]) < 0) return false;
	}

	for (i = 0; i < objs.length; i++) {
		if (objs[i].className == 'yes-no') {
			objs[i].disabled = true;
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
		container = getObj('resultContainer');

}

	if (!_validate()) {

		error.innerHTML = '<li>You have not answered all the questions in the quiz.</li>';
		error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required field(s) and resubmit.<br/><br/>';
		error.style.display = 'block';
		container.style.display = 'none';

		window.scrollTo(0,0);

	} else {

		error.style.display = 'none';
		container.style.display = 'block';
		
		var s = 0;
		var t = 0;
		for (var i=0; i < lc.length - 1; i++) {
			s += parseInt(lc[i][1]);
		}

		t = parseInt(lc[lc.length-1][1]);
		
		r = 
			((s >= 20) && (t >= 5)) ? 'i' :
			((s >= 20) && (t >= 3)) ? 'h' :
			((s >= 20) && (t >= 0)) ? 'g' :
			((s >= 8) && (t >= 5)) ? 'f' :
			((s >= 8) && (t >= 3)) ? 'e' :
			((s >= 8) && (t >= 0)) ? 'd' :
			((s >= 0) && (t >= 5)) ? 'c' :
			((s >= 0) && (t >= 3)) ? 'b' :
			'a';
		var res = '';	
		res += '<h2 class="resultLabel">RESULTS</h2>';
		res += '<div class="resultLevels">';
		res += '	<div class="indication maxWidth">';
		res += '		<div class="label">';
		res += '		Prostate Symptoms Assessment';
		res += '		</div>';
		res += '		<div class="description">';
		res += '			<p>';
		
							for (var i = 0; i < sr.length; i++) {
								if (sr[i][0] == r) {
									res += sr[i][1];
									break;
								}
							}
		res += '			</p>';
		res += '		</div>';
		res += '	</div>';
		res += '</div>';
		
		container.innerHTML = res;
		//getObj('sm').style.display = 'none';
		
		for (var i = 0; i < lc.length; i++) {
			lc[i][1] = -1;
		}
	}
}

/**
 * Function to reset the form
 */
 
function sm(ct) {		
	var ar = ct.name.split('_')[1];
	lc[ar][1] = parseInt(ct.value) - 1;
	var i = ct.id != 'q_7' ? 6 : 7;
	var t = 't' + i + '_' + ct.id.split('_')[1] + '_' + (parseInt(ct.value) -1);
	
	for (var j = 0; j < i; j++) {
		t = 't' + i + '_' + ct.id.split('_')[1] + '_' + j;
		if (j == (parseInt(ct.value)-1)) {
			getObj(t).className = 'bt';
		} else {
			getObj(t).className = 'nt';
		}
	}
}

function _reset() {
	jQ('.yes-no').attr('checked', false);
	jQ('span.bt').addClass('nt');
	jQ('span.nt').removeClass('bt');

	jQ('#error').hide();
	jQ('#resultContainer').hide();
}


function getYesNoValue(name) {

	if (getObj(name+'Y').checked)	return 'y';
	else if (getObj(name+'N').checked)	return 'n';
	else return '';

}

function writeCopyRight() {
	document.write(cpr);
}
