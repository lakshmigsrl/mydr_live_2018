//document.write('<script language="javascript" src="' + 'browserCheck.js"></script>');
var dateNow = new Date();
$(document).ready(function() {
	$("#datepickerPuck").datepicker({
			dateFormat:'d M, yy',
			onSelect: function(selected, evnt){
				dateSel = $("#datepickerPuck").datepicker("getDate");
				$('#dd').val(("0"+dateSel.getDate()).slice(-2));
				$('#mm').val(("0"+(dateSel.getMonth()+1)).slice(-2));
				$('#yy').val(dateSel.getFullYear());
			}
	});
	resetDate();

});

function resetDate(){
	/* Initialize default values. */
	// $( "#datepickerPuck" ).val($(this).datepicker.formatDate("d M, yy", dateNow));
	$('#dd').val(("0"+dateNow.getDate()).slice(-2));
	$('#mm').val(("0"+(dateNow.getMonth()+1)).slice(-2));
	$('#yy').val(dateNow.getFullYear());
}

var f0=new Date;
var f11=new Date;
var f21=new Date;
var f31=new Date;
var f41=new Date;
var f12=new Date;
var f22=new Date;
var f32=new Date;
var f42=new Date;
var calNum;
var errMsg;
function imgOver(i,off){
	i.src=off;
}

function imgOut(i,on){
	i.src=on;
}

function calMe(){
	var valid=validateMe();
	calString='';
	calNum=1;
	if(valid){
		d=document.frmMain.dd.value;
		m=document.frmMain.mm.value;
		y=document.frmMain.yy.value;
		dy=document.frmMain.dy.value;
		f11=convertToDate(d,m,y);
		f11.setDate(f11.getDate()+parseInt(dy)-18);
		f12=convertToDate(d,m,y);
		f12.setDate(f12.getDate()+parseInt(dy)-14);
		f21=convertToDate(d,m,y);
		f21.setDate(f21.getDate()+(parseInt(dy)*2)-18);
		f22=convertToDate(d,m,y);
		f22.setDate(f22.getDate()+(parseInt(dy)*2)-14);
		f31=convertToDate(d,m,y);
		f31.setDate(f31.getDate()+(parseInt(dy)*3)-18);
		f32=convertToDate(d,m,y);
		f32.setDate(f32.getDate()+(parseInt(dy)*3)-14);
		f41=convertToDate(d,m,y);
		f41.setDate(f41.getDate()+(parseInt(dy)*4)-18);
		f42=convertToDate(d,m,y);
		f42.setDate(f42.getDate()+(parseInt(dy)*4)-14);
		document.getElementById('spErr').style.display='none';
		document.frmMain.dd.disabled=true;
		document.frmMain.mm.disabled=true;
		document.frmMain.yy.disabled=true;
		document.frmMain.dy.disabled=true;
		//document.getElementById('imgSub').style.display='none';
		document.getElementById('tblResult').style.display='';
		document.getElementById('trErr').style.display='none';
		var thisCalendar=new calendar('thisCalendar',f11,f12,f21,f22,f31,f32,f41,f42);
		var res=writeCalendar();
		document.getElementById('spMth').innerHTML='<b>'+monthDiff(f11,f42)+'</b>';
		document.getElementById('calShow').innerHTML=calString;
	}
	else{
		document.getElementById('trErr').style.display='';
		document.getElementById('spErr').innerHTML=errMsg;
		document.getElementById('spErr').style.display='';
		document.getElementById('tblResult').style.display='none';
	}
}

function monthDiff(m1,m2){
	var tmpm1=m1.getMonth();
	var tmpy1=m1.getFullYear();
	var tmpm2=m2.getMonth();
	var tmpy2=m2.getFullYear();
	var diff=0;
	if(tmpy2!=tmpy1){
		diff=12-tmpm1+1;
		diff+=tmpm2;
	}
	else{
		diff=tmpm2-tmpm1+1;
	}
	return diff;
}

