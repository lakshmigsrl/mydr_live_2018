
	function changecss(theClass,element,value) {
	//Last Updated on May 21, 2008
	//documentation for this script at
	//http://www.shawnolson.net/a/503/altering-css-class-attributes-with-javascript.html
	 var cssRules;
	 if (document.all) {
	  cssRules = 'rules';
	 }
	 else if (document.getElementById) {
	  cssRules = 'cssRules';
	 }
	 var added = false;
	 for (var S = 0; S < document.styleSheets.length; S++){
	  for (var R = 0; R < document.styleSheets[S][cssRules].length; R++) {
	   if (document.styleSheets[S][cssRules][R].selectorText == theClass) {
	    if(document.styleSheets[S][cssRules][R].style[element]){
	    document.styleSheets[S][cssRules][R].style[element] = value;
	    added=true;
		break;
	    }
	   }
	  }

	  if(!added){
	  if(document.styleSheets[S].insertRule){
			  document.styleSheets[S].insertRule(theClass+' { '+element+': '+value+'; }',document.styleSheets[S][cssRules].length);
			} else if (document.styleSheets[S].addRule) {
				document.styleSheets[S].addRule(theClass,element+': '+value+';');
			}
	  }
	 }
	}


	var cell;
	var tdScore;
	var yesCount = 0;
	var noCount = 0;
	var undefCount = 0;
	var questions = new Array();

	function GenderClick(gender)
	{
		switch (gender) {
			case "M":
				questions = new Array(8);
				//changecss(".maleRow", "display", "");
				//changecss(".femaleRow", "display", "none");
				$('.femaleRow').hide();
				$('.maleRow').show();
				break;
			
			case "F":
				questions = new Array(9);
			        //changecss(".maleRow", "display", "none");
				//changecss(".femaleRow", "display", "");
				$('.femaleRow').show();
				$('.maleRow').hide();
				break;
			
			default:
				questions = new Array(0);
				tgtDiv = "";
				break;
		}
		
		document.getElementById("quizGender").style.display = "none";
		document.getElementById("quizGeneral").style.display = "block";
		document.getElementById("toolsArea").style.display = "block";
	}
		
	function clearall()
	{
		//alert('clearing');
		yesCount = 0;
		noCount = 0;
		undefCount = 0;
		for (i=0; i < questions.length; i++)
		{
			//alert(i);
			set(i, null);
			//alert(i + '-cleared');
		}

		document.getElementById("quizGender").style.display = "block";
		document.getElementById("quizGeneral").style.display = "none";
		document.getElementById("toolsArea").style.display = "none";
		document.getElementById("tdScore").innerHTML = "";
		document.getElementById("advice").innerHTML = "";
	}
	
	
	function set(q, stat) {
		questions[q] = stat;
	}
	
	function showScore() {
		undefCount = 0;
		yesCount = 0;
		noCount = 0;
		
		for (var t=0; t < questions.length; t++) {
			if (questions[t] == true) 
			{ 
				yesCount++;
			} 
			else if (questions[t] == false) 
			{
				noCount++;
			} else {
			
				undefCount++;
			}
		}
		
		tdScore = document.getElementById("tdScore");


		score = '<h2 class="resultLabel">RESULTS</h2>';
		score += '<div class="resultLevels">';
		score += '	<div class="indication maxWidth">';
		score += '		<div class="label">';
		score += '			Your score';
		score += '		</div>';
		score += '		<div class="description">';
		score += '			<p>Yes: '+yesCount+'</p>';
		score += '		</div>';
		score += '		<div class="description">';
		score += '			<p>No: '+noCount+'</p>';
		score += '		</div>';
		score += '	</div>';
		score += '</div>';

		tdScore.innerHTML = score;
		//clearall();
	}
				
		
		
	function showAdvice() {
		var adv = "";
		var yes = false;
		var nullcount = false;
		
		for (var i=0; i < questions.length; i++) {
			if (questions[i] == null) {
				nullcount = true;
			}
		}
		
		if(!nullcount){
			
			
			//Have any questions been answered yes?
			for (var i=0; i < questions.length; i++) {
				if (questions[i] == true) {
					yes = true;
				}
			}
		
			if (yes) {
			    adv = "<p>If you answered <b>yes</b> to any of these questions, you may be at risk of getting osteoporosis and it is recommended that you consult your doctor.</p>";
			    adv += "<p>Print this checklist and take it with you and your doctor will advise if further tests are necessary.</p>";
			    adv += "<p>The good news is that osteoporosis can be diagnosed relatively easily and treated.</p>";
			    adv += "<p>Talk to your local osteoporosis society about what lifestyle changes you can make to reduce the risk of osteporosis.</p>";
				
			} else {
				adv = "<p>You answered no to all " + questions.length + " questions. It appears that your risk of osteoporosis may be low. However, if your situation ";
			    adv += "changes or you are at all concerned about osteoporosis, see your doctor.</p>";
			}
		}	
		else{
			adv = "<p>It appears that you have not answered all the questions in the quiz.</p>"; 
			adv += "<p>Please go back and answer all the questions before submitting your response.</p>";
		}

		advDiv = '<div class="resultLevels">';
		advDiv += '	<div class="indication maxWidth">';
		advDiv += '		<div class="label">';
		advDiv += '			Osteoporosis Risk Notes';
		advDiv += '		</div>';
		advDiv += '		<div class="description">';
		advDiv += adv;
		advDiv += '		</div>';
		advDiv += '	</div>';
		advDiv += '</div>';


		showScore();
		cell = document.getElementById("advice"); 
		yes = false;
		cell.innerHTML = advDiv;
	}
	
	function getSelectedGender() {
		var selGender = "";
		var radios = document.getElementsByName('qgender');
		for (var i = 0, length = radios.length; i < length; i++) {
			if (radios[i].checked) {
				//alert(radios[i].value);
				selGender = radios[i].value;
			}
		}
		
		if(selGender==""){
			alert("You must choose your gender...");
			return;
		}else{
			GenderClick(selGender);
		}
		
	}
