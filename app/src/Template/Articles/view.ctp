<?php echo $this->element('Blocks/meta_block', ['type'=>'articles']); ?>

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
                      <?php if(isset($article['page_image'])): ?>
                      <div class="col-xs-12">
                           <div class="thumbnail article-img">
                              <img src="<?= $article->page_image ?>" />
                          </div>
                      </div>
                <?php endif; ?>
                  <div class="col-xs-12 col-md-12 blog-item blog-single">
                      <div class="media-list">
                          <div class="media box">

                              <!-- <div class="media-body"> -->
                                <!-- google_ad_section_start -->
                                <?php /*Article Title here...*/ ?>
                                <h1><?= h($article->title) ?></h1>
                                <span class="item-meta">
                                  <?php
                                  if($article->format_type === "news"):
                                    if(isset($article->start_date)){
                                      echo date(DATE_FORMAT, strtotime($article->start_date));
                                    }else{
                                      echo date(DATE_FORMAT, strtotime($article->created));
                                    }
                                  endif;
                                  ?>
                                </span>
                                
                                <?php /* Article video here... */ ?>
                                <div class='videoContainer' style="padding-bottom:15px">                                  
                                   <?php
                                    if((isset($article->article_video))&&($article->article_video!="")){
                                      ?>
                                        <script src="http://player.tonicdirect.com/players/<?php echo $article->article_video;?>-VeUrTY88.js"></script>
                                      <?php
                                    }else{
                                      echo $article->article_video;
                                    }
                                  ?>
                                </div>
                                <?php /* Article Body here... */ ?>
								<div id="outstream" style='height:1px; width:1px;'>
								   <script>
									 googletag.cmd.push(function() {
									   googletag.display('outstream');
									 });
								   </script>
								</div>
                                <div class='contentContainer'>
                                  <?= $article->body ?>
                                </div>
                                <?php /* p402_premium is Google survey code. */ ?>
                                <!-- google_ad_section_end -->

                                <?php /*last reviewed date...*/ ?>
                                <span class="item-meta">
                                  Last Reviewed: <?= date(DATE_FORMAT, strtotime($article->reviewed)) ?> <br />
                                  <?= $article->footer->value ?>

                                  <?php
                                    //if (isset($this->data['Copyright']['value'])) {
                                    //  echo "&copy;" . $this->data['Copyright']['value'] . "<br />";
                                    //} else if ($SHORT_COPYRIGHT) {
                                    //  echo "&copy;" . $SHORT_COPYRIGHT . "<br />";
                                    //}
                                  ?>
                                </span>

                                <?= $this->element('Commons/references', ['references' => $article->reference]) ?>
                                <?= $this->element('Commons/author_detail', ['author' => $article->author, 'article' => $article]) ?>

                                <div class=" related-content">
                                    <div class="panel-heading col-xs-12">
                                        <h4 class="panel-title">You may also like</h4>
                                    </div>
                                    <div data-sj-related data-sj-maxresults="3" ></div>
                                </div> <!-- END related-content END-->
                              <!-- </div>  -->
                              <!-- END media-body END -->

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