function validateMe(){
	errMsg='';
	var d,m,y,dy;
	d=document.frmMain.dd.value;
	m=document.frmMain.mm.value;
	y=document.frmMain.yy.value;
	dy=document.frmMain.dy.value;
	var tmpDate=new Date();
	tmpDate.setYear(y);
	tmpDate.setMonth(m-1);
	tmpDate.setDate(1);
	var dayInMth=32-new Date(tmpDate.getYear(),tmpDate.getMonth(),32).getDate();
	var valid=true;
	if((m.length==0)||(d.length==0)){
		valid=false;
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}

		if(d.length==0){
			errMsg+='<li class="tblErr">Please enter day.</li>';
			document.frmMain.dd.select();
		}
		else if(d.length==1){
			if(errMsg==''){
				errMsg='<b>Please check your data entry.</b><br />';
			}
			errMsg+='<li class="tblErr">For day, ensure you enter a 2-digit number (e.g. 01 for the first 11 for the eleventh).</li>';
document.frmMain.dd.select();
}
else{
	if(isNaN(d)){
		document.frmMain.dd.select();
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">Day accepts 2-digit number only.</li>';
	}
}

if(m.length==0){
	if(d.length==1)valid==false;
	errMsg+='<li class="tblErr">Please enter month.</li>';
	if(document.frmMain.dd.selected==true)document.frmMain.mm.select();
}
else if(m.length==1){
	if(errMsg==''){
		errMsg='<b>Please check your data entry.</b><br />';
	}
	errMsg+='<li class="tblErr">For month, ensure you enter a 2-digit number (e.g. 01 for January 12 for December).</li>';
}
else{
	if(isNaN(m)){
		document.frmMain.mm.select();
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">Month accepts 2-digit number only.</li>';
	}
}
return valid;
}

if((m.length==1)||(d.length==1)){
	valid=false;
	if(d.length==1){
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">For day, ensure you enter a 2-digit number (e.g. 01 for the first 11 for the eleventh).</li>';
}

if(m.length==1){
	document.frmMain.mm.select();
	if(errMsg==''){
		errMsg='<b>Please check your data entry.</b><br />';
	}
	errMsg+='<li class="tblErr">For month, ensure you enter a 2-digit number (e.g. 01 for January 12 for December).</li>';
}

if(d.length==1)document.frmMain.dd.select();
else if(m.length==1)document.frmMain.mm.select();
return valid;
}

if((d>=1)&&(d<=dayInMth)){
	valid=valid?true:false;
}
else{
	valid=false;
	if((m<1)||(m>12)){
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">Day is out of the range.</li>';
		document.frmMain.dd.select();
	}
	else{
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">There are <b>'+dayInMth+'</b> days in '+months[tmpDate.getMonth()]+' '+tmpDate.getFullYear()+'</b>.</li>';
		document.frmMain.dd.select();
	}
}

if((m>=1)&&(m<=12)){
	valid=valid?true:false;
}
else{
	valid=false;
	if((m<1)||(m>12)){
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">Month is out of the range.</li>';
		document.frmMain.mm.select();
	}
}

if(dy.length==0){
	valid=false;
	if(errMsg==''){
		errMsg='<b>Please check your data entry.</b><br />';
	}
	errMsg+='<li class="tblErr">Enter length of your usual cycle.</li>';
	document.frmMain.dy.select();
}
else{
	if(isNaN(dy)){
		document.frmMain.dy.select();
		if(errMsg==''){
			errMsg='<b>Please check your data entry.</b><br />';
		}
		errMsg+='<li class="tblErr">The length of your usual cycle accepts numeric only.</li>';
	}
}

if(errMsg!='')errMsg+="<br />";
return valid;
}

