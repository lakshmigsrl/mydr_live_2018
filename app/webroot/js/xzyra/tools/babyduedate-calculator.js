
var dateNow = new Date();
var jQ = jQuery.noConflict();
jQ(function() {
	jQ("#datepickerPick").datepicker({
			dateFormat:'d M, yy',
			onSelect: function(selected, evnt){
				dateSel = jQ("#datepickerPick").datepicker("getDate");
				jQ('#Day').val(("0"+dateSel.getDate()).slice(-2));
				jQ('#Month').val(("0"+(dateSel.getMonth()+1)).slice(-2));
				jQ('#Year').val(dateSel.getFullYear());
				//alert("day: "+jQ('#Day').val()+", month: "+jQ('#Month').val()+", year: "+jQ('#Year').val() );
				jQ('#ResultContainer').hide();
			}
	});
	resetDate();
});

function resetDate(){
	/* Initialize default values. */
	jQ('#datepickerPick').val(jQ.datepicker.formatDate("d M, yy", dateNow));
	jQ('#Day').val(("0"+dateNow.getDate()).slice(-2));
	jQ('#Month').val(("0"+(dateNow.getMonth()+1)).slice(-2));
	jQ('#Year').val(dateNow.getFullYear());

	calculateBabyDueDate(document.Baby);
	jQ('#ResultContainer').hide();
}




function rollOver(img, target) {
	if (document.images) {
		document[target].src = eval(img + "over.src");
	}
}

function rollOut(img, target) {
	if (document.images) {
		document[target].src = eval(img + "out.src");
	}
}
//End Of Rollover Stuff


function GetDaysInMonth(iMonth,iYear) {
	var dd = new Date(iYear, iMonth, 0);
	return dd.getDate();
}
// Begin Form Validation Functions

function isBlankElement(s)
// This function read each of the fields that are in the form and returns true if the
// form element contatins only whitespace characters.
//
{
	for (i=0; i < s.length; i++)
	{
		var c = s.charAt(i);
		if ((c != ' ' ) && (c != '\n') && (c !='\t')) return false;
	}
	 return true;
}
	
function isNumeric(s)
{
	for (i=0; i < s.length; i++)
	{
		var c = s.charAt(i);	
		if (  (  !( (c >= '0' ) && (c <= '9') ) )   &&   ((c !='.') && (c !=',')) 	)
		{
		 	return false;
		}
	}
	return true;
}	
		// This if the function that perfroms from validation. It will be invoked from the
		// from onSubmit event handler. The handler should return whatever value this function returns
		//
function verifyToolkitForm(f)
{
	var OverallWarning = "Sorry this page could not be processed.\n\n";
	var AlphaWarning = "";
	var MissingWarning = "";
	var EmptyMessage = "";
	var WarningMessage = "";
	var WarnAtAll = false;
				
		// Loop throught the elements of the form, looking for all text and textarea elements that
		// don't have an "optional" properety defined
		// Then check for fields taht are empty and make a list of them
		// Also, if any of these elements have a min or max poreperty defined then veriy that they are
		// and that they are in the right range
		// put toghter error esaged based on the problems found
		
		for( var i=0; i<f.length; i++)
		{
			var e = f.elements[i];
			
			if ((e.type == "text") || (e.type == "textarea"))
			{
				// fisrt check to see if the field is empty
				if (((e.value == null) || (e.value == "" ) || isBlankElement(e.value)) && !e.optional)
				{
					MissingWarning += e.username + " is a mandatory field, please complete the field to proceed.\n";
					EmptyMessage = "This may be because you haven't filled in all the required boxes: please check again.\n\n"
					WarnAtAll = true;					
					continue;
				}
				
				// now check for field that are supposed to be numeric
				if ((e.numeric != null) && (e.numeric))
				{
					//alert(e.value);
					if (isNumeric(e.value))
					{
						var v = parseFloat(e.value);
						if ((( e.min != null) && (v < e.min)) ||
							(( e.max != null) && (v > e.max)))
						{
							MissingWarning += "For " + e.username + " ensure you enter a number between " + e.min + " and " +e.max +".\n";
							WarnAtAll = true;										
						}	
					}
					else
					{
						AlphaWarning = "For " + e.username + " ensure you enter numbers only, with no letters of the alphabet.\n\n";
						WarnAtAll = true;	
					}
				}							
			}// if type is of text
			 
		} // for each element loop
						
	// now. if there was any errors, display the messages and return false
	// otherwise return true and submit the form
	
	if(WarnAtAll) 
	{	
		WarningMessage = OverallWarning + EmptyMessage + AlphaWarning + MissingWarning;  
		alert(WarningMessage);
		return false;
	}
	else
	{
		return true;
	}
	
}
// End Form Validation Functions


if (document.images) {
	Calculateover = new Image(86,19);
	ClearAllover = new Image(111,19);
	
	Calculateover.src = "/files/images/generic/calculate.gif";
	ClearAllover.src = "/files/images/generic/resetvalues.gif";
	
	Calculateout = new Image(86,19);
	ClearAllout = new Image(111,19);
	
	Calculateout.src = "/files/images/generic/calculate_o.gif";
	ClearAllout.src = "/files/images/generic/resetvalues_o.gif";
}

function clearAll()
{
	document.Baby.Day.value="";
	document.Baby.Month.value="";
	document.Baby.Year.value="";
	resetDate();
	jQ('#ResultContainer').hide();
}

function makeArray() 
{
    this[0] = makeArray.arguments.length;
    for (i = 0; i<makeArray.arguments.length; i++)
        this[i+1] = makeArray.arguments[i];
}

