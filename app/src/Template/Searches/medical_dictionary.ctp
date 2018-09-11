<?php echo $this->element('Blocks/meta_block', ['type'=>'seach']); ?>

<script language="javascript">
		function setOm(form) {
				document.searchmed.action = "http://www.mondofacto.com/facts/dictionary?" + document.searchmed.query.value;
			/*
				var s=s_gi(s_account);
					s.linkTrackVars='events,eVar8';
					s.linkTrackEvents='event6';
					s.events = 'event6';
					s.eVar8 = document.searchmed.query.value;
					s.prop8=s.eVar8;
					s.prop15='dictionary';
			*/
				document.searchmed.submit();
		}
</script>

<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">

    <!-- main section -->
    <div class="col-xs-12 col-sm-12 col-md-8 ">
          <section id="content" class="article-box">
            <div class="row">

              <div class="col-xs-12 col-md-12 blog-item blog-single">
                <h1 class="rounded">Online Medical Dictionary</h1>
                <p>
                    To find the definition of a medical term, simply enter that term and click the 'Go' button.
                </p>
                <?= $this->Form->create(null, ['url' => "http://www.mondofacto.com/facts/dictionary"]) ?>

                    <?php echo $this->Form->input('medical term', ['label' => 'What medical term are you looking for?']); ?>
                    <?= $this->Form->button(__('Submit')) ?>

                    <br /><br />
                <?= $this->Form->end() ?>

                <div style="clear: both; padding: 10px 0 0 0;">
                								<p>Type the word you are looking for and click “Go”. This dictionary specifically searches and gives results for medical and health terminology and abbreviations. Understanding what medical words mean can make all the difference in understanding and managing your health conditions in conjunction with your healthcare professional. </p>
                								<p>The dictionary can search for both American and English spellings of medical words and terminology. Don’t worry about which one to use, as the dictionary has a large directory of synonyms and will find the results, regardless of the spelling. </p>
                								<p>The dictionary has a very large array of medical terms and explanations of their meanings. It includes anatomy terms, acronyms, tests, conditions and diseases, treatments and signs and symptoms. When you click on a dictionary entry, it has links within the text to explain those terms, too.</p>
                								<p>If you type only the first few characters of a word, the results will give a sequential list of all words starting with those letters. Medical words can be difficult to spell, so this is one way of finding the definition of the word you want.</p>
                								<p>Don’t use Boolean operators or quotation marks as they won’t work with the dictionary. You don’t need hyphens for conditions such as “Osgood-Schlatter’s disease”. The dictionary will find the entry without the hyphen.</p>
                								<p>Whether you are searching for asthma, arthritis or other common conditions or a rare disease or condition, the Medical Dictionary is bound to have an entry to help you find an definition of that condition.</p>
                								<p>Your result will appear on a new tab in your browser, so that when you are finished reading you can close the tab and return to reading health information on myDr.com.au.</p>
                </div>
                <div id="search-myDr" style="clear: both;">
									<br>
									<p><font face="Verdana, Arial, Helvetica, sans-serif" size="1">The On-line Medical Dictionary is © mondofacto 2008-2009.</font></p>
									<p>To find out more, <a href="/search/health-information">search the myDr website</a> for comprehensive health information.</p>
							  </div>

              </div>

            </div>
          </section>
    </div>
    <!-- End main section -->
    <?= $this->element('sidebar') ?>

  </div>
</div>