function resetMe(){
	//document.frmMain.dd.disabled=false;
	//document.frmMain.mm.disabled=false;
	//document.frmMain.yy.disabled=false;
	//document.frmMain.dd.value='';
	//document.frmMain.mm.value='';
	//document.getElementById('imgSub').style.display='';
	//document.frmMain.yy.value=new Date().getFullYear();
	
	document.frmMain.dy.disabled=false;
	document.frmMain.dy.value=28;
	document.getElementById('spErr').style.display='none';
	document.getElementById('trErr').style.display='none';
	document.getElementById('tblResult').style.display='none';
	calString='';
	document.getElementById('spMth').innerHTML=0;
	calNum=1;
	document.frmMain.dd.select();
	resetDate();
}

function checkMe(toCheck){
	trimMe(toCheck);
}

function trimMe(toCheck){
	var strTmp='';
	for(i=0;
		i<toCheck.value.length;
		i++){
		if((toCheck.value.substr(i,1)!=' ')&&(!isNaN(toCheck.value.substr(i,1)))){
			strTmp+=toCheck.value.substr(i,1);
		}
	}
	toCheck.value=strTmp;
}

function getObj(id){

	return bw.dom?document.getElementById(id):bw.ie4?document[id]:bw.ns4?document.layers[id]:null;

}


function convertToDate(d,m,y){

	newDate=new Date();
	newDate.setDate(d);
	newDate.setMonth(m-1);
	newDate.setYear(y);
	return newDate;

}

var days=new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

var months=new Array('January','February','March','April','May','June','July','August','September','October','November','December');

var mDiff=true;

var yDiff=true;

var f0DateObject,f11DateObject,f12DateObject,f21DateObject,f22DateObject,f31DateObject,f32DateObject,f41DateObject,f42DateObject;

var dayInMthF0,dayInMthF11,dayInMthF12,dayInMthF21,dayInMthF22,dayInMthF31,dayInMthF32,dayInMthF41,dayInMthF42;
f0DateObject=new Date();

function calendar(id,f11,f12,f21,f22,f31,f32,f41,f42){

	this.id=id;

	this.write=writeCalendar;
	f11DateObject=f11;
	f12DateObject=f12;
	f21DateObject=f21;
	f22DateObject=f22;
	f31DateObject=f31;
	f32DateObject=f32;
	f41DateObject=f41;
	f42DateObject=f42;

	this.mDiff=f11DateObject.getMonth()==f12DateObject.getMonth()?true:false;
	this.yDiff=f11DateObject.getFullYear()==f42DateObject.getFullYear()?false:true;
	dayInMthF11=32-new Date(f11.getYear(),f11.getMonth(),32).getDate();
	dayInMthF12=32-new Date(f12.getYear(),f12.getMonth(),32).getDate();
	dayInMthF21=32-new Date(f21.getYear(),f21.getMonth(),32).getDate();
	dayInMthF22=32-new Date(f22.getYear(),f22.getMonth(),32).getDate();
	dayInMthF31=32-new Date(f31.getYear(),f31.getMonth(),32).getDate();
	dayInMthF32=32-new Date(f32.getYear(),f32.getMonth(),32).getDate();
	dayInMthF41=32-new Date(f41.getYear(),f41.getMonth(),32).getDate();
	dayInMthF42=32-new Date(f42.getYear(),f42.getMonth(),32).getDate();
	this.totalMonth=howManyMonth(f11DateObject,f42DateObject);

}

function howManyMonth(m1,m2){

	var fMth=m1.getMonth();
	var lMth=m2.getMonth();

	if(this.yDiff){

		var tmp=12-fMth;
		tmp+=lMth;
		return tmp+1;

	}
	else{

		var tmp=lMth-fMth;
		return tmp+1;

	}

}

var range1,range2,range3,range4,range5,range6,range7,range8,range8;
var calString='';

