var jQ = jQuery.noConflict();
jQ(function() {
	jQ('#resultContainter').hide();
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

// init data


var arrInfant = Array(
                       Array(  // boy             
                         Array(1, 4.4, 2000),
                         Array(2, 5.3, 2400),
                         Array(3, 6.0, 2400),
                         Array(4, 6.7, 2400),
                         Array(5, 7.3, 2500),
                         Array(6, 7.9, 2700),
                         Array(7, 8.4, 2800),
                         Array(8, 8.9, 3000),
                         Array(9, 9.3, 3100),
                         Array(10, 9.7, 3300),
                         Array(11, 10.0, 3400),
                         Array(12, 10.3, 3500),
                         Array(15, 11.1, 3800),
                         Array(18, 11.7, 4000),
                         Array(21, 12.2, 4200),
                         Array(24, 12.7, 4400)
                       ),
                       Array(  // girl             
                         Array(1, 4.2, 1800),
                         Array(2, 4.9, 2100),
                         Array(3, 5.5, 2200),
                         Array(4, 6.1, 2200),
                         Array(5, 6.7, 2300),
                         Array(6, 7.2, 2500),
                         Array(7, 7.7, 2500),
                         Array(8, 8.1, 2700),
                         Array(9, 8.5, 2800),
                         Array(10, 8.9, 3000),
                         Array(11, 9.2, 3100),
                         Array(12, 9.5, 3200),
                         Array(15, 10.3, 3500),
                         Array(18, 11.0, 3800),
                         Array(21, 11.6, 4000),
                         Array(24, 12.1, 4200)
                       )
);

var arrChild = Array (   
                     Array(        // boy
                       Array(3, 14.3, '0.95', 3400, 4200, 4900, 5600, 6300, 6900, 7600),
                       Array(4, 16.2, '1.02', 3600, 4400, 5200, 5900, 6600, 7300, 8100),
                       Array(5, 18.4, '1.09', 3800, 4700, 5500, 6200, 7000, 7800, 8500),
                       Array(6, 20.7, '1.15', 4100, 5000, 5800, 6600, 7400, 8200, 9000),
                       Array(7, 23.1, '1.22', 4300, 5200, 6100, 7000, 7800, 8700, 9500),
                       Array(8, 25.6, '1.28', 4500, 5500, 6400, 7300, 8200, 9200, '10,100'),
                       Array(9, 28.6, '1.34', 4800, 5900, 6800, 7800, 8800, 9700, '10,700'),
                       Array(10, 31.9, '1.39', 5100, 6300, 7300, 8300, 9300, '10,400', '11,400'),
                       Array(11, 35.9, '1.44', 5400, 6600, 7700, 8800, 9900, '11,000', '12,000'),
                       Array(12, 40.5, '1.49', 5800, 7000, 8200, 9300, '10,500', '11,600', '12,800'),
                       Array(13, 45.6, '1.56', 6200, 7500, 8700, '10,000', '11,200', '12,400', '13,600'),
                       Array(14, 51.0, '1.64', 6600, 8000, 9300, '10,600', '11,900', '13,200', '14,600'),
                       Array(15, 56.3, '1.70', 7000, 85000, 9900, '11,200', '12,600', '14,000', '15,400'),
                       Array(16, 60.9, '1.74', 7300, 8900, '10,300', '11,800', '13,200', '14,700', '16,200'),
                       Array(17, 64.6, '1.75', 7600, 9200, '10,700', '12,200', '13,700', '15,200', '16,700'),
                       Array(18, 67.2, '1.76', 7700, 9400, '10,900', '12,500', '14,000', '15,600', '17,100')
                     ),
                     Array(      //girl
                       Array(3, 13.9, '0.94', 3200, 3900, 4500, 5300, 5800, 6400, 7100),
                       Array(4, 15.8, '1.01', 3400, 4100, 4800, 5500, 6100, 6800, 7500),
                       Array(5, 17.9, '1.08', 3600, 4400, 5100, 5700, 6500, 7200, 7900),
                       Array(6, 20.2, '1.15', 3800, 4600, 5400, 6100, 6900, 7600, 8400),
                       Array(7, 22.8, '1.21', 4000, 4900, 5700, 6500, 7300, 8100, 8900),
                       Array(8, 25.6, '1.28', 4200, 5200, 6000, 6900, 7700, 8600, 9400),
                       Array(9, 29.0, '1.33', 4500, 5500, 6400, 7300, 8200, 9100, '10,000'),
                       Array(10, 32.9, '1.38', 4700, 5700, 6700, 7600, 8500, 9500, '10,400'),
                       Array(11, 37.2, '1.44', 4900, 6000, 7000, 8000, 9000, '10,000', '11,000'),
                       Array(12, 41.6, '1.51', 5200, 6400, 7400, 8500, 9500, '10,600', '11,600'),
                       Array(13, 45.8, '1.57', 5500, 6700, 7800, 8900, '10,000', '11,100', '12,200'),
                       Array(14, 49.4, '1.60', 5700, 6900, 8100, 9200, '10,300', '11,500', '12,600'),
                       Array(15, 52.0, '1.62', 5800, 7100, 8200, 9400, '10,600', '11,700', '12,900'),
                       Array(16, 53.9, '1.63', 5900, 7200, 8400, 9500, '10,700', '11,900', '13,100'),
                       Array(17, 55.1, '1.63', 5900, 7200, 8400, 9600, '10,800', '12,000', '13,200'),
                       Array(18, 56.2, '1.63', 6000, 7300, 8500, 9700, '10,900', '12,100', '13,300')
                     )
);


    

/**
 * The following are predefined functions to write the content of the tool.
 * These are meant to make any changes more easy by not having to do it everywhere manually.
 */
 // simple function to write a div with a specific id
function write_div(id) { document.write('<div id="' + id + '"></div>'); }

// writes the title of the calculator
function write_title(str) { if (str) document.write (str); else document.write('Infant and Child Energy Requirements Caculator'); }

// write an image - not used directly by the layout
function write_img(src) { document.write('<img alt="Child Energy Requirement Calculator" src="' + src + '" style="margin:10px;width:86px;height:86px;">'); }

// write the body text of the calculator
function write_text() { document.write('<p>Find out the estimated energy requirement (EER) for infants, children and adolescents. The estimated energy requirement is defined as the average dietary energy intake that will maintain energy balance in a healthy person of a given gender, age, weight, height, and physical activity level. The EERs for children take into account the energy that is needed for growth.</p>'); }

// write the form with the HTML objects for the user to insert parameters 
function write_form() { write_div('error'); document.write(frmCnt); }

// write the submit and reset buttons
function write_tools(sub_out, sub_over, reset_out, reset_over) { document.write('<tr><td align="center"><input type="image" value=" S " src="'+sub_out+'" onmouseout="this.src=\''+sub_out+'\';" onmouseover="this.src=\''+sub_over+'\';" onclick="return _submit();" id=\'btnSubmit\' name=\'btnSubmit\' /> <input type="image" value=" R " src="'+reset_out+'" onmouseout="this.src=\''+reset_out+'\';" onmouseover="this.src=\''+reset_over+'\';" onclick="return _reset();" id=\'btnReset\' name=\'btnReset\'/></td></tr></table>') }

// writes the result to an hidden div.
function write_result(cnts) {
  var toWrite = cnts == 'infant' ? cnt1 : cnt2;
  document.write(toWrite);
}

function ageSelect(ageType) {
  switch (ageType) {
    case 'infant':
      EnableInfant(true);
      EnableYoung(false);
      break;
    case 'young':
      EnableInfant(false);
      EnableYoung(true);    
      break;
  } 
}

function EnableInfant(bl) {
  getObj('infant').selectedIndex = !bl ? 0 : getObj('infant').selectedIndex;
}

function EnableYoung(bl) {
  getObj('young').selectedIndex = !bl ? 0 : getObj('young').selectedIndex;
  getObj('pal').selectedIndex = !bl ? 0 : getObj('pal').selectedIndex;
  getObj('pal').disabled = !bl ? true : false;
}

  function calculateResult() {
    var arrLength = 0;
    
    if (pl <= 0) {
      var a = getObj('infant')[getObj('infant').selectedIndex].value;
      var b = gd == 'm' ? 0 : 1;
          
      arrLength = b == 0 ? arrInfant[0].length - 1 : arrInfant[1].length - 1;
      
      for (i = 0; i <= arrLength; i++) {
        if (arrInfant[b][i][0] == a) {
          getObj('spRlstWeightInfant').innerHTML = arrInfant[b][i][1];
          getObj('res1').innerHTML = arrInfant[b][i][2];
        }
      }
    } else {
      var a = getObj('young')[getObj('young').selectedIndex].value;
      var b = gd == 'm' ? 0 : 1;
      var c = pl == 1.2 ? 4 : pl == 1.4 ? 5 : pl == 1.6 ? 6 : pl == 1.8 ? 7 : pl == 2.0 ? 8 : 9;
      
      arrLength = b == 0 ? arrChild[0].length - 1 : arrChild[1].length - 1;
      
      for (i = 0; i <= arrLength; i++) {
        if (arrChild[b][i][0] == a) {
          getObj('spRlstWeightYoung').innerHTML = arrChild[b][i][1];
          getObj('spRlstHeightYoung').innerHTML = arrChild[b][i][2];
          getObj('spRlstBasalYoung').innerHTML = arrChild[b][i][3];
          getObj('res2').innerHTML = arrChild[b][i][c];     
          getObj('res3').innerHTML = getObj('pal')[getObj('pal').selectedIndex].text;
        }
      }
    }
  }
  
  function _reset() {
    getObj("error").innerHTML = '';
    getObj('error').style.display = 'none';
    getObj('container1').style.display = 'none';
    getObj('container2').style.display = 'none';
    getObj('sm').checked = false;
    getObj('sf').checked = false;
    getObj('infant').selectedIndex = 0;
    getObj('young').selectedIndex = 0;
    getObj('pal').disabled = true;
    getObj('pal').selectedIndex = 0;
    getObj('res1').innerHTML = getObj('res2').innerHTML = getObj('res3').innerHTML = '';
    
    enableForm();
  }
  
  var gd, ag, it, pl, error;
  
  function _submit() {
    getObj('container1').style.display = 'none';
    getObj('container2').style.display = 'none';
    getObj("error").innerHTML = "";
    var formValid = formValidation();
    
    if (!formValid) {
      return false;
    }
    
    disableForm();
    
    gd = getObj("sm").checked ? "m" : "f";
    DisplayContainer(getObj('pal').selectedIndex);

    var tmpAg = ' ' + ag + ' ';
    tmpAg += pl > -1 ? 'years' : ag <= 1 ? 'month' : 'months';
    
    getObj('spRlstAgeInfant').innerHTML = getObj('spRlstAgeYoung').innerHTML = tmpAg;
    getObj('spRlstGenderInfant').innerHTML = getObj('spRlstGenderYoung').innerHTML = gd == 'm' ? 'male' : 'female';
    
    calculateResult();
  }
  
  function DisplayContainer(cont) {
    jQ('#resultContainer').show();
    if (cont <= 0) {
      getObj('container1').style.display = 'block';
      ag = getObj('infant')[getObj('infant').selectedIndex].value;
      pl = -1;
    } else {
      getObj('container2').style.display = 'block';
      ag = getObj('young')[getObj('young').selectedIndex].value;
      pl = getObj('pal')[getObj('pal').selectedIndex].value;
    }
  }
  
  function formValidation() {
    if (!bw.ie || typeof(error) == 'undefined')
      error = getObj('error');
      
    var result = true;
    

    if (!getObj("sm").checked && !getObj("sf").checked) { 
      result = false;
      error.innerHTML += '<li>You have not selected a gender</li>';
    }
    
    if ((getObj('infant').selectedIndex <= 0) && (getObj('young').selectedIndex <= 0)) {
      result = false;
      error.innerHTML += '<li>You have not selected age either for "Infant and young children" or "Children and adolescents"</li>';     
    }
    
    if (getObj('young').selectedIndex > 0) {
      if (getObj('pal').selectedIndex <= 0) {
        result = false;
        error.innerHTML += '<li>You have not selected Physical Activity Level</li>';
      }
    }
    
    error.style.display = 'inline';    
    return result;    
  }
  
  function disableForm() {
    getObj("sm").disabled = true;
    getObj("sf").disabled = true;
    getObj("infant").disabled = true;
    getObj("young").disabled = true;
    getObj("pal").disabled = true;
    //getObj("btnSubmit").style.display = 'none';
  }
  
  function enableForm() {
    getObj("sm").disabled = false;
    getObj("sf").disabled = false;
    getObj("infant").disabled = false;
    getObj("young").disabled = false;
    getObj("pal").disabled = false;
    getObj("btnSubmit").style.display = 'inline';
  }

/**
 * A cross-browser compatible getElementById()
 */
function getObj(id) { return bw.dom?document.getElementById(id):bw.ie4?document.all[id]:bw.ns4?document.layers[id]:null; }

/**
 * END Browser Compatibility;
 */
 
var foot = '';
foot += "<p><i>Source: </i>Australian Government Department of Health and Ageing and National Health and Medical Research Council. <i>Nutrient Reference Values for Australia and New Zealand Including Recommended Dietary Intakes.</i> 2006. Endorsed by the NHMRC on 9 September 2005.</p>";
 
var cnt1 = '';
cnt1 += "<b>Infant and Young Children Energy Requirements</b></p>";
cnt1 += "<p>Estimated Energy Requirement is <span id=\"res1\">XX</span> kilojules per day.</p>";
cnt1 += "<p>";
cnt1 += "	<b>Age</b>: <span id=\"spRlstAgeInfant\"></span><br />";
cnt1 += "	<b>Gender</b>: <span id=\"spRlstGenderInfant\"></span><br />";
cnt1 += "	<b>Reference weight</b>: <span id=\"spRlstWeightInfant\"></span>";
cnt1 += "</p>";
cnt1 += "<div class='fullLevel'>";
cnt1 += "	<div class='description'>";
cnt1 += "		<p>The Estimated Energy Requirement takes into account the energy needed for growth based on the 50<font class=\"txtSuper\">th</font>";
cnt1 += "		centile for weight gain at various ages. Physical activity levels are not used in calculating the requirements of infants.</p>";
cnt1 += "	</div>";
cnt1 += "</div>";
//cnt1 += foot;

var cnt2 = '';
cnt2 += "<p><b>Children and Adolescents Energy Requirements</b></p>";
cnt2 += "<p>Estimated Energy Requirement is <span id=\"res2\">XX</span> kilojules per day.</p>";
cnt2 += "<p><b>Age:   </b><span id=\"spRlstAgeYoung\"></span>";
cnt2 += "<br /><b>Gender:   </b><span id=\"spRlstGenderYoung\"></span><br />";
cnt2 += "<b>Physical Activity Level:   </b><span id=\"res3\">XX</span><br />";
cnt2 += "<b>Reference weight</b> (kg)<b>:   </b>";
cnt2 += "<span id=\"spRlstWeightYoung\"></span><br /><b>Reference height</b> (m)<b>:   </b>";
cnt2 += "<span id=\"spRlstHeightYoung\"></span><br /><b>Basal metabolic rate</b><font class=\"txtErr\">*</font> (kJ per day)<b>:   </b>";
cnt2 += "<span id=\"spRlstBasalYoung\"></span></p>";
cnt2 += "<div class='fullLevel'>";
cnt2 += "	<div class='description'>";
cnt2 += "		<p>This is based on your chosen Physical Activity Level. Physical Activity Levels incorporate the relevant growth factor for age.</p>";
cnt2 += "		<p>The height and/or weight to age ratio may differ in some ethnic groups.</p>";
cnt2 += "		<p style='font-style: italic'>If your (or your child\'s) body height or body weight is quite different from the reference values, and the BMI (body mass index) is in the acceptable range, it may be more relevant to use body weight as a guide to energy requirements.</p>";
cnt2 += "		<p><font class=\"txtErr\">*</font> Basal Metabolic Rate is the minimum number of calories your body needs at rest to maintain functions such as heartbeat, breathing and temperature and only accounts for a proportion of total energy needs.</p>";
cnt2 += "		<p>Sometimes it’s hard to get children to eat properly – find out what makes a <a href='http://www.mydr.com.au/kids-teens-health/healthy-diet-for-children'>healthy diet for children</a>.</p>";
cnt2 += "	</div>";
cnt2 += "</div>";
//cnt2 += foot;
 
var frmCnt = "";
frmCnt += "<table class='inputForm'><tr><td>";
frmCnt += "<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\" ID=\"Table4\"><tr><td align=\"left\" valign=\"middle\">";
frmCnt += "<b>Gender:</b></td><td align=\"left\" valign=\"middle\" style=\"padding-left: 24px;\"><b><label class=\"yesno\"><input type=\"radio\" id=\"sm\" class=\"contentPrimaryLink\" name=\"s\" value=\"m\" /> Male </label>";
frmCnt += "<label class=\"yesno\"><input type=\"radio\" name=\"s\" id=\"sf\" value=\"f\" /> Female </label></b></td></tr></table></td><td></tr>";
frmCnt += "<tr><td><font class=\"warning\">Select age either for infants or for adolescents not both.</font></td></tr><tr><td>";
frmCnt += "<table align=\"left\" border=\"0\" class=\"tbl + tblNoBrd\"><tr><td align=\"left\" valign=\"middle\" class=\"ageBox\">";
frmCnt += "<b>Infants and young children (1 to 24 months)</b></td></tr>";
frmCnt += "<tr><td align=\"left\" valign=\"bottom\">";
frmCnt += "<font class=\"ageBox\">Age: <select id=\"infant\" name=\"infant\" class=\"ddl\" onchange=\"javaScript:ageSelect('infant');\">";
frmCnt += "<option value=\"0\"></option><option value=\"1\">1</option><option value=\"2\">2</option><option value=\"3\">3</option>";
frmCnt += "<option value=\"4\">4</option><option value=\"5\">5</option><option value=\"6\">6</option><option value=\"7\">7</option>";
frmCnt += "<option value=\"8\">8</option><option value=\"9\">9</option><option value=\"10\">10</option><option value=\"11\">11</option>";
frmCnt += "<option value=\"12\">12</option><option value=\"15\">15</option><option value=\"18\">18</option><option value=\"21\">21</option>";
frmCnt += "<option value=\"24\">24</option></select> months</font></td></tr>";
frmCnt += "<tr><td align=\"left\" valign=\"top\"><font class=\"warning + ageBox\">Please choose the age closest to that of your child.</font></td></tr></table></td></tr>";
frmCnt += "<tr><td><b>OR</b></td></tr><tr><td><table align=\"left\" border=\"0\" class=\"tbl + tblNoBrd\"><tr>";
frmCnt += "<td align=\"left\" valign=\"middle\" class=\"ageBox\"><b>Children and adolescents (3 to 18 years)</b></td></tr>";
frmCnt += "<tr><td align=\"left\" valign=\"bottom\"><font class=\"ageBox\">Age: <select id=\"young\" name=\"young\" class=\"ddl\" onchange=\"javaScript:ageSelect('young');\">";
frmCnt += "<option value=\"0\"></option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"5\">5</option>";
frmCnt += "<option value=\"6\">6</option><option value=\"7\">7</option><option value=\"8\">8</option><option value=\"9\">9</option>";
frmCnt += "<option value=\"10\">10</option><option value=\"11\">11</option><option value=\"12\">12</option><option value=\"13\">13</option>";
frmCnt += "<option value=\"14\">14</option><option value=\"15\">15</option><option value=\"16\">16</option><option value=\"17\">17</option>";
frmCnt += "<option value=\"18\">18</option></select> years";
frmCnt += "</td></tr><tr><td align=\"left\" valign=\"top\" class=\"ageBox\"><b>Physical Activity Level (PAL): </b>";
frmCnt += "<select id=\"pal\" name=\"pal\" class=\"ddl2\"><option value=\"0\"></option>";
frmCnt += "<option value=\"1.2\">1.2 - Bed rest</option><option value=\"1.4\">1.4 - Very sedentary</option>";
frmCnt += "<option value=\"1.6\">1.6 - Light activity</option><option value=\"1.8\">1.8 - Moderate activity</option>";
frmCnt += "<option value=\"2\">2.0 - Heavy activity</option><option value=\"2.2\">2.2 - Vigorous activity</option></select></td></tr></table>";
frmCnt += "</td></tr></table>";

  
  
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
  
