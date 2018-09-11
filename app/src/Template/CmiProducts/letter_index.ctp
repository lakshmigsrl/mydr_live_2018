<?php echo $this->element('Blocks/meta_block', ['type'=>'cmi_index']); ?>
<link href="/css/redesign2011/netstarter/TableStyleSimple.css" rel="stylesheet" type="text/css" />

<!-- Article Start -->
<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">


        <!-- main section -->
        <div class="col-xs-12 col-sm-12 col-md-8 ">
            <section id="content" class="article-box">
                <div class="row">

                        <!-- Blog Listing -->
                        <div class="blog clearfix">
                              <div class="col-xs-12 col-md-12 blog-item blog-single">
                                  <div class="media-list">
                                      <div class="media box">
                                          <div class="media-body">
                                              <div class="index-links">
                                                <?php
                                                    $AtoZ = "<a href='/medicines/cmis/1-9'>1-9</a>";
                                                    for ($i=ord('A');$i<=ord('Z');$i++) {
                                                        $l = chr($i);
                                                        $classStr="";
                                                        if($l == $letter){
                                                            $classStr = "class='active'";
                                                        }
                                                        $AtoZ .= "<a href='/medicines/cmis/".$l."' ".$classStr.">".$l."</a>";
                                                    }
                                                    echo $AtoZ;
                                                ?>
                                              </div>

                                              <h1>Medicines Index - <?= $letter ?></h1>
                                              <p>Medicines with brand names starting with <?= $letter ?>.</p>
                                              <ul>
                                              <?php foreach ($cmiProducts as $cmi){ ?>
                                                  <li><a href="/medicines/cmis/<?= $cmi->full_url ?>"><?= $cmi->description ?></a></li>

                                              <?php } ?>
                                            </ul>

                                              <?php /*last reviewed date...*/ ?>
                                              <div class=" related-content">
                                                  <div class="panel-heading col-xs-12">
                                                      <h4 class="panel-title">You may also like</h4>
                                                  </div>
                                                  <div data-sj-related data-sj-maxresults="3" ></div>
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

        <?php /* Sidebar(Right hand side) */ ?>
        <?= $this->element('sidebar_cmis', ['latest_articles' => $recentarticles]) ?>

  </div>
</div>
