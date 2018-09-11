<div class="col-xs-12 border-bottom">
  <div class="inline-thumbnail">
    <a href="/<?= $articles->section->url;?>/<?= $articles->url;?>">
      <?php
      if(!empty($articles->main_image)){
        if(!file_exists(ROOT.'/webroot/files/tmp/section/article-repeat1-'.$articles->id.'.jpg')):
          $imagine = new Imagine\Gd\Imagine();
          $size    = new Imagine\Image\Box(150, 100);
          $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
          $mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
          $imagine->open($articles->main_image)
            ->thumbnail($size, $mode)
            ->save( ROOT.'/webroot/files/tmp/section/article-repeat1-'.$articles->id.'.jpg');
        endif;
        echo $this->Html->image($articles->main_image, [
          "alt" => $articles->title
        ]);
      }
      ?>
      <h3><?= $articles->title;?></h3>
    </a>
    <span class="item-meta">
      <?php
      // Don't display the article's date on the homepage or section pages
      if($this->templatePath !== 'Sections' && $this->templatePath !== 'Homepages'):
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
