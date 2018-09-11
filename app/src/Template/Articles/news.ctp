<?php echo $this->element('Blocks/meta_block', ['type'=>'static', 'page_title' => 'Latest Health News']); ?>

<div class="container">
       <div class="row row-offcanvas-sm row-offcanvas-sm-right box-padding">


           <div class="col-md-8">
                <section id="content">
                   <div class="row">
                       <!-- Blog Listing -->
                       <div class="blog clearfix">
                           <div class="col-md-12">
                               <button type="button" class="btn btn-flat-asbestos btn-icon hidden-md hidden-lg hidden-xs pull-right" data-toggle="offcanvas-sm">
                                   <i class="fa fa-share"></i> Recent Articles &amp; Categories
                               </button>
                               <div class="clearfix"></div>
                           </div>

                           <div class="col-sm-12 col-md-12 blog-item">
                             <div class="box">
                               <h1>Latest Health News</h1>
                               <p>Get the latest health and medical news from Australia and round the world every day, including news stories about nutrition, diets, health conditions, medicines and treatments.</p>
                             </div>
                               <div class="box">
                                   <ul class="media-list">
                                      <?php foreach($articles as $art): ?>
                                          <li class="media">
                                            <?php echo $this->element('Commons/news_box', ['news' => $art]); ?>
                                          </li>
                                      <?php endforeach; ?>
                                   </ul>
                               </div>

                               <div class="pagination-listing">
                                  <!-- Pagination -->
                                  <ul class="pagination">
                                     <?php
                                              /*
                                                There is an issue about this at github.
                                                https://github.com/cakephp/cakephp/issues/7324
                                                Workaround is also discussed.                                                 
                                              */
                                              $this->Paginator->options(['url' => ['sort' => null, 'direction' => null]]);
                                     ?>
                                     <li><?= $this->Paginator->prev(__('<i class="fa fa-chevron-left"></i> Previous'), ['escape' => false]) ?></li>
                                     <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                                     <li><?= $this->Paginator->next(__('Next') . '  <i class="fa fa-chevron-right"></i>', ['escape' => false]) ?></li>
                                  </ul>
                                  <!-- end Pagination -->
                               </div>
                           </div>

                       </div>
                   </div>
                </section>
          </div>

          <?php /* Sidebar(Right hand side) */ ?>
          <?= $this->element('sidebar') ?>
    </div>
</div>
