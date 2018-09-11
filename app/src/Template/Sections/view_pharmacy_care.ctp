<?php echo $this->element('Blocks/meta_block', ['type'=>'sections']); ?>

<section class="fluid-container feature-slider-container">
    <div class="container position-relative">
        <div class="row">
            <div class="col-xs-12 col-sm-6 h1-tag category-textcontainer">
                <h1 class="category-heading"><?= h($section->name) ?></h1>
                <p><?= $this->Text->autoParagraph($section->body); ?></p>
            </div>
            <!-- Carousel Start -->

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

        </div>

    </div>
</section>


<!-- Introduction -->
<section class="container featured-container">
    <div class="row">
          <div class="row-title col-xs-12">
              <h2>Introduction</h2>
          </div>
          <ul style="clear: both;">
                      <li><a href="/pharmacy-care/pharmacy-care-important-information">Pharmacy Care: important information</a></li>
                      <li><a href="/pharmacy-care/how-to-use-pharmacy-care">How to use Pharmacy Care</a></li>
                  <li><a href="/pharmacy-care/about-your-pharmacist">About your pharmacist</a></li>
                  <li><a href="/pharmacy-care/other-products-you-may-be-taking">Other products you may be taking</a></li>
          </ul>
    </div>
</section>
<!-- END Introduction -->

<!-- Top Articles -->
<?php
if (!empty($common_conditions)): ?>
<section class="container featured-container">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Common Conditions</h2>
            <p>Here are some common conditions that people sometimes manage with help from their pharmacist.</p>
        </div>

        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
            <?php
                $i = 0;
                foreach ($common_conditions as $articles){
                    if($i < 24){
                        echo $this->element(
                          'Commons/repeat1',
                          ['articles' => $articles]
                        );
                    }
                    $i++;
                }
            ?>
            </div>
        </div>
        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
              <?php
                  $i = 0;
                  foreach ($common_conditions as $articles){
                      if($i > 23 && $i < 50){
                          echo $this->element(
                            'Commons/repeat1',
                            ['articles' => $articles]
                          );
                      }
                      $i++;
                  }
              ?>
            </div>
        </div>
        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
              <?php
                  $i = 0;
                  foreach ($common_conditions as $articles){
                      if($i > 49 && $i < 75){
                          echo $this->element(
                            'Commons/repeat1',
                            ['articles' => $articles]
                          );
                      }
                      $i++;
                  }
              ?>
            </div>
        </div>
    </div>
</section>
<?php endif;?>
<!-- END Top Articles -->



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


<!-- Change this to top news withing the section -->
<?php if(!empty($section->articles)): ?>
<section class="container featured-container">
    <div class="row">

        <div class="row-title col-xs-12">
            <h2>Recommended</h2>
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
<?php endif; ?>