function writeCalendar(){

	var f1112=true;
	var f1221=true;
	var f2122=true;
	var f2231=true;
	var f3132=true;
	var f3241=true;
	var f4142=true;
	range1=0;
	range2=0;
	range3=0;
	range4=0;
	range5=0;
	range6=0;
	range7=0;
	range8=0;

	if(f11DateObject.getMonth()==f12DateObject.getMonth()){
		range1=f12DateObject.getDate()-f11DateObject.getDate()+1;
	}
	else{
		range1=dayInMthF11-f11DateObject.getDate()+1;
		f1112=false;
	}

	if(!f1112){
		range2=f12DateObject.getDate();
	}

	if(f12DateObject.getMonth()==f21DateObject.getMonth()){
		if(f21DateObject.getMonth()==f22DateObject.getMonth()){
			if(range2==0){
				range2=f22DateObject.getDate()-f21DateObject.getDate()+1;
			}
			else{
				range3=f22DateObject.getDate()-f21DateObject.getDate()+1;
			}
		}
		else{
			if(range2==0){
				range2=dayInMthF21-f21DateObject.getDate()+1;
			}
			else{
				range3=dayInMthF21-f21DateObject.getDate()+1;
			}
			f2122=false;
		}
	}
	else{
		f1221=false;
		if(f21DateObject.getMonth()==f22DateObject.getMonth()){
			if(range2==0){
				range2=f22DateObject.getDate()-f21DateObject.getDate()+1;
			}
			else{
				range3=f22DateObject.getDate()-f21DateObject.getDate()+1;
			}
		}
		else{
			if(range2==0){
				range2=dayInMthF21-f21DateObject.getDate()+1;
			}
			else{
				range3=dayInMthF21-f21DateObject.getDate()+1;
			}
			f2122=false;
		}
	}

	if(!f2122){
		if(range3==0){
			range3=f22DateObject.getDate();
		}
		else{
			range4=f22DateObject.getDate();
		}
	}

	if(f22DateObject.getMonth()==f31DateObject.getMonth()){
		if(f31DateObject.getMonth()==f32DateObject.getMonth()){
			if(range3==0){
				range3=f32DateObject.getDate()-f31DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=f32DateObject.getDate()-f31DateObject.getDate()+1;
			}
			else{
				range5=f32DateObject.getDate()-f31DateObject.getDate()+1;
			}
		}
		else{
			if(range3==0){
				range3=dayInMthF31-f31DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=dayInMthF31-f31DateObject.getDate()+1;
			}
			else{
				range5=dayInMthF31-f31DateObject.getDate()+1;
			}
			f3132=false;
		}
	}
	else{
		f2231=false;
		if(f31DateObject.getMonth()==f32DateObject.getMonth()){
			if(range3==0){
				range3=f32DateObject.getDate()-f31DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=f32DateObject.getDate()-f31DateObject.getDate()+1;
			}
			else{
				range5=f32DateObject.getDate()-f31DateObject.getDate()+1;
			}
		}
		else{
			if(range3==0){
				range3=dayInMthF31-f31DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=dayInMthF31-f31DateObject.getDate()+1;
			}
			else{
				range5=dayInMthF31-f31DateObject.getDate()+1;
			}
			f3132=false;
		}
	}

	if(!3132){
		if(range3==0){
			range3=f32DateObject.getDate();
		}
		else if(range4==0){
			range4=f32DateObject.getDate();
		}
		else if(ragne5==0){
			range5=f32DateObject.getDate();
		}
		else{
			range6=f32DateObject.getDate();
		}
	}

	if(f32DateObject.getMonth()==f41DateObject.getMonth()){
		if(f41DateObject.getMonth()==f42DateObject.getMonth()){
			if(range3==0){
				range3=f42DateObject.getDate()-f42DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
			else if(range5==0){
				range5=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
			else{
				range6=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
		}
		else{
			if(range3==0){
				range3=dayInMthF41-f41DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=dayInMthF41-f41DateObject.getDate()+1;
			}
			else if(range5==0){
				range5=dayInMthF41-f41DateObject.getDate()+1;
			}
			else{
				range6=dayInMthF41-f41DateObject.getDate()+1;
			}
			f4142=false;
		}
	}
	else{
		f3241=false;
		if(f41DateObject.getMonth()==f42DateObject.getMonth()){
			if(range3==0){
				range3=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
			else if(range5==0){
				range5=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
			else{
				range6=f42DateObject.getDate()-f41DateObject.getDate()+1;
			}
		}
		else{
			if(range3==0){
				range3=dayInMthF41-f41DateObject.getDate()+1;
			}
			else if(range4==0){
				range4=dayInMthF41-f41DateObject.getDate()+1;
			}
			else if(range5==0){
				range5=dayInMthF41-f41DateObject.getDate()+1;
			}
			else{
				range6=dayInMthF41-f41DateObject.getDate()+1;
			}
			f4142=false;
		}
	}

	if(!f4142){
		if(range4==0){
			range4=f42DateObject.getDate();
		}
		else if(range5==0){
			range5=f42DateObject.getDate();
		}
		else if(range6==0){
			range6=f42DateObject.getDate();
		}
		else{
			range7=f42DateObject.getDate();
		}
	}

	if(f1112){
		if(f1221){
			if(f2122){
				if(f2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do1112212231324142();
							}
							else{
								calString+=do11122122313241();
								calString+=do42();
							}
						}
						else{
							calString+=do111221223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do1112212231();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do11122122();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
			else{
				calString+=do111221();
				if(f2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do2231324142();
							}
							else{
								calString+=do22313241();
								calString+=do42();
							}
						}
						else{
							calString+=do223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do2231();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do22();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
		}
		else{
			calString+=do1112();
			if(f2122){
				if(f2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do212231324142();
							}
							else{
								calString+=do2122313241();
								calString+=do42();
							}
						}
						else{
							calString+=do21223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do212231();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4241();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do2122();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
			else{
				calString+=do21();
				if(f2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do2231324142();
							}
							else{
								calString+=do22313241();
								calString+=do22313242();
							}
						}
						else{
							calString+=do223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do22();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
		}
	}
	else if(!f1112){
		calString+=do11();
		if(f1221){
			if(f2122){
				if(f2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do12212231324142();
							}
							else{
								calString+=do122122313241();
								calString+=do42();
							}
						}
						else{
							calString+=do1221223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do12212231();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do122122();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
			else{
				calString+=do1221();
				if(f2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do2231324142();
							}
							else{
								calString+=do22313241();
								calString+=do42();
							}
						}
						else{
							calString+=do223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do2231();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do22();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
		}
		else{
			calString+=do12();
			if(f2122){
				if(f2231){
					if(f3132){
						if(3241){
							if(f4142){
								calString+=do212231324142();
							}
							else{
								calString+=do2122313241();
								calString+=do42();
							}
						}
						else{
							calString+=do21223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do212231();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do2122();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
			else{
				calString+=do21();
				if(2231){
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do2231324142();
							}
							else{
								calString+=do22313241();
								calString+=do42();
							}
						}
						else{
							calString+=do223132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do2231();
						if(3241){
							if(4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
				else{
					calString+=do22();
					if(f3132){
						if(f3241){
							if(f4142){
								calString+=do31324142();
							}
							else{
								calString+=do313241();
								calString+=do42();
							}
						}
						else{
							calString+=do3132();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
					else{
						calString+=do31();
						if(f3241){
							if(f4142){
								calString+=do324142();
							}
							else{
								calString+=do3241();
								calString+=do42();
							}
						}
						else{
							calString+=do32();
							if(f4142){
								calString+=do4142();
							}
							else{
								calString+=do41();
								calString+=do42();
							}
						}
					}
				}
			}
		}
	}
	//calString+='</td></tr></table></td><td align=right valign=top>&nbsp;</td></tr></table>';
	calString+="</div> </div> </div>";
	return calString;
}


function doWriteHead(d){
	var tmpCal='';
	if(calNum==1){
		//tmpCal+='<table width="380px" cellpadding="0" cellspacing="0" border="0"><tr><td width="380px" align=left>';
		//tmpCal+='<table width="380px" cellpadding="0" cellspacing="5" border="0">';
		//tmpCal+='<tr><td width="178px" valign="top">';
		tmpCal+='<div class="motherDiv">';
		tmpCal+='	<div class="rowDiv">';
		tmpCal+='		<div class="one insideDiv">';
		calNum++;
	}else if(calNum%2==0){
		//tmpCal+='</td><td width=178px valign=top>';
		tmpCal+='		</div>';
		tmpCal+='		<div class="one insideDiv">';
		calNum++;
	}else if(calNum%2==1){
		//tmpCal+='</td></tr><tr><td valign=top>';
		tmpCal+='		</div>';
		tmpCal+='		<div class="two insideDiv">';
		calNum++;
	}
	tmpCal+='<table id="cal'+this.id+'" cellspacing=0 cellpadding=0 class="tableCal"><tr><td>';
	tmpCal+='<table id="calIn'+this.id+'" cellspacing=0 cellpadding=1 border=1 class="tableCalIn">';
	tmpCal+='<tr><th colspan="7" class="trMth">'+months[d.getMonth()]+', '+d.getFullYear()+'</th></tr>';
	tmpCal+='<tr>';
	for(i=0;i<days.length;i++){
		tmpCal+='<th class="trDay">'+days[i].substring(0,3)+'</th>';
	}
	tmpCal+='<tr>';
	return tmpCal;
}


function old_doWriteHead(d){
	var tmpCal='';
	if(calNum==1){
		tmpCal+='<table width="380px" align="right" cellpadding="0" cellspacing="0" border="0"><tr><td width="380px" align=left>';
		tmpCal+='<table width="380px" align="left" cellpadding="0" cellspacing="5" border="0">';
		tmpCal+='<tr><td width="178px" align="right" valign="top">';
		calNum++;
	}
	else if(calNum%2==0){
		tmpCal+='</td><td width=178px align=left valign=top>';
		calNum++;
	}
	else if(calNum%2==1){
		tmpCal+='</td></tr><tr><td align=right valign=top>';
		calNum++;
	}
	tmpCal+='<table id="cal'+this.id+'" cellspacing=0 cellpadding=0 class="tableCal"><tr><td>';
	tmpCal+='<table id="calIn'+this.id+'" cellspacing=0 cellpadding=1 border=1 class="tableCalIn" width=178px>';
	tmpCal+='<tr><th colspan="7" class="trMth">'+months[d.getMonth()]+', '+d.getFullYear()+'</th></tr>';
	tmpCal+='<tr>';
	for(i=0;i<days.length;i++){
		tmpCal+='<th class="trDay">'+days[i].substring(0,3)+'</th>';
	}
	tmpCal+='<tr>';
	return tmpCal;
}

function doWriteBlankCol(){
	var tmpCal='<td>&nbsp;</td>';
	return tmpCal;
}

function findFirstDay(d){
	var tmpD=d;
	var tmp=parseInt(tmpD.getDate());
	tmpD.setDate(1);
	tmpD=tmpD.getDay();
	d.setDate(tmp);
	return tmpD;
}

function findLastDay(d){
	var tmpD=d;
	tmpD=32-new Date(tmpD.getYear(),tmpD.getMonth(),32).getDate();
	return tmpD;
}

function doWriteDateInRange(num){
	var tmpCal;
	tmpCal='<td id="'+this.id+'selected" class="tdCu"><table border=0><tr><td class=tdSelected>'+num+'</td></tr></table></td>';
	return tmpCal;
}

function doWriteDate(num){
	var tmpCal;
	tmpCal='<td class="tdDate" align=center valign=top>'+num+'</td>';
	return tmpCal;
}

function doWriteRowBreak(){
	var tmp;
	tmp='</tr><tr>';
	return tmp;
}

function do1112212231324142(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';

return tmp;
}

function findMonthDiff(f,l){
	var diff=0;
	var m1,y1,m2,y2;
	m1=f.getMonth();
	m2=l.getMonth();
	y1=f.getFullYear();
	y2=l.getFullYear();
	if(y1==y2){
		diff=m2-m1;
	}
	else{
		diff=(12-m1)+m2;
	}
	return diff;
}

function doWriteBlank(){
	var tmp='';
	tmp+=doWriteHead(f0DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f0DateObject);
	endDay=findLastDay(f0DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=dayInMthF0)){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF0)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF0)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF0)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do11122122313241(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF11)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do111221223132(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f32DateObject;
var c2=f41DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do1112212231(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=dayInMthF11)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f31DateObject;
var c2=f32DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do11122122(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f22DateObject;
var c2=f31DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do111221(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=dayInMthF11)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f21DateObject;
var c2=f22DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do1112(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f12DateObject;
var c2=f21DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do11(){
	var tmp='';
	tmp+=doWriteHead(f11DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f11DateObject);
	endDay=findLastDay(f11DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f11DateObject.getDate())&&(j-firstDay<=dayInMthF11)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f11DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF11)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF11)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF11)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f11DateObject;
var c2=f12DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do12212231324142(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do122122313241(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF12)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do1221223132(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f32DateObject;
var c2=f41DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do12212231(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=dayInMthF12)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f31DateObject;
var c2=f32DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do122122(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f22DateObject;
var c2=f31DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do1221(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=dayInMthF12)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f21DateObject;
var c2=f22DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do12(){
	var tmp='';
	tmp+=doWriteHead(f12DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f12DateObject);
	endDay=findLastDay(f12DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f12DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f12DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF12)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF12)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF12)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f12DateObject;
var c2=f21DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do212231324142(){
	var tmp='';
	tmp+=doWriteHead(f21DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f21DateObject);
	endDay=findLastDay(f21DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f21DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF21)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF21)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF21)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do2122313241(){
	var tmp='';
	tmp+=doWriteHead(f21DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f21DateObject);
	endDay=findLastDay(f21DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF21)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f21DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF21)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF21)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF21)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do21223132(){
	var tmp='';
	tmp+=doWriteHead(f21DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f21DateObject);
	endDay=findLastDay(f21DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f21DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF21)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF21)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF21)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f32DateObject;
var c2=f41DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do212231(){
	var tmp='';
	tmp+=doWriteHead(f21DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f21DateObject);
	endDay=findLastDay(f21DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=dayInMthF21)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f21DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF21)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF21)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF21)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f31DateObject;
var c2=f32DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do2122(){
	var tmp='';
	tmp+=doWriteHead(f21DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f21DateObject);
	endDay=findLastDay(f21DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f21DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF21)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF21)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF21)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f22DateObject;
var c2=f31DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do21(){
	var tmp='';
	tmp+=doWriteHead(f21DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f21DateObject);
	endDay=findLastDay(f21DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f21DateObject.getDate())&&(j-firstDay<=dayInMthF21)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f21DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF21)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF21)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF21)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f21DateObject;
var c2=f22DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do2231324142(){
	var tmp='';
	tmp+=doWriteHead(f22DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f22DateObject);
	endDay=findLastDay(f22DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f22DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF22)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF22)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF22)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do22313241(){
	var tmp='';
	tmp+=doWriteHead(f22DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f22DateObject);
	endDay=findLastDay(f22DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF22)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f22DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF22)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF22)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF22)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do223132(){
	var tmp='';
	tmp+=doWriteHead(f22DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f22DateObject);
	endDay=findLastDay(f22DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f22DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF22)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF22)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF22)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f32DateObject;
var c2=f41DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do2231(){
	var tmp='';
	tmp+=doWriteHead(f22DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f22DateObject);
	endDay=findLastDay(f22DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=dayInMthF22)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f22DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF22)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF22)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF22)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f31DateObject;
var c2=f32DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do22(){
	var tmp='';
	tmp+=doWriteHead(f22DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f22DateObject);
	endDay=findLastDay(f22DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f22DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f22DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF22)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF22)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF22)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f22DateObject;
var c2=f31DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do31324142(){
	var tmp='';
	tmp+=doWriteHead(f31DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f31DateObject);
	endDay=findLastDay(f31DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f31DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF31)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF31)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF31)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do313241(){
	var tmp='';
	tmp+=doWriteHead(f31DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f31DateObject);
	endDay=findLastDay(f31DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF31)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f31DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF31)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF31)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF31)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do3132(){
	var tmp='';
	tmp+=doWriteHead(f31DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f31DateObject);
	endDay=findLastDay(f31DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f31DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF31)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF31)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF31)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f32DateObject;
