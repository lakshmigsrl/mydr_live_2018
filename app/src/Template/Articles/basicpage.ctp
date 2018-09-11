<?php echo $this->element('Blocks/meta_block', ['type'=>'articles']); ?>

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
                                <!-- google_ad_section_start -->
                                <?php /*Article Title here...*/ ?>
                                <h1><?= h($article->title) ?></h1>

                                <?php /* Article Body here... */ ?>
                                  <?= $article->body ?>
                                <?php /* p402_premium is Google survey code. */ ?>
                                <!-- google_ad_section_end -->

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
        <?= $this->element('sidebar') ?>


  </div>
</div>
