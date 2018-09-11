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
                  <div class="col-xs-12">
                       <div class="thumbnail article-img">
                          <img src="<?= h($article->main_image) ?>" />
                      </div>
                  </div>
                  <div class="hidden-xs hidden-sm col-md-1">
                      <img src="/css/bootify/img/social.png" alt="">
                      <!-- Go to www.addthis.com/dashboard to customize your tools -->
                      <div class="addthis_sharing_toolbox"></div>
                  </div>

                  <div class="col-xs-12 col-md-11 blog-item blog-single">
                      <div class="media-list">
                          <div class="media box">

                              <div class="media-body">
                                <!-- google_ad_section_start -->
                                <?php /*Article Title here...*/ ?>
                                <h1><?= h($article->title) ?></h1>
                                <span class="item-meta">
                                  <?php
                                  if(isset($article->start_date)){
                                    echo date(DATE_FORMAT, strtotime($article->start_date));
                                  }else{
                                    echo date(DATE_FORMAT, strtotime($article->created));
                                  }
                                  ?>
                                </span>

                                <?php /* Article Body here... */ ?>
                                  <?= $article->body ?>
                                <?php /* p402_premium is Google survey code. */ ?>
                                <!-- google_ad_section_end -->

                                <?php /*last reviewed date...*/ ?>
                                <span class="item-meta">
                                  Last Reviewed: <?php //echo $dateDisp; ?> <br />
                                  <?= $article->footer->name ?>

                                  <?php
                                    //if (isset($this->data['Copyright']['value'])) {
                                    //  echo "&copy;" . $this->data['Copyright']['value'] . "<br />";
                                    //} else if ($SHORT_COPYRIGHT) {
                                    //  echo "&copy;" . $SHORT_COPYRIGHT . "<br />";
                                    //}
                                  ?>
                                </span>
                                <div class="col-xs-12">
                                    <div class="tag-container grey-border">
                                        <i class="fa fa-share-alt"></i>
                                        <a href="https://www.facebook.com/myDr.com.au"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/mydrwebsite"><i class="fa fa-twitter"></i></a>
                                        <a href="http://www.linkedin.com/company/my-dr"><i class="fa fa-linkedin"></i></a>
                                        <a href="https://plus.google.com/+mydrcomau"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                </div>
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
        <?= $this->element('sidebar') ?>


  </div>
</div>
