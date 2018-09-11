<link href="/css/redesign2011/netstarter/Styles_Structural.css" rel="stylesheet" type="text/css" />
<?php echo $this->Html->script('http://code.jquery.com/jquery-1.12.4.min.js');?>

<?php echo $this->element('Blocks/meta_block', ['type'=>'sections']); ?>
<section class="fluid-container feature-slider-container">
    <div class="container position-relative">
        <div class="row">
            <div class="col-xs-12 col-sm-12 h1-tag category-textcontainer">
                <h1 class="category-heading">Medicines Health Centre</h1>
                <p><?= $this->Text->autoParagraph($section->body); ?></p>
            </div>
            <!-- Carousel Start -->

            <?php if(0): ?>
            <!-- The carousel -->
            <div class="col-xs-12 col-sm-6">
                <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#transition-timer-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#transition-timer-carousel" data-slide-to="1"></li>
                        <li data-target="#transition-timer-carousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                        <?php
                        $i = 0;
                        foreach ($section->section_slides as $slide):
                            if($i < 3):
                                $active = '';
                                if($i == 0){
                                    $active = 'active';
                                }
                                echo $this->element(
                                  'Commons/carousel-detail-section',
                                  ['slide' => $slide, 'active' => $active]
                                );
                                ?>
                            <?php endif;
                            $i++;
                        endforeach;?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#transition-timer-carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#transition-timer-carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                    <!-- Timer "progress bar" -->
                    <hr class="transition-timer-carousel-progress-bar animate" />
                </div>
            </div>
            <!-- End Carousel -->
          <?php endif; ?>

        </div>

    </div>
</section>


<!-- Introduction -->
<section class="container featured-container">
    <div class="row">
          <div class="row-title col-xs-12">
              <h2>&nbsp;</h2>

              <p>Choose either “medicine name” or “condition” before entering your search term.</p>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6 ">
              <?= $this->Form->create(null, ['url' => ['controller' => 'Search', 'action' => 'cmi']]) ?>

                  <?php echo $this->Form->input('search_type', ['options' => ['name'=>'Name', 'condition'=>'Condition']]); ?>
                  <?php echo $this->Form->input('search_term'); ?>
                  <?= $this->Form->button(__('Submit')) ?>
                  <p style="padding-top: 20px"><b>Medicine name:</b> use the commercial <b>brand name</b> of a medication, e.g. Panadol, or the <b>generic name</b>, e.g. paracetamol. If you are unsure of the spelling, just type in the first part of the name.</p>
                  <p><b>Condition:</b> type in the name of the <b>health condition</b>, e.g. pain, arthritis, asthma, etc.</p>

                  <br /><br />
              <?= $this->Form->end() ?>
          </div>
    </div>
</section>
<!-- END Introduction -->

<!-- A to Z -->
<section class="container featured-container">
    <div class="row">
            <div class="row-title col-xs-12">
                <h2>Medicines Index</h2>

            </div>
            <div class="row-title col-xs-12">
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
          </div>
    </div>
</section>
<!-- END A to Z -->

<!-- Medicines tab -->
<section class="container featured-container">
    <div class="row">
          <div class="row-title col-xs-12">
              <h2>Browse Medicines</h2>
          </div>
          <div class="row-title col-xs-12">
              <?= $this->element('medicines_tabs') ?>
            </div>
      </div>
  </section>
  <!-- END Medicines tab -->


<!-- Top Articles -->
<?php if (!empty($section->top_articles)): ?>
<section class="container featured-container">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Top Medicine Articles</h2>
        </div>

        <div class="prop-item col-xs-12 col-sm-12 col-md-4">
            <?php
            echo $this->element(
              'Commons/repeat-big1',
              ['articles' => $section->top_articles[0]]
            );
            ?>
        </div>
        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
            <?php
            $i = 0;
            foreach ($section->top_articles as $articles):
                if($i > 0 && $i < 4):
                    echo $this->element(
                      'Commons/repeat1',
                      ['articles' => $articles]
                    );
                ?>
            <?php endif;
                $i++;
            endforeach;?>
            </div>
        </div>
        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
                <?php
                $i = 0;
                foreach ($section->top_articles as $articles):
                    if($i > 3 && $i < 7):
                        echo $this->element(
                          'Commons/repeat1',
                          ['articles' => $articles]
                        );
                        ?>
                    <?php endif;
                    $i++;
                endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php endif;?>
<!-- END Top Articles -->


<!-- Tools -->
<!-- END Tools -->



<!-- Top Medicines -->
<?php if(!empty($section->top_medicines)): ?>
<section class="container featured-container">
    <div class="row">

        <div class="row-title col-xs-12">
            <h2>Top Medicines</h2>
        </div>

        <?php foreach ($section->top_medicines as $medicine):
            echo $this->element( 'Commons/cmi_box', ['medicine' => $medicine]);
        endforeach; ?>
    </div>
</section>
<?php endif; ?>
<!-- END Top Medicines -->


<!-- Latest news -->
<?php if (!empty($section->articles)): ?>
<section class="container featured-container">
    <div class="row">

        <div class="row-title col-xs-12">
            <h2>Medicine News - <?php echo $section->name;?></h2>
        </div>
        <?php
            $ctrLatch = 0;
            for($n = 0; $n < 12; $n++){
                if(!isset($section->articles[$n])){
                  break;
                }
                if($ctrLatch == 0){
                  echo "<div class='prop-item col-xs-12 col-sm-12 col-md-4'>";
                    $ctrLatch = 4;
                    echo $this->element(
                      'Commons/repeat-big2', [
                          'section_url' => $section->url,
                          'articles' => $section->articles[$n]
                      ]
                    );
                }else{
                  echo "<div class='row'>";
                    echo $this->element(
                      'Commons/repeat3', [
                          'section_url' => $section->url,
                          'articles' => $section->articles[$n]
                      ]
                    );
                  echo "</div>";
                }
                $ctrLatch--;
                if($ctrLatch == 0){
                  echo "</div>";
                }
            }
        ?>

    </div>
</section>
<?php endif;?>
<!-- END Latest news -->

<?php echo $this->Html->script('sectionf'); ?>
