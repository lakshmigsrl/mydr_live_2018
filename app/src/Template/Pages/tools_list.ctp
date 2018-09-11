<?php #echo $this->element('Blocks/meta_block', ['type'=>'articles']); ?>

<!-- Article Start -->
<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">


    <!-- main section -->
    <div class="col-xs-12 col-sm-12 col-md-8 ">
      <section id="content" class="article-box">
        <h1>Health Tools</h1>
        <p style="clear:both;">
          <img src="/files/images/sections/health_tools.jpg" alt="health tools" />
        <p>
          Use our tools and calculators to assess the status of your health and wellbeing, and take the risk tests to find out your chance of developing certain diseases.
        </p>
        </p>
        <h3>Medical Dictionary</h3>
        <ul>
          <li><a href='/medical-dictionary'>Medical Dictionary</a></li>

        </ul>
        <h3>Calculators</h3>
        <ul>
          <li><a href="/tools/alcohol-calculator" >Alcohol Calculator</a></li>
          <li><a href="/tools/baby-due-date-calculator" >Baby Due Date Calculator</a></li>
          <li><a href="/tools/basal-energy-calculator" >Basal Metabolic Rate Calculator</a></li>
          <li><a href="/tools/bmi-calculator" >Body Mass Index (BMI) Calculator</a></li>
          <li><a href="/tools/calories-burned-calculator" >Calories Burned Calculator </a></li>
          <li><a href="/tools/child-energy-calculator" >Child Energy Requirements Calculator</a></li>
          <li><a href="/tools/daily-calcium-calculator" >Daily Calcium Requirements Calculator </a></li>
          <li><a href="/tools/daily-fibre-calculator" >Daily Fibre calculator</a></li>
          <li><a href="/tools/ideal-weight-calculator" >Ideal Weight Calculator</a></li>
          <li><a href="/tools/infectious-diseases-exclusions" >Infectious Diseases Exclusion Periods Tool </a></li>
          <li><a href="/tools/ovulation-calculator" >Ovulation Calculator </a></li>
          <li><a href="/tools/smoking-cost-calculator" >Smoking Cost Calculator</a></li>
          <li><a href="/tools/heart-rate-calculator" >Target Heart Rate Calculator</a></li>
          <li><a href="/tools/waist-to-hip-calculator" >Waist-to-hip Ratio Calculator </a></li>
        </ul>
        <hr/>
        <h3>Risk Tests</h3>
        <ul>
          <li><a href="/tools/bowel-cancer-risk-test" >Bowel Cancer Risk Test</a></li>
          <li><a href="/tools/breast-cancer-risk-test" >Breast Cancer Risk Test</a></li>
          <li><a href="/tools/depression-self-assessment" >Depression Self-Assessment</a></li>
          <li><a href="/tools/diabetes-risk-test" >Diabetes Risk Test</a></li>
          <li><a href="/tools/erectile-dysfunction-tool" >Erectile Dysfunction Tool</a></li>
          <li><a href="/tools/heart-disease-risk-test" >Heart disease risk assessment</a></li>
          <li><a href="/tools/macular-degeneration-test" >Macular Degeneration Tool </a></li>
          <li><a href="/tools/osteoporosis-risk-test" >Osteoporosis Risk Test</a></li>
          <li><a href="/tools/prostate-symptoms-assessment" >Prostate Symptoms Self-Assessment</a></li>
          <li><a href="/tools/stroke-risk-test" >Stroke Risk Test</a></li>
        </ul>
        <hr/>

      </section>
    </div>
    <!-- End main section -->

    <?php /* Sidebar(Right hand side) */ ?>
    <?= $this->element('sidebar') ?>


  </div>
</div>

