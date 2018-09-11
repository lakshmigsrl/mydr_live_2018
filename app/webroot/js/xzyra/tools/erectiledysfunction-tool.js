$(document).ready(function(event) {

            $('div#erectileTool a#submitSurvey').click(function() {

                var button1 = parseInt($('input:radio[name=button1]:checked').val());
                var button2 = parseInt($('input:radio[name=button2]:checked').val());
                var button3 = parseInt($('input:radio[name=button3]:checked').val());
                var button4 = parseInt($('input:radio[name=button4]:checked').val());
                var button5 = parseInt($('input:radio[name=button5]:checked').val());

                var total = button1+button2+button3+button4+button5;
                resHead = "";
                resInfo = "<p>Erectile dysfunction (ED) is believed to affect around 40% of men at some time in their lives. For most, erectile dysfunction can be easily treated so they can resume normal sexual activity.</p><p>It is important to note that erectile dysfunction can be an indicator of an underlying condition such as cardiovascular disease, diabetes, prostate problem, or anxiety and depression, and so it is important to visit your doctor if you experience problems with erectile dysfunction.</p><p>Print this result page and take it to discuss with your doctor.</p>";
                if( (parseInt(total) >= parseInt(5)) && (parseInt(total) <= parseInt(7))){
                   $('#displayMessage').html(resHead+"<h3>Severe</h3>"+"<p>According to your response, you may have severe erectile dysfunction."+resInfo);
                } else if( (parseInt(total) >= parseInt(8)) && (parseInt(total) <= parseInt(11))) {
                   $('#displayMessage').html(resHead+"<h3>Moderate</h3>"+"<p>According to your response, you may have moderate erectile dysfunction."+resInfo);
                } else if( (parseInt(total) >= parseInt(12)) && (parseInt(total) <= parseInt(16))) {
                  $('#displayMessage').html(resHead+"<h3>Mild to moderate</h3>"+"<p>According to your response, you may have mild to moderate case of erectile dysfunction."+resInfo);
                } else if( (parseInt(total) >= parseInt(17)) && (parseInt(total) <= parseInt(21))) {
                  $('#displayMessage').html(resHead+"<h3>Mild</h3>"+"<p>According to your response, you may have mild erectile dysfunction."+resInfo);
                } else if( (parseInt(total) >= parseInt(22)) && (parseInt(total) <= parseInt(25))) {
                  $('#displayMessage').html(resHead+"<h3>No dysfunction</h3>"+"<p>According to your response, you do not appear to have erectile dysfunction."+resInfo);
                }

                $("#displayMessage").show();
                $("#displayMessage").before("<h2 class='resultLabel'>Result</h2>");
            });

	$("div#erectileTool input").click(function(){
		//$("input[name='button1']").parent().attr("style", "font-weight: normal;");
		$("input[name='"+$(this).attr("name")+"']").parent().attr("style", "font-weight: normal;");
		$(this).parent().attr("style", "font-weight: bold;");
	});

});
