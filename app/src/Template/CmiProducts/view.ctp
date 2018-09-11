<?php echo $this->element('Blocks/meta_block', ['type'=>'cmis']); ?>
<link href="/css/redesign2011/netstarter/TableStyleSimple.css" rel="stylesheet" type="text/css" />

<!-- Article Start -->
<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">

    <?= $this->element('Boxes/ad_leaderboard') ?>

        <!-- main section -->
        <div class="col-xs-12 col-sm-12 col-md-8 ">
            <section id="content" class="article-box">
                <div class="row">

                        <!-- Blog Listing -->
                        <div class="blog clearfix">
                              <div class="col-xs-12 col-md-12 blog-item blog-single">
                                  <div class="media-list">
                                      <div class="media box">
                                          <div class="media-body" style="width: 100%; display: block;">
                                              <div class="index-links">
                                                <?php
                                                    $AtoZ = "<a href='/medicines/cmis/1-9'>1-9</a>";
                                                    for ($i=ord('A');$i<=ord('Z');$i++) {
                                                        $l = chr($i);
                                                        $AtoZ .= "<a href='/medicines/cmis/".$l."'>".$l."</a>";
                                                    }
                                                    echo $AtoZ;
                                                ?>
                                              </div>
                                              <a class="GoButtonSearch" href="<?= $site_config['s3']['cmis_pdf']."/".$pdf_small_path ?>" target="_new" alt="view as pdf">PDF</a>
                                              <a class="GoButtonSearch" href="<?= $site_config['s3']['cmis_pdf']."/".$pdf_big_path ?>" target="_new" alt="view as pdf">LARGE FONT PDF</a>
                                              <div style="clear: both;"></div>

                                              <?php if($cmi_doc_count < 2){ ?>
                                                <!-- google_ad_section_start -->
												<div id="outstream" style='height:1px; width:1px;'>
												   <script>
													 googletag.cmd.push(function() {
													   googletag.display('outstream');
													 });
												   </script>
												</div>
                                                    <?php /* Article Body here... */ ?>
                                                    <?= $product['cmi_html_document'] ?>
                                                <!-- google_ad_section_end -->
                                              <?php }else{ ?>
                                                <h2><?= $cmiProduct['description'] ?></h2>
                                                <?php $this->Lino->showMultiCmi($cmiProduct); ?>
                                              <?php } ?>

                                            <p class="cmifooter">Consumers should be aware that the information provided by the Consumer Medicines Information (CMI) search (CMI Search) is for information purposes only and consumers should continue to obtain professional advice from a qualified healthcare professional regarding any condition for which they have searched for CMI. CMIs are provided by MIMS Australia. CMI is supplied by the relevant pharmaceutical company for each consumer medical product. All copyright and responsibility for CMI is that of the relevant pharmaceutical company. MIMS Australia uses its best endeavours to ensure that at the time of publishing, as indicated on the publishing date for each resource (e.g. Published by MIMS/myDr January 2007), the CMI provided was complete to the best of MIMS Australia's knowledge. The CMI and the CMI Search are not intended to be used by consumers to diagnose, treat, cure or prevent any disease or for any therapeutic purpose. Dr Me Pty Limited, its servants and agents shall not be responsible for the continued currency of the CMI, or for any errors, omissions or inaccuracies in the CMI and/or the CMI Search whether arising from negligence or otherwise or from any other consequence arising there from.</p>

                                              <?php /*last reviewed date...*/ ?>
                                              <div class="related-content">
                                                  <div class="panel-heading col-xs-12">
                                                      <h4 class="panel-title">You may also like</h4>
                                                  </div>
                                                  <div data-sj-related data-sj-maxresults="3" class="sj-related-content"></div>
                                              </div> <!-- END related-content END-->
                                          </div> <!-- END media-body END -->

                                      </div>
                                  </div>
                                  <?php /*
                                  <ul class="pager">
                                  <li class="previous"><a href="#">&larr; Title of Previous Article</a></li>
                                  <li class="next"><a href="#">Title of Next Article &rarr;</a></li>
                                  </ul>
                                  */ ?>
                              </div> <!-- END blog-single -->

                        </div>
                        <!-- END Blog Listing -->

                </div>
            </section>
        </div>
        <!-- End main section -->

        <?php
        # Survey for CMI
        if($survey_modal === false):
          echo $this->element('survey_form',['cmi_id' => $cmiProduct]);
        endif;
        ?>

        <?php /* Sidebar(Right hand side) */ ?>
        <?= $this->element('sidebar_cmis', ['latest_articles' => $recentarticles]) ?>

  </div>
</div>
