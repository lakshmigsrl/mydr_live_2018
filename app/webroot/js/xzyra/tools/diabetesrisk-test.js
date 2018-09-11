	
	var cell;
	var tdScore;
	var yesCount = 0;
	var noCount = 0;
	var undefCount = 0;
	var questions = new Array(10);

	function countYesNo()
	{
		var bYes, bNo;
		for (i=0; i < 10; i++)
		{
			bYes = eval('document.osteo.q' + (i + 1) + '[0].checked');
			bNo  = eval('document.osteo.q' + (i + 1) + '[1].checked');
			if (bYes)
			{
				set(i, true);
			}
			if (bNo)
			{
				set(i, false);
			}
		}
	}

	function clearall()
	{
		tdScore = document.getElementById("tdScore");
		cell = document.getElementById("advice"); 

		yesCount = 0;
		noCount = 0;
		undefCount = 0;
		for (i=0; i < 10; i++)
		{
			set(i, null);
		}
	}

	function set(q, stat) {
		questions[q] = stat;
	}

	function showScore() {
		undefCount = 0;
		yesCount = 0;
		noCount = 0;
		
		for (var t=0; t < 10; t++) {
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


		score  = '<h2 class="resultLabel">RESULTS</h2>';
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

		tdScore.innerHTML = score;
		document.osteo.scoreHTML.value = score;
	}

	function showAdvice() {
		var adv = "";
		var yes = false;
		var nullcount = false;

		countYesNo();

		for (var i=0; i < 10; i++) {
			if (questions[i] == null) {
				nullcount = true;
			}
		}

		if(!nullcount)
		{
			//Have any questions been answered yes?
			for (var i=0; i < 10; i++) {
				if (questions[i] == true) {
					yes = true;
				}
			}
		
			if (yes) {
			    adv = "<p>All of the factors mentioned in the quiz are risk factors for developing type 2 diabetes.</p>";
				adv += "<p>If you answered <b>yes</b> to any of these questions, you may be at risk of developing type 2 diabetes and it is recommended that you consult your doctor.</p>";
				adv += "<p>Print this checklist and take it with you. Your doctor may recommend that you take a blood glucose test.</p>"
				
			} else {
				adv = "<p>You answered no to all 10 questions. It appears that your risk of diabetes may be low.</p>" 
				adv += "However, if your situation changes or you are at all concerned about diabetes, see your doctor.</p>"
			}
		}	
		else{
			adv = "<p>It appears that you have not answered all the questions in the quiz.</p>"; 
			adv += "<p>Please go back and answer all the questions before submitting your response.</p>";
		}

		advDiv  = '<div class="resultLevels">';
		advDiv += '	<div class="indication maxWidth">';
		advDiv += '		<div class="label">';
		advDiv += '			Diabetes Risk Notes';
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
		document.osteo.advHTML.value = advDiv;
		//alert(document.osteo.advHTML.value);
	}
