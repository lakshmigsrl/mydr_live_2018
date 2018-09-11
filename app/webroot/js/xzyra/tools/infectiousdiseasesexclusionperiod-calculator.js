
/*

+-------------+-------------+------------------------------------------------+
  05/01/06      SEb             Initial Creation of the tool
+-------------+-------------+------------------------------------------------+


COPYRIGHT 2006 - myDr / MIMS Australia / CMP Medica Australia

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
//
// Color Constants - These are used to display results according to a certain color code (replicated in the legend)
///
var _OK 		= "#CCFF99";
var _COND	= '#FFCC99';
var _STOP 	= '#FFCCCC';


//
// Constants for div to be generated ==> these are ids, and thus must match the style cid, however their value is pointless.
///
var _DIV_CONDITION = 'asdjb';
var _DIV_HAVE = 'asasddjb';
var _DIV_CONTACT = 'asasdaddjb';


/**
 * Function to write a div with specified id
 */
function write_div(id) { document.write('<div id="' + id + '"></div>'); }


/**
 * Function to write the legend using the correct color code.
 */
function write_legend() { 
	var legend = Array(
		Array('STOP, don\'t go to school',_STOP),
		Array('OK to go to school',_OK),
		Array('Depends - see criteria',_COND)
	);
	
	document.write('<table style="font-weight:normal;">');
	for ( i = 0; i < legend.length; i++ )
		document.write('<tr><td style="border:1px #222222 solid;background-color:'+legend[i][1]+';"> &nbsp; </td><td>'+legend[i][0]+'</td></tr>');
	document.write('</table>');	
}

