<!-- Sidebar (right hand side) -->
      <div class="col-xs-12 col-sm-12 col-md-4">
        <section >
              <!-- Sidebar for Single Listing -->
              <div class="row">
                <div class="aside-product-blog">

                  <?php if(!empty($related_articles)):?>
                    <?= $this->element('Boxes/related_articles', ['related_articles' => $related_articles]) ?>
                  <?php endif;?>

                      <div class="col-xs-12">
                        <div class="sidebar-box overflow-hidden medicine-widget">
                          <a href="/search/cmi" class="">
                            <img class="img-responsive pull-left medicine-widget-img" src="/img/find-medicine.png" alt="Find a Medicine">
                            <h3>Find a Medicine</h3>
                          </a>
                        </div>
                      </div>
                  
                  </div>

                  <?= $this->element('Boxes/ad_mrec_top') ?>
                  <?= $this->element('Boxes/recommended_articles', ['recommended_articles' => $latest_articles]) ?>

                </div>
              </div>
              <!-- End Sidebar -->
        </section>
      </div>
