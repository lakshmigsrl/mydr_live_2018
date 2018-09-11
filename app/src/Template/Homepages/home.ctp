<?php echo $this->element('Blocks/meta_block',['type'=>'home']); ?>

<section class="fluid-container feature-slider-container">
  <div class="container position-relative">
    <div class="row">
      <div class="col-xs-12 h1-tag">
        <h1>Reliable Australian health and medicines information</h1>
        <p>myDr provides reliable Australian health information, <a href="/tools">health tools </a> and calculators covering <a href="/symptoms">symptoms</a>, diseases, <a href="/tests-investigations">tests &amp; investigations</a>, <a href="/medicines">medicines</a>, treatments, <a href="/nutrition-weight">nutrition</a> and <a href="/sports-fitness">fitness</a>.</p>
      </div>
      <!-- Carousel Start -->

      <!-- The carousel -->
      <div class="col-xs-12 col-sm-8">
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
            foreach ($promotions as $promo):
              // Display featured articles #1-#3 in the carousel
              if($i < 3):
                $active = '';
                if($i == 0){
                  $active = 'active';
                }
                echo $this->element(
                  'Commons/carousel-detail',
                  ['home_slide' => $promo, 'active' => $active]
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
      <div class="col-xs-12 col-sm-12 col-md-4 position-relative tool-squares">
        <div class="row">
          <div class="col-xs-12">
          </div>
          <div class="col-xs-6">
            <a href="/tools/bmi-calculator" class="thumbnail">
              <img class="img-responsive full-width" src="/img/bmi-calculator.jpg" alt="BMI Calculator">
            </a>
          </div>
          <div class="col-xs-6">
            <a href="/search/cmi" class="thumbnail">
              <img class="img-responsive full-width" src="/img/find-medicine.jpg" alt="Find a Medicine">
            </a>
          </div>
          <div class="col-xs-6">
            <a href="/tools/calories-burned-calculator" class="thumbnail">
              <img class="img-responsive full-width" src="/img/calories-burned-calculator.jpg" alt="Calories Burned Calculator">
            </a>
          </div>
          <div class="col-xs-6">
            <a href="/symptoms" class="thumbnail">
              <img class="img-responsive full-width" src="/img/symptoms.jpg" alt="Symptoms Tool">
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- Featured Health Topics -->
<section class="container featured-container">
  <div class="row">
    <div class="row-title col-xs-12">
      <h2>Featured Health Topics</h2>
    </div>

    <div class="prop-item col-xs-12 col-sm-12 col-md-4">
      <?php
        $i = 0;
        foreach ($promotions as $promo){
          // Display featured article #4 in a large panel
          if($i == 3){
            echo $this->element(
              'Commons/repeat-big1',
              ['articles' => $promo->article]
            );
          }
          $i++;
        }
      ?>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-4">
      <div class="row">
        <?php
          $i = 0;
          foreach ($promotions as $promo){
            // Display featured articles #5-#7 in a small panel
            if($i > 3 && $i < 7){
              echo $this->element(
                'Commons/repeat1',
                ['articles' => $promo->article]
              );
            }
            $i++;
          }
        ?>
      </div>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-4">
      <div class="mrec">
        <div class="sidebar-mrec">
          <div class="f-adbanner advertisement mrec1" >
            <div id='square_ad' class="advLabel">
              <span class="advertisetmentHeader">Advertisement</span>
              <script type='text/javascript'>
                googletag.cmd.push(function() { googletag.display('square_ad'); });
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container featured-container">
  <div class="row">

    <div class="row-title col-xs-12">
      <h2>Recently Updated</h2>
    </div>
    <?php
        $ctrLatch = 0;
        for($n = 0; $n < 12; $n++){
            if($ctrLatch == 0){
              echo "<div class='prop-item col-xs-12 col-sm-12 col-md-4'>";
                $ctrLatch = 4;
                echo $this->element(
                  'Commons/repeat-big2',
                  ['articles' => $all_articles[$n]]
                );
            }else{
              echo "<div class='row'>";
                echo $this->element(
                  'Commons/repeat3',
                  ['articles' => $all_articles[$n]]
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

<!-- Featured Articles -->

<section class="container featured-container">
  <div class="row">
    <div class="row-title col-xs-12">
      <h2>Health Information by Age and Gender</h2>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-15">
      <div class="thumbnail">
        <div class="thumbnail-container">
          <a href="/babies-pregnancy"><img alt="Babies & Pregnancy" src="/img/homepage_static/babies_pregnancy_2016.jpg"></a>
        </div>

        <div class="thumbnail-body border-bottom-red">
          <div class="caption">
            <h4>Babies & Pregnancy</h4>
            <p>Browse information on <a href="/babies-pregnancy">Babies &amp; Pregnancy</a>, including <a href="/babies-pregnancy/contraception-the-mini-progestogen-only-pill">the mini pill</a>, <a href="/babies-pregnancy/baby-s-development-in-the-womb">baby's development in the womb</a>, <a href="/babies-pregnancy/morning-sickness">morning sickness</a>, tests during pregnancy, <a href="/babies-pregnancy/miscarriage-overview">miscarriage</a>, <a href="/babies-pregnancy/postnatal-depression-what-is-it">postnatal depression</a>, <a href+"/respiratory-health/whooping-cough-overview">whooping cough</a>, <a href="/babies-pregnancy/paracetamol-for-children">paracetamol for children</a> and much more.</p>                            </div>
        </div>
      </div>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-15">
      <div class="thumbnail">
        <div class="thumbnail-container">
          <a href="/kids-teens-health"><img alt="Kids' & Teens' Health" src="/img/homepage_static/kids__teens_2016.jpg"></a>
        </div>

        <div class="thumbnail-body border-bottom-red">
          <div class="caption">
            <h4>Kids' & Teens' Health</h4>
            <p><a href="/skin-hair/childhood-rashes">Childhood rashes</a>, <a href="/nutrition-weight/childhood-obesity">childhood obesity</a>, <a href="/kids-teens-health/middle-ear-infection-and-grommets">middle ear infection and grommets</a>, <a href="/kids-teens-health/appendicitis">appendicitis</a>, common childhood concerns such as <a href="/kids-teens-health/threadworms-pinworms">threadworms</a> and <a href="/mental-health/adhd-symptoms-and-diagnosis">ADHD</a>, infectious diseases such as <a href="/kids-teens-health/glandular-fever">glandular fever</a> and <a href="/kids-teens-health/meningitis-in-children">meningitis</a>, and much more in <a href="/kids-teens-health">Kids' & Teen's Health</a>. </p>                            </div>
        </div>
      </div>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-15">
      <div class="thumbnail">
        <div class="thumbnail-container">
          <a href="/mens-health"><img alt="Men's Health" src="/img/homepage_static/mens_health_2016.jpg"></a>
        </div>

        <div class="thumbnail-body border-bottom-red">
          <div class="caption">
            <h4>Men's Health</h4>
            <p>Information about <a href="/mens-health/vasectomy-frequently-asked-questions">vasectomy</a>, <a href="/mens-health/vasectomy-frequently-asked-questions">prostate enlargement</a>, <a href="/mens-health/testicular-cancer">testicular cancer</a>, <a href="/sexual-health/impotence-causes">impotence</a>, and <a href="/skin-hair/hair-loss-overview">hair loss</a>, plus tools for <a href="/tools/prostate-symptoms-assessment">prostate symptoms</a> and <a href="/tools/erectile-dysfunction-tool">erectile dysfunction</a>.</p>                            </div>
        </div>
      </div>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-15">
      <div class="thumbnail">
        <div class="thumbnail-container">
          <a href="/womens-health"><img alt="Women's Health" src="/img/homepage_static/womens_health_2016.jpg"></a>
        </div>

        <div class="thumbnail-body border-bottom-red">
          <div class="caption">
            <h4>Women's Health</h4>
            <p>Browse common women's concerns, such as <a href="/womens-health/vulval-problems-a-self-help-guide">vulval problems</a>, <a href="/womens-health/vaginal-thrush">vaginal thrush</a>, <a href="/womens-health/menopause-what-you-can-expect">menopause</a>, <a href="/heart-stroke/iron-deficiency-anaemia">iron-deficiency anaemia</a>, <a href="/pharmacy-care/cystitis-self-care">cystitis</a>, <a href="/womens-health/period-pain">period pain</a>, <a href="/womens-health/polycystic-ovary-syndrome">polycystic ovary syndrome</a>, and treatments such as <a href="/womens-health/hormone-replacement-therapy">hormone replacement therapy</a>.</p>                            </div>
        </div>
      </div>
    </div>
    <div class="prop-item col-xs-12 col-sm-6 col-md-15">
      <div class="thumbnail">
        <div class="thumbnail-container">
          <a href="/seniors-health"><img alt="Seniors' Health" src="/img/homepage_static/seniors_health_2016.jpg"></a>
        </div>

        <div class="thumbnail-body border-bottom-red">
          <div class="caption">
            <h4>Seniors' Health</h4>
            <a href="/arthritis/osteoarthritis">Osteoarthritis</a>, <a href="/skin-hair/shingles">shingles</a>, <a href="/seniors-health/osteoporosis-what-it-does-to-your-bones">osteoporosis</a>, <a href="/seniors-health/dementia-behavioural-and-psychological-symptoms">dementia</a>, <a href="/arthritis/gout">gout</a>, <a href="/diabetes">diabetes</a>, <a href="/seniors-health/depression-in-older-people">depression in older people</a>, <a href="/heart-stroke/high-blood-pressure-overview">high blood pressure</a>, <a href="/heart-stroke/cholesterol-overview">high cholesterol</a>, <a href="/heart-stroke/heart-disease-reduce-the-risk">heart disease</a> and <a href="/heart-stroke/stroke-signs-symptoms-and-treatment">stroke</a> are common conditions which affect the elderly. Find out more in <a href="/seniors-health">Seniors' Health</a>.                            </div>
        </div>
      </div>
    </div>

  </div>
</section>