var c2=f41DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do31(){
	var tmp='';
	tmp+=doWriteHead(f31DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f31DateObject);
	endDay=findLastDay(f31DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f31DateObject.getDate())&&(j-firstDay<=dayInMthF31)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f31DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF31)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF31)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF31)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f31DateObject;
var c2=f32DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do324142(){
	var tmp='';
	tmp+=doWriteHead(f32DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f32DateObject);
	endDay=findLastDay(f32DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f32DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF32)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF32)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF32)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do3241(){
	var tmp='';
	tmp+=doWriteHead(f32DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f32DateObject);
	endDay=findLastDay(f32DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF32)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f32DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF32)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF32)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF32)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do32(){
	var tmp='';
	tmp+=doWriteHead(f32DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f32DateObject);
	endDay=findLastDay(f32DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f32DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f32DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF32)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF32)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF32)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f32DateObject;
var c2=f41DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do4142(){
	var tmp='';
	tmp+=doWriteHead(f41DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f41DateObject);
	endDay=findLastDay(f41DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f41DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF41)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF41)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF41)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

function do41(){
	var tmp='';
	tmp+=doWriteHead(f41DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f41DateObject);
	endDay=findLastDay(f41DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=f41DateObject.getDate())&&(j-firstDay<=dayInMthF41)){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f41DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF32)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF41)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF41)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
