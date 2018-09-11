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


<!-- Top Articles -->
<?php if (!empty($section->top_articles)): ?>
<section class="container featured-container">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Top Articles</h2>
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
    <div class="row">
        <?php
        $i = 0;
        foreach ($section->top_articles as $articles):
            if($i > 6 && $i < 16):?>
                <div class="prop-item col-xs-12 col-sm-6 col-md-4">
                    <div class="row">
                <?php
                echo $this->element(
                  'Commons/repeat1',
                  ['articles' => $articles]
                );
                ?>
                    </div>
                </div>
            <?php endif;
            $i++;
        endforeach;?>
    </div>
</section>
<?php endif;?>
<!-- END Top Articles -->

<!-- END Tools -->
<?php if (!empty($section->tools)): ?>
<section class="container featured-container section-tool">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Tools</h2>
        </div>
        <?php foreach ($section->tools as $tool):
                echo $this->element(
                  'Commons/tool_box',
                  ['tool' => $tool]
                );
        endforeach;?>
    </div>
</section>
<?php endif;?>
<!-- END Tools -->


<!-- Top Medicines -->
<?php if (!empty($section->top_medicines)): ?>
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
<?php endif;?>
<!-- END Top Medicines -->


<!-- Latest news -->
<?php if (!empty($section->articles)): ?>
<section class="container featured-container">
    <div class="row">

        <div class="row-title col-xs-12">
            <h2>Latest News - <?php echo $section->name;?></h2>
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
