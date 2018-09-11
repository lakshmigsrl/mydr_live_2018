<?php echo $this->element('Blocks/meta_block', ['type'=>'sections']); ?>

<section class="fluid-container feature-slider-container">
    <div class="container position-relative">
        <div class="row">
            <div class="col-xs-12 col-sm-6 h1-tag category-textcontainer">
                <h1 class="category-heading"><?= h($section->name) ?></h1>
                <p><?= $this->Text->autoParagraph($section->body); ?></p>
            </div>


        </div>

    </div>
</section>


<!-- Top Articles -->
<?php if (!empty($symptoms_list)): ?>
<section class="container featured-container">
    <div class="row">
        <div class="row-title col-xs-12">
            <h2>Symptoms Index</h2>
            <p>If you can't find the symptom you are looking for here, type your search term into the main health information search window.
              Many articles cover more than symptoms alone, and so are not indexed in this section.</p>
              <br />
        </div>

        <div class="prop-item col-xs-12 col-sm-6 col-md-4">
            <div class="row">
              <?php
                    $i = 0;
                    foreach ($symptoms_list as $articles){
                        if($i < 22){
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
                    foreach ($symptoms_list as $articles){
                        if($i>22 && $i < 44){
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
                    foreach ($symptoms_list as $articles){
                        if($i>44 && $i < 66){
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

<!-- END Tools -->
<?php if (!empty($section->tools)): ?>
<section class="container featured-container">
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