//
// The diseases array contains diseases details to be used. 
// Every disease has 3 parts;
//     1. it's name
//     2. Do we go to school if we suffer the condition
//     3. Do we go to school if someone we are in contact with suffers from the condition.
//
// Additionnaly, every entry is an array containing the entry itself in index 0 and the color code to display in index 1.
///
var diseases = Array(
	Array(	
		Array('Amoebiasis (Entamoeba histolytica infection)',	null),
		Array('Yes, until there has not been a loose bowel motion for 24 hours.',	_STOP),
		Array('No',_OK)
		),
	Array(
		Array('Campylobacter infection',	null),			
		Array('Yes, until there has not been a loose bowel motion for 24 hours.',		_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/chickenpox">Chickenpox (varicella)</a>',	null),
		Array('Keep your child away until all blisters have dried. This is usually at least 5 days after the spots first appeared in unimmunised children and less in immunised children.',_STOP),
		Array('No, unless he or she has immune system problems, such as leukaemia, or is receiving chemotherapy. ',_COND)
		),
	Array(
		Array('<a href="/eye-health/conjunctivitis">Conjunctivitis (acute infectious)</a>',	null),
		Array(' Yes, until the discharge from the eyes has stopped.',	_STOP),			
		Array('No',_OK)
		),
	Array(
		Array('Cryptosporidium infection',					null),
		Array('Yes, until there has not been a loose bowel motion for 24 hours. ',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('Cytomegalovirus (CMV) infection',					null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/gastrointestinal-health/diarrhoea">Diarrhoea (No organism identified as the cause)</a>',					null),
		Array('Yes, until there has not been a loose bowel motion for 24 hours',	_STOP),			
		Array('No',_OK)
		),
	Array(
		Array('<a href="/travel-health/diphtheria">Diphtheria</a>',	null),
		Array('Keep your child away until your doctor signs a medical certificate of recovery. Your child must have at least 2 negative throat swabs after antibiotic treatment is finished, to ensure they are fully recovered.',_STOP),
		Array('Yes. All contacts living in same house should stay away from the school until your doctor or another appropriate health authority clears them to return.',_STOP)
		),
	Array(
		Array('Giardiasis',	null),
		Array('Yes, until there has not been a loose bowel motion for 24 hours.',_STOP),
		Array('No',_OK)
	),
	Array(
		Array('<a href="/kids-teens-health/glandular-fever">Glandular fever</a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/respiratory-health/haemophilus-influenzae">Haemophilus influenzae type b (Hib)</a>',	null),
		Array('Yes, until child has received antibiotic treatment for at least 4 days.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/hand-foot-and-mouth-disease">Hand, foot and mouth disease</a>',	null),
		Array('Yes, until all blisters have dried.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/skin-hair/head-lice">Head lice</a>',	null),
		Array('No, if effective treatment is started before the next day at the facility - that means child does not need to be sent home immediately.',_OK),
		Array('No',_OK)
		),
	Array(
		Array('Hepatitis A',	null),
		Array('Yes, until your doctor signs a medical certificate of recovery. Children should stay away until at least 7 days after jaundice begins.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/travel-health/hepatitis-b">Hepatitis B</a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/gastrointestinal-health/hepatitis-c-infection">Hepatitis C</a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/skin-hair/cold-sores-overview">Herpes simplex (\'cold sores\', fever, blisters)</a>',	null),
		Array('If your young child isn\'t able to follow hygiene practices while the cold sore is weeping, then he or she should stay away until it is dry. Cover cold sores with dressings if possible.',_COND),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/sexual-health/hiv-and-aids-12-common-questions-answered">Human immunodeficiency virus (HIV/AIDS)</a>',	null),
		Array('No. However, if the child is severely immunocompromised they will be vulnerable to catching infections from other people.',_OK),
		Array('No',_OK)
		),
	Array(
		Array('Hydatid disease (type of tapeworm)',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/skin-hair/impetigo">Impetigo (school sores)</a>',	null),
		Array('Yes, until antibiotic treatment has begun. Sores on exposed surfaces must be covered with a watertight dressing.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/respiratory-health/influenza-the-flu">Influenza and influenza-like illnesses</a>',	null),
		Array('Stay away until well',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/respiratory-health/legionnaires-disease">Legionnaires\' disease </a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('Leprosy',	null),
		Array('Yes, until your doctor or other health authority gives approval to return. ',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/measles-what-you-need-to-know">Measles</a>',	null),
		Array('Yes, until at least 4 days after the rash begins.',_STOP),
		Array('Not if immunised. Not if he or she gets immunised within 72 hours of contact with an infected person. If not immunised, he or she should stay away until 14 days after the appearance of a rash in the last person to be infected. All immunocompromised children should be excluded until 14 days after the first day of appearance of rash in the last case.',_COND)
		),
	Array(
		Array('<a href="/kids-teens-health/meningitis">Meningitis (bacterial)</a>',	null),
		Array('Yes, until well and has received antibiotics.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/meningitis">Meningitis (viral)</a>',	null),
		Array(' Yes, until well.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/meningococcal-disease">Meningococcal infection</a>',	null),
		Array('Yes, until antibiotic treatment has finished.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('Molluscum contagiosum (skin infection)',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/mumps">Mumps</a>',	null),
		Array('Yes, for 9 days after onset of swelling.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('Norovirus',	null),
		Array('Yes, until there has not been a loose bowel motion or vomiting for 48 hours.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/kids-teens-health/fifth-disease">Parvovirus (erythema infectiosum - \'fifth disease\', \'slapped face disease\') </a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),							
	Array(
		Array('Respiratory syncitial virus (RSV)',	null),
		Array('No',_OK),
		Array('No',_OK)
		),							
	Array(
		Array('Ringworm, tinea',	null),
		Array('Can return the day after treatment has begun.',_COND),
		Array('No',_OK)
		),
	Array(
		Array('Roseola',	null),
		Array('No',_OK),
		Array('No',_OK)
		),	
	Array(
		Array('<a href="/travel-health/ross-river-virus">Ross River virus</a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),	
	Array(
		Array(' Rotavirus infection',	null),
		Array('Yes, until there has not been a loose bowel motion or vomiting for 24 hours ',_STOP),
		Array('No',_OK)
		),	
	Array(
		Array('<a href="/kids-teens-health/rubella">Rubella (German measles)</a>',	null),
		Array('Yes, until fully recovered or can go back 4 days after rash started.',_STOP),
		Array('No (women of childbearing age working at the school should ensure they are immune to the disease or vaccinated against it).',_OK)
		),
	Array(
		Array('Salmonella, shigella infection',	null),
		Array('Yes, until there has not been a loose bowel motion for 24 hours.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/skin-hair/scabies">Scabies</a>',	null),
		Array('Yes, until day after treatment has been started.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('Streptococcal sore throat (including scarlet fever)',	null),
		Array('Yes, until your child has had antibiotics for at least 24 hours, and feels well.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/womens-health/thrush">Thrush (candidiasis)</a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('Toxoplasmosis',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/respiratory-health/tuberculosis">Tuberculosis (TB)</a>',	null),
		Array('Yes, until your doctor or other appropriate health authority issues a medical certificate. ',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/travel-health/typhoid">Typhoid fever (including paratyphoid fever) </a>',	null),
		Array('Yes, until your doctor or other appropriate health authority issues a medical certificate.',_STOP),
		Array('Not excluded unless a public health authority says so. ',_COND)
		),

	Array(
		Array('Viral gastroenteritis (viral diarrhoea)',	null),
		Array('Yes, until there has not been a loose bowel motion or vomiting for 24 hours.',_STOP),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/skin-hair/warts">Warts</a>',	null),
		Array('No',_OK),
		Array('No',_OK)
		),
	Array(
		Array('<a href="/respiratory-health/whooping-cough-overview">Whooping cough (pertussis)</a>',	null),
		Array('Yes, until 5 days after antibiotic treatment has begun, or for 21 days from the start of coughing.',_STOP),
		Array('Contacts living in the same house who have received fewer than 3 doses of pertussis vaccine must stay away until they have had 5 days of antibiotics. If antibiotics have not been taken, these contacts must be excluded for 21 days after their last exposure to the case while the case was infectious.',_STOP)
		),
	Array(
		Array('<a href="/kids-teens-health/threadworms-pinworms">Worms (intestinal)</a>',	null),
		Array('Yes, until treatment has occurred.',_STOP),
		Array('No',_OK)
		)
	);

/**
 * Builds/Display a list of <option> tags using the specified column (col) as a label
 */
function option_col(col) {
	for(i = 0; i < diseases.length; i++)
		document.write('<option value="' + i + '">' + diseases[i][col][0] + '</option>');
}

/**
 * A cross-browser compatible getElementById()
 */
function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

/**
 * END Browser Compatibility;
 */

/**
 * Gets a value in the diseases array.
 */
function get_value(row, col, idx) {
	if (!idx) idx = 0;
	else if (idx > 1) idx = 1;

	return diseases[row][col][idx];	
}

/**
 * Function to display the disease from the array from specified index
 */
function _display(index) {
	if (index == '' || typeof(index) == 'undefined') return false;
	
	// get the 3 divs to display information
	condition = getObj(_DIV_CONDITION);
	have_condition = getObj(_DIV_HAVE);
	contact_condition = getObj(_DIV_CONTACT);

	// write information to the 3 divs
	condition.innerHTML = get_value(index,0);
	have_condition.innerHTML = get_value(index,1);
	contact_condition.innerHTML = get_value(index,2);
	
	// change the backgroundColor from the 2 bottom divs. The color value is from the array.
	 if(bw.dom || bw.ie4) {
	 	have_condition.style.backgroundColor=get_value(index,1,1);
	 	contact_condition.style.backgroundColor=get_value(index,2,1);
     } else if(bw.ns4) {
     	have_condition.style.bgColor=get_value(index,1,1);
     	contact_condition.style.bgColor=get_value(index,2,1);
	}
	
	return true;
}


/**
 * Function to launch the process of displaying the result
 */
function _check() {
	
	value = getObj('disease').value;
	
	if (!_display(value)) return false;
	
	// disables the dropdown list
	getObj('disease').disabled=true;
	// shows the result div
	getObj('resultContainer').style.display='block';
	// displays content in the result div

	return true;	
}

/**
 * Function to reset the form
 */
function _reset() {
	
	// Re-enables the dropdown list
	getObj('disease').disabled=false;
	getObj('disease').value='';
	// hides the result div
	getObj('resultContainer').style.display='none';
	
	return true;
}
