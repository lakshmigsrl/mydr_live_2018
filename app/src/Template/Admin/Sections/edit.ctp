<script src="//cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
<?php echo $this->Html->script('/ckfinder/ckfinder.js');?>
<?php echo $this->Html->script('/js/bootstrap/bootstrap3-typeahead.js');?>

<script type="text/javascript">
  function selectFileWithCKFinder( elementId, imgElementId ) {
    CKFinder.modal( {
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                var output = document.getElementById( elementId );
                var outputImg = document.getElementById( imgElementId );
                output.value = file.getUrl();
                $('.'+imgElementId).attr('src', file.getUrl());   //Update image preview.
            } );

            finder.on( 'file:choose:resizedImage', function( evt ) {
                var output = document.getElementById( elementId );
                output.value = evt.data.resizedUrl;
            } );
        }
    } );
    return false;
  }
</script>

<?= $this->Form->create($section) ?>
    <fieldset>
        <legend><?= __('Edit Section') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('url');
            echo $this->Form->input('body');
            echo $this->Form->input('keywords');
            echo $this->Form->input('status');
            echo $this->Form->input('status');

            /* Get Top Articles */
            // echo $this->Form->input('top_articles._ids', ['options' => $top_articles]);
            echo "<hr />";
            echo $this->Form->input('topArticles', ['id' => 'ajaxSearchArticlesBox']);
            echo "<div class='col-sm-12'><ul id='relatedArticlesUl'>";
            $ctr=0;
            foreach($section->top_articles as $relArt){
                  $section_url = isset($relArt->section->url) ? "/".$relArt->section->url : "";
                  echo "<li id='li_relArt_".$ctr."'>"
                          ."<input type='hidden' value='".$relArt->title."' name='dummy_related_articles[".$relArt->id."]' />"
                          ."<a href='".$section->url."/".$relArt->url."' target='blank'>".$relArt->title."</a>"
                          ."<a href='#relatedArticlesUl' onclick=\"$('#li_relArt_".$ctr."').remove(); return false;\" style='color: #990000;'><i> [delete] </i></a>"
                      ."</li>";
                  $ctr++;
            }
            echo "</ul></div>";
            echo "<hr /><br />";
            /* END Get Top Articles */

            /* Get Top Medicines */
            // echo $this->Form->input('top_medicines._ids', ['options' => $top_medicines]);
            echo "<hr />";
            echo $this->Form->input('topMedicines', ['id' => 'ajaxSearchCmisBox']);
            echo "<div class='col-sm-12'><ul id='relatedCmisUl'>";
            $ctr=0;
            foreach($section->top_medicines as $relCmi){
                  $section_url = "/medicines/cmis/".$relCmi->full_url;
                  echo "<li id='li_relCmi_".$ctr."'>"
                          ."<input type='hidden' value='".$relCmi->description."' name='dummy_related_cmis[".$relCmi->id."]' />"
                          ."<a href='/medicines/cmis/".$relCmi->full_url."' target='blank'>".$relCmi->description."</a>"
                          ."<a href='#relatedCmisUl' onclick=\"$('#li_relCmi_".$ctr."').remove(); return false;\" style='color: #990000;'><i> [delete] </i></a>"
                      ."</li>";
                  $ctr++;
            }
            echo "</ul></div>";
            echo "<hr /><br />";
            /* END Get Top Medicines */

            echo $this->Form->input('tools._ids', ['options' => $tools]);
        ?>
    </fieldset>
    <fieldset>
        <legend><h2><?php echo __('Carousel');?></h2></legend>
        <div id="grade-fields">
              <input type="hidden" id="ctrSlide" value="<?= count($section->section_slides) ?>">
              <input type="hidden" id="ctrContSlide" value="<?= count($section->section_slides) ?>">
              <?php
                  $ctrSlide = 0;
                  foreach($section->section_slides as $slide){
                    ?>
                    <div id="slideDiv<?= $ctrSlide ?>">
                      <h3>Slide <span style="display: none;"><?= $ctrSlide ?></span> <a href="#" class="removeSlide" onclick="return false;" style='font-size: 14px; font-weight: normal;'>Remove</a></h3>
                        <input type="hidden" name="section_slides[<?= $ctrSlide ?>][id]" class="linoclass form-control" value="<?= $slide->id ?>">
                        <label>title</label>
                          <input type="text" name="section_slides[<?= $ctrSlide ?>][title]" class="slide-title linoclass form-control" value="<?= $slide->title ?>">
                      <label>url</label>
                        <input type="text" name="section_slides[<?= $ctrSlide ?>][url]" class="slide-title linoclass form-control" value="<?= $slide->url ?>">
                      <label>body</label>
                        <input type="text" name="section_slides[<?= $ctrSlide ?>][body]" class="linoclass form-control" value="<?= $slide->body ?>">
                      <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                              <label>Main Image</label>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-2 ">
                              <img src="<?= $slide->main_image ?>" class="slidePreview_<?= $ctrSlide ?>" style="padding: 6px; width: 100%;">
                            </div>
                            <div class="col-xs-6 col-sm-8 col-md-8 ">
                              <a onclick="selectFileWithCKFinder('main_image<?= $ctrSlide ?>', 'slidePreview_<?= $ctrSlide ?>');" class="button-a button-a-background">Browse Images</a>
                              <input type="text" id="main_image<?= $ctrSlide ?>" name="section_slides[<?= $ctrSlide ?>][main_image]" class="slidePreview linoclass form-control" required="required" value="<?= $slide->main_image ?>">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                              <hr />
                            </div>
                      </div>
                    </div>
                    <?php $ctrSlide++;
                  }
              ?>
        </div>
        <a href="#" class="added" onclick="return false;">Add slide</a>
    </fieldset>
<?= $this->Form->button(__('Submit')) ?>
<br /><br /><br /><br /><br />
<?= $this->Form->end() ?>

<?php echo $this->element('/Admin/slides'); ?>
<?php echo $this->Html->script('section'); ?>
<?php echo $this->Html->script('article_ajax'); ?>
<?php echo $this->Html->script('cmi_product_ajax'); ?>