var monthsofyear   = new makeArray('January','February','March',
                                   'April','May','June',
                                   'July','August','September',
                                   'October','November','December');
								   
var daysofmonth    = new makeArray( 31, 28, 31, 30, 31, 30,
                                    31, 31, 30, 31, 30, 31);
									
var daysofmonthLY  = new makeArray( 31, 29, 31, 30, 31, 30,
		                            31, 31, 30, 31, 30, 31);
									
function LeapYear(year) 
{
	if ((year/4)   != Math.floor(year/4))   return false;
    if ((year/100) != Math.floor(year/100)) return true;
    if ((year/400) != Math.floor(year/400)) return false;
    return true;
} 

function ValidDate(day,month,year) 
{
    if ( (LeapYear(year) && (day > daysofmonthLY[month])) ||
         (!LeapYear(year) && (day > daysofmonth[month])) )
        return false;
    else
        return true;
} 

function calculateBabyDueDate(formdata)
{
	document.Baby.Day.optional=false;
	document.Baby.Day.min=1;
	document.Baby.Day.max=31;										
	document.Baby.Day.numeric=true;								
	document.Baby.Day.username='Day of the Month';								
	document.Baby.Month.optional=false;
	document.Baby.Month.min=1;
	document.Baby.Month.max=12;										
	document.Baby.Month.numeric=true;								
	document.Baby.Month.username='Month of the Year';								
	document.Baby.Year.optional=false;
	document.Baby.Year.min=2000;
	document.Baby.Year.max=2100;										
	document.Baby.Year.numeric=true;								
	document.Baby.Year.username='Year';		
	document.Baby.DueDate.optional=true;
	jQ('#ResultContainer').show();

	if (verifyToolkitForm(formdata))
	{
		// If all the values are complete and within ranges specified in the href
		var day;
		var month;
		var year;
		var dueDate = "";
		var menstruationDateString;
		var menstruationDate;
		
		Day = Math.round(document.Baby.Day.value);
		Month = Math.round(document.Baby.Month.value);
		Year = Math.round(document.Baby.Year.value);
				
		if (ValidDate(Day, Month, Year))
		{					
			buildCalendar(new Date(Year, Month - 1, Day + 280));
//				document.Baby.DueDate.value = Day + '/' + Month + '/' + Year;
//				document.Baby.submit();
		}
		else
		{
			alert("The date you have entered is not a valid date, please correct the date to be the first day of your last period.");
		}
	}
}




//PHYSICALLY BUILD THE CALENDAR
function buildCalendar (dd){
	var iDIM = GetDaysInMonth(dd.getMonth()+1, dd.getFullYear());
	var d2 = new Date(dd.getFullYear(), dd.getMonth(), 1);
	var iDOW = d2.getDay() + 1;

	month=new Array();
	month[0]="January";
	month[1]="February";
	month[2]="March";
	month[3]="April";
	month[4]="May";
	month[5]="June";
	month[6]="July";
	month[7]="August";
	month[8]="September";
	month[9]="October";
	month[10]="November";
	month[11]="December";

	var calendar = document.getElementById("calendar");
	var printStr = "";
	//printStr += "<table class='information' BORDER=1 CELLSPACING=0 CELLPADDING=1 BGCOLOR=#99CCFF width=100%>";
	printStr += "<table class='information' width='100%' style='background-color: #FEFEFE;'>";
	printStr += "<tbody>";

	//Write spacer cells at beginning of first row if month doesn't start on a Sunday.
	if (iDOW != 1){
		printStr += "<tr>";
		iPosition=1;
			while (iPosition < iDOW){
				printStr += "<TD> </TD>";
				iPosition++;
			}
	}
	//Write days of month in proper day slots
	iCurrent=1;
	iPosition=iDOW;
	while (iCurrent <= iDIM) {
		//If we're at the begginning of a row then write TR
		if (iPosition == 1){
			printStr +="<TR>";
		}
		//If the day we're writing is the selected day then highlight it somehow.
		if (iCurrent == dd.getDate()){
			printStr += '<TD width="14%" style="background-color: #C5E1FA;"><span style="color: #3687c8; font-weight: bold; font-size: 14px;">' + iCurrent + '</span><BR /><BR /></TD>';
		}else{
			printStr += "<TD>" + iCurrent + "<BR><BR></TD>";
		}
		//If we're at the endof a row then write /TR
		if (iPosition == 7){
			printStr += "</TR>";
			iPosition = 0;
		}
		//Increment variables
		iCurrent++;
		iPosition++;
	}
	//Write spacer cells at end of last row if month doesn't end on a Saturday.
	if (iPosition != 1){
		while (iPosition <= 7){
			printStr += "<TD> </TD>";
			iPosition++;
		}
		printStr += "</TR>";
	}
	printStr += "</tbody>";
	printStr += "</table>";
	calendar.innerHTML = printStr;

	if (document.getElementById("Day").value != ""){
		document.getElementById("CalendarDateTitle").innerHTML = "<div class='ResultLabel'>Baby's due date: </div>"
		+ "<span style='font-size: 16px; color: #3687c8; font-weight: bold; float: left; margin-top: 5px; margin-left: 10px;'>" +
		+ dd.getDate() + " " + month[dd.getMonth()] + " " + dd.getFullYear();
	}else{
		document.getElementById("CalendarDateTitle").innerHTML = "<div class='ResultLabel'>Baby's due date: </div>"
	}
	document.getElementById("inCalDate").innerHTML = month[dd.getMonth()] + " " + dd.getFullYear();
}