var c1=f41DateObject;
var c2=f42DateObject;
var m=0;
var y=0;
var t=0;
var tmpDiff=findMonthDiff(c1,c2);
if(tmpDiff>1){
	for(i=1;
		i<=tmpDiff-1;
		i++){
		t=c1.getMonth()+1;
	if(t+i<=11){
		m=t;
		y=c1.getFullYear();
	}
	else{
		m=-1+i;
		y=c1.getFullYear()+1;
	}
	f0DateObject.setDate(1);
	f0DateObject.setMonth(m);
	f0DateObject.setYear(y);
	dayInMthF0=32-new Date(f0DateObject.getYear(),f0DateObject.getMonth(),32).getDate();
	tmp+=doWriteBlank();
}
}
return tmp;
}

function do42(){
	var tmp='';
	tmp+=doWriteHead(f42DateObject);
	var displayNum=1;
	var tmpChk=0;
	var firstDay;
	firstDay=findFirstDay(f42DateObject);
	endDay=findLastDay(f42DateObject);
	for(j=1;
		j<=42;
		j++){
		tmpChk++;
	if(j<firstDay+1){
		tmp+=doWriteBlankCol();
	}
	else if((j-firstDay>=1)&&(j-firstDay<=f42DateObject.getDate())){
		tmp+=doWriteDateInRange(displayNum);
		displayNum++;
	}
	else if((j-firstDay<=endDay)&&(j-firstDay!=f42DateObject.getDate())){
		tmp+=doWriteDate(displayNum);
		displayNum++;
	}
	else if(((j-firstDay)>dayInMthF42)&&(tmpChk<=7)){
		tmp+=doWriteBlankCol();
	}

	if((tmpChk==7)&&(j-firstDay<dayInMthF42)){
		tmp+=doWriteRowBreak();
	}
	else if((tmpChk==7)&&(j-firstDay>=dayInMthF42)){
		tmp+='</tr>';
		break;
	}

	if(tmpChk==7)tmpChk=0;
}
tmp+='</tr>';
tmp+='</table></td></tr></table><br/>';
return tmp;
}

