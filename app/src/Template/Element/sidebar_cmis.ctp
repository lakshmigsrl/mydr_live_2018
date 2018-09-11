<!-- Sidebar (right hand side) -->
      <div class="col-xs-12 col-sm-12 col-md-4">
        <section >
              <!-- Sidebar for Single Listing -->
              <div class="row">
                <div class="aside-product-blog">

                  <?php if(!empty($cmi_related_articles)):?>
                    <?= $this->element('Boxes/related_articles', ['related_articles' => $cmi_related_articles]) ?>
                  <?php endif;?>
                  <?= $this->element('Boxes/ad_mrec_top') ?>
                  <?= $this->element('Boxes/recommended_articles', ['recommended_articles' => $latest_articles]) ?>

                </div>
              </div>
              <!-- End Sidebar -->
        </section>
      </div>
