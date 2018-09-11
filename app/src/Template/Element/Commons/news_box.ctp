
<?php if(isset($news->main_image) && trim($news->main_image)!=""){ ?>
  <img class="media-object" src="<?= $news->main_image ?>" alt="">
<?php } ?>
<div class="media-body">
  <?php
        $section_url = "";
        if(isset($news->section->url)){
            $section_url = "/".$news->section->url;
        }
  ?>
  <a href="<?= $section_url ?>/<?= $news->url ?>">
    <h4 class="media-heading"><?= $news->title ?></h4>
  </a>
  <?php
  if(isset($news->start_date)){
    $display_date = date(DATE_FORMAT, strtotime($news->start_date));
  }else{
    $display_date = date(DATE_FORMAT, strtotime($news->created));
  }
  ?>
  <span class="item-meta"> <i class="fa fa-calendar"></i> <?= $display_date ?></span>
  <p class="ellipsis">
    <?= $news->abstract ?>
  </p>
</div>
