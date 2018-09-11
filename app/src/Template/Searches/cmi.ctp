<?php echo $this->element('Blocks/meta_block', ['type'=>'seach']); ?>

<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">

    <!-- main section -->
    <div class="col-xs-12 col-sm-12 col-md-8 ">
          <section id="content" class="article-box">
            <div class="row">

              <div class="col-xs-12 col-md-12 blog-item blog-single">
                <h1 class="rounded">Consumer Medicine Information on <i>myDr</i></h1>

                <p>Choose either “medicine name” or “condition” before entering your search term.</p>
              </div>

            </div>
            <?= $this->Form->create() ?>

                <?php echo $this->Form->input('search_type', ['options' => ['name'=>'Medicine Name', 'condition'=>'Condition']]); ?>
                <?php echo $this->Form->input('search_term'); ?>
                <?= $this->Form->button(__('Submit')) ?>
                <p style="padding-top: 20px"><b>Medicine name:</b> use the commercial <b>brand name</b> of a medication, e.g. Panadol, or the <b>generic name</b>, e.g. paracetamol. If you are unsure of the spelling, just type in the first part of the name.</p>
                <p><b>Condition:</b> type in the name of the <b>health condition</b>, e.g. pain, arthritis, asthma, etc.</p>
                <br />
            <?= $this->Form->end() ?>
            <?php if(isset($search_term)): ?>
                <h2>Result for search term: <?= $search_term; ?></h2>
                <?php foreach ($search_result as $value) { ?>
                    <ul>
                      <li><a href='/medicines/cmis/<?= $value['full_url'] ?>'><?= $value['description'] ?></a></li>
                    </ul>
                <?php } ?>
            <?php endif; ?>
            <br /><br />

            <div class="media-body">
                <p>
                  This screen allows you to search our extensive database of Consumer Medicine Information from Australian pharmaceutical companies.<br />
                  Consumer Medicine Information is often included as a package insert with your medicine, or may be provided by your doctor or pharmacist.<br />
                  CMIs are written in easy-to-understand language, by the pharmaceutical company that produces the medicine. All CMIs must comply with Australian guidelines.
                </p>

                <div id="search-footer">
          				<p>This screen allows you to search our extensive database of Consumer Medicine Information from Australian pharmaceutical companies.</p>
          				<p>Consumer Medicine Information is often included as a package insert /leaflet with your medicine, or may be provided by your doctor or pharmacist.</p>
          				<p>CMIs are written in easy-to-understand language (plain English), by the pharmaceutical company that produces the medicine. All CMIs must comply with Australian guidelines. CMIs are designed to provide information on the safe and effective use of a particular medicine.  CMIs are provided for many prescription and over-the-counter (OTC) or pharmacy medicines.</p>
          				<p>Each CMI follows the same format, with these headings:</p>
          				<ul>
          					<li>What the medicine is used for.</li>
          					<li>Before you take the medicine.</li>
          					<li>How to take the medicines.</li>
          					<li>While you are taking the medicine.</li>
          					<li>Side effects.</li>
          					<li>After taking it.</li>
          					<li>Product description.</li>
          					<li>Sponsor (manufacturer or distributor of the medicine in Australia).</li>
          					<li>Date the CMI was last updated.</li>
          				</ul>
          				<p>CMI documents  tell you what to do if you miss a dose, which other medicines your medicine may interact with, how to store your medicine, what other ingredients are in your medicine, e.g. lactose and what to do with leftover medicine.</p>
          				<p>Not all medicines in Australia have CMI – new prescription medicines are required to have CMI, but not all new over-the-counter medicines require them. If you aren’t given CMI with a medicine, whether it is a new medicine or one you have had before, you can always ask your pharmacist or doctor for the CMI. If the medicine has a CMI they should be able to print you  a copy from their computer.</p>
          				<p>Consumers should be aware that the information provided by the Consumer Medicines Information (CMI) search (CMI Search) is for information purposes only and consumers should continue to obtain professional advice from a qualified healthcare professional regarding any condition for which they have searched for CMI. CMIs are provided by MIMS Australia. CMI is supplied by the relevant pharmaceutical company for each consumer medical product. All copyright and responsibility for CMI is that of the relevant pharmaceutical company. MIMS Australia uses its best endeavours to ensure that at the time of publishing, as indicated on the publishing date for each resource (e.g. Published by MIMS/myDr January 2007), the CMI provided was complete to the best of MIMS Australia's knowledge. The CMI and the CMI Search are not intended to be used by consumers to diagnose, treat, cure or prevent any disease or for any therapeutic purpose. Dr Me Pty Ltd, its servants and agents shall not be responsible for the continued currency of the CMI, or for any errors, omissions or inaccuracies in the CMI and/or the CMI Search whether arising from negligence or otherwise or from any other consequence arising there from.</p>

          			</div>
            </div>

          </section>
    </div>
    <!-- End main section -->
    <?= $this->element('sidebar') ?>

  </div>
</div>
