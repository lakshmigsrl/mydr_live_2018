
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

function write_div(id) { document.write('<div id="' + id + '"></div>'); }
function write_img(src) { document.write('<img alt="Image" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }
function write_text() { document.write('<p>Take this quick test to determine whether you have any factors that may increase your risk of developing bowel cancer. But bear in mind that this risk test can\'t tell you whether you\'ll get bowel cancer or not - it can only determine whether your risk is higher than average.</p><p>Note that this risk test is suitable only for people who do not have any symptoms. If you have experienced symptoms such as a persistent change in your bowel habits, bleeding from your rectum (back passage) or blood in your stool, abdominal pain or bloating, or unexplained weight loss or tiredness, you should see your doctor as soon as possible.</p>'); }
function write_form() {

	document.write('<div id="error"></div><table cellspacing=0 cellpadding="7">');

	var q = Array(
	['age','Are you over the age of 50?</p>'],
	['weight','Are you overweight or obese (body mass index greater than 25 and 30 respectively)?<br/><br /><a href="/tools/bmi-calculator">Work out your body mass index with our BMI calculator</a><br /></p>'],
	['activity','Do you generally get less than 30 minutes of moderate-intensity physical activity on all or most days of the week?</p>'],
	['fatdiet','Is your diet relatively high in fat, especially saturated fat from animal sources?</p>'],
	['meat','Do you eat more than 2-3 servings of red meat per week (one serving is approximately the size of a deck of cards)?</p>'],
	['calcium','Is your diet low in calcium (less than 1000-1300 mg per day)?</p>'],
	['fruit','Do you eat fewer than 2 servings of fruit and 5 servings of vegetables each day?</p>'],
	['drinks','Do you drink more than 1-2 standard drinks of alcohol per day?</p>'],
	['smoke','Do you smoke?</p>'],
	['family','Has anyone in your immediate family (parent, brother, sister or child) been diagnosed with bowel cancer or non-cancerous polyps?</p>'],
	['polyps','Have you ever had non-cancerous polyps removed from your bowel?</p>'],
	['cancerpast','Have you ever been treated for bowel cancer?</p>'],
	['boweldisease','Do you have inflammatory bowel disease (ulcerative colitis or Crohn?s disease)?</p>'],
	['diabetes','Do you have diabetes?'],
	['jew','Are you Jewish and of Eastern European descent?</p>']
	);

	linkPrimary = "contentPrimaryLink";
	for(i=0;i<q.length;i++){
		document.write('<tr><td class="'+(i%2?'evenrow':'oddrow')+'"><p>'+(i+1)+'. '+q[i][1]+'</td><td class="'+(i%2?'evenrow':'oddrow')+'" style="width:110px"><label class="yesno"><input class="yes-no '+linkPrimary+'" id="'+q[i][0]+'Y" name="'+q[i][0]+'" class="yes-no" type="radio" value="y"/> Yes </label><label class="yesno"><input id="'+q[i][0]+'N" name="'+q[i][0]+'" type="radio" value="no"/> No </label></td></tr>');
		linkPrimary = "";
	}

	document.write('</table>');
}
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="_submit()" /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="_reset();return false;" />') }
function write_result() { }
function write_mydr() { document.write('<h2>myDr Health Information</h2><table><tr><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Articles</p><ul><li><a href="/default.asp?article=3731">Boost your calcium intake to prevent osteoporosis</a></li><li><a href="/default.asp?article=3483">A-Z of <i>myDr</i> articles on osteoporosis</a></li></ul></td><td style="vertical-align:top;"><p class="seeAlsoHead2">myDr Health Centres</p><ul><li><a href="/default.asp?section=women%60shealth"><i>myDr</i> Women\'s Health Centre</a></li></ul></td></tr></table>');}

/**
 * A cross-browser compatible getElementById()
 */
function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

/**
 * END Browser Compatibility;
 */

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

	if (!_validate()) {

		error.innerHTML = '<li>It appears that you have not answered all the questions in the quiz.</li>';
		error.innerHTML = '<strong>The following error was encountered:</strong><ul>'+error.innerHTML+'</ul>Please enter data in the required field and resubmit.<br/><br/>';
		error.style.display = 'block';
		resultContainer.style.display = 'none';
		window.scrollTo(0,0);

	} else {

		error.style.display = 'none';
		resultContainer.style.display = 'block';

		var risk = false;
		var objs = document.getElementsByTagName('input');

		var y = 0;
		var n = 0;
		var na = 0;
		for (i = 0; i < objs.length; i++) {
			if (objs[i].type == 'radio') {
				//alert(objs[i].className);
				if((" "+objs[i].className+" ").indexOf(" "+"yes-no"+" ") > -1){
					if (getYesNoValue(objs[i].name) == 'y'){
						y++;
					}else if (getYesNoValue(objs[i].name) == 'n'){
						n++;
					}else{
						na++;
					}
				}
			}
		}

		//var res = '<table><tr><td><strong>Your score:</strong><td><strong>Yes: </strong>'+y+'</td></tr><tr><td> </td><td><strong>No: </strong>'+n+'</td></tr></table>';

		var res = '<h2 class="resultLabel">RESULTS</h2>';
		res += '<div class="resultLevels">';
		res += '	<div class="indication maxWidth">';
		res += '		<div class="label">';
		res += '			Your score';
		res += '		</div>';
		res += '		<div class="description">';
		res += '			<p>Yes: '+y+'</p>';
		res += '		</div>';
		res += '		<div class="description">';
		res += '			<p>No: '+n+'</p>';
		res += '		</div>';
		res += '	</div>';
		res += '</div>';

		resUp = '<div class="resultLevels">';
		resUp += '	<div class="indication maxWidth">';
		resUp += '		<div class="label">';
		resUp += '			Bowel Cancer Risk Result';
		resUp += '		</div>';
		resUp += '		<div class="description">';
		resUp += '			<p>';

		resDn = '			</p>';
		resDn += '		</div>';
		resDn += '	</div>';
		resDn += '</div>';

		if ( na > 0 ) {
			resultContainer.innerHTML = '<strong>You must answer <span style="color: red">Yes</span>/<span style="color: red">No</span> to all of the questions above...</strong>';
		}else if ( y > 0 ) {
			resultContainer.innerHTML = res + resUp + '<p>The factors mentioned in this test are risk factors for bowel cancer. You have answered "yes" to '+(y==1?'one':y)+' of these questions, which means your risk of developing bowel cancer may be higher than average. However, there are several steps you can take to reduce your risk. </p>'
																+ '<p>By adopting a healthy lifestyle that includes regular exercise and a healthy diet, you can reduce your chances of developing bowel cancer. Also, regular screening (testing in people who do not have any symptoms) has been found to effectively prevent bowel cancer by detecting polyps before they become cancerous and to reduce bowel cancer deaths by finding cancers at an early stage, when treatment is most effective.</p>'
																+ '<p>For most people, a screening test known as a faecal occult blood test should be done once every 1-2 years after the age of 50. Certain people with an above-average risk may need to start having screening tests earlier than this, and attend for screening tests more frequently. People at higher risk may also require different screening tests, such as regular colonoscopy.</p>'
																+ '<p>Your doctor can formally assess your risk and advise you on which screening tests are appropriate, as well as how to reduce some of your risk factors for bowel cancer.</p>' + resDn;
		} else {
			resultContainer.innerHTML = res + resUp +'<p>You answered ?no? to all 15 questions.</p><p>You have indicated that you do not have any of the above risk factors for bowel cancer. However, for most people, a test known as a faecal occult blood test should be done once every 1-2 years after the age of 50. The Gut Foundation recommends that screening should be started slightly earlier than this, and suggests annual faecal occult blood tests from the age of 40. '
																+ 'Screening tests (testing in people without symptoms) help prevent bowel cancer by detecting polyps before they become cancerous, and reduce bowel cancer deaths by finding cancers at an early stage, when treatment is most effective.</p>'
																+ '<p>Talk to your doctor to find out more about faecal occult blood tests and other available screening options. And remember, although bowel cancer is not completely preventable, it is thought that a healthy lifestyle, including regular exercise and a healthy diet, may prevent up to 75 per cent of bowel cancer cases.</p>' + resDn;
		}



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
		getObj('resultContainer').style.display='none';
	}
}


function getYesNoValue(name) {

	if (getObj(name+'Y').checked)	return 'y';
	else if (getObj(name+'N').checked)	return 'n';
	else return '';

}
