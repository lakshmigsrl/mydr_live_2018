<div class="col-xs-12 border-bottom">
  <div class="inline-thumbnail">
    <?php
    if(isset($articles->section->url)){
      $section_url = $articles->section->url;
    }
    ?>
    <a href="/<?php echo $section_url;?>/<?php echo $articles->url;?>">
    <?php
    if(!empty($articles->main_image)){
      if(!file_exists(ROOT.'/webroot/files/tmp/section/article-repeat3-'.$articles->id.'.jpg')):
        $imagine = new Imagine\Gd\Imagine();
        $size    = new Imagine\Image\Box(150, 100);
        $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        $imagine->open($articles->main_image)
          ->thumbnail($size, $mode)
          ->save( ROOT.'/webroot/files/tmp/section/article-repeat3-'.$articles->id.'.jpg');
      endif;
      echo $this->Html->image('/files/tmp/section/article-repeat3-'.$articles->id.'.jpg', [
        "alt" => $articles->title,
      ]);
    }
    ?>
      <h4><?= $articles->title;?></h4>
    </a>

    <span class="item-meta"> 
      <?php
      if($this->templatePath !== 'Homepages'):
        echo '<i class="fa fa-calendar"></i> ';
        if(isset($articles->start_date)){
          echo date(DATE_FORMAT, strtotime($articles->start_date));
        }else{
          echo date(DATE_FORMAT, strtotime($articles->created));
        }
      endif;
      ?>
    </span>
    <p class="ellipsis_p"><?= mb_substr(strip_tags($articles->abstract), 0, 100);?></p>
  </div>
</div>
