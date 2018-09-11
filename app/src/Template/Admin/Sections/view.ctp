<section class="fluid-container feature-slider-container">
    <div class="container position-relative">
        <div class="row">
            <div class="col-xs-12 col-sm-6 h1-tag category-textcontainer">
                <h1 class="category-heading"><?= h($section->name) ?></h1>
                <p><?= $this->Text->autoParagraph(h($section->body)); ?></p>
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
                        foreach ($section->articles as $articles):
                            if($i < 3):
                                $active = '';
                                if($i == 0){
                                    $active = 'active';
                                }
                                echo $this->element(
                                  'Commons/carousel-detail',
                                  ['articles' => $articles, 'active' => $active]
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


<!-- Latest News -->

<?php
if (!empty($section->articles)): ?>
<section class="container featured-container">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Top Articles</h2>
        </div>

        <div class="prop-item col-sm-12 col-md-4">
            <?php
            echo $this->element(
              'Commons/repeat-big1',
              ['articles' => $section->articles[0]]
            );
            ?>
        </div>
        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
            <?php
            $i = 0;
            foreach ($section->articles as $articles):
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
                <div class="row">
                    <?php
                    $i = 0;
                    foreach ($section->articles as $articles):
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
    </div>
</section>
<!-- Latest News -->
<?php endif;?>

<?php
if (!empty($section->articles)): ?>
    <section class="container featured-container">
        <div class="row">
            <div class="row-title col-xs-12">
                <h2>Top Medicines</h2>
            </div>

            <div class="prop-item col-sm-12 col-md-4">
                <?php
                echo $this->element(
                  'Commons/repeat-big1',
                  ['articles' => $section->articles[0]]
                );
                ?>
            </div>
            <div class="prop-item col-xs-12 col-sm-6 col-md-4">
                <div class="row">
                    <?php
                    $i = 0;
                    foreach ($section->articles as $articles):
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
                <div class="mrec">
                    <p>ADVERTISEMENT</p>
                    <img src="https://s0.2mdn.net/viewad/4476627/300x250_MREC_HealthEngine_PensionSaving.gif" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Top Medicines -->
<?php endif;?>

<?php
if (!empty($section->articles)): ?>
<section class="container featured-container">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Tools</h2>
        </div>
        <?php
        $i = 0;
        foreach ($section->articles as $articles):
            if($i > 0 && $i < 5):
                echo $this->element(
                  'Commons/repeat2',
                  ['articles' => $articles]
                );
                ?>
            <?php endif;
            $i++;
        endforeach;?>
    </div>
</section>
    <!-- Tools -->
<?php endif;?>



<section class="container featured-container">
    <div class="row">

        <div class="row-title col-xs-12">
            <h2>Recently Updated</h2>
        </div>
        <?php for($n = 1; $n <= 3; $n++):?>
        <div class="prop-item col-sm-12 col-md-4">
            <?php
            echo $this->element(
              'Commons/repeat-big2',
              ['articles' => $section->articles[0]]
            );
            ?>
            <div class="row">
                <?php
                $i = 0;
                foreach ($section->articles as $articles):
                    if($i > 0 && $i < 4):
                        echo $this->element(
                          'Commons/repeat3',
                          ['articles' => $articles]
                        );
                        ?>
                    <?php endif;
                    $i++;
                endforeach;?>
            </div>
        </div>
        <?php endfor;?>

    </div>
</section>

