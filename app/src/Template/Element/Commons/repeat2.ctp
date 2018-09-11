<div class="prop-item col-xs-12 col-sm-6 col-md-3">
  <div class="thumbnail">
    <div class="thumbnail-container">
      <?php
      if(!empty($articles->main_image)){
        if(!file_exists(ROOT.'/webroot/files/tmp/section/article-repeat2-'.$articles->id.'.jpg')):
          $imagine = new Imagine\Gd\Imagine();
          $size    = new Imagine\Image\Box(260, 175);
          $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
          $mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
          $imagine->open($articles->main_image)
            ->thumbnail($size, $mode)
            ->save( ROOT.'/webroot/files/tmp/section/article-repeat2-'.$articles->id.'.jpg');
        endif;

        echo $this->Html->image('/files/tmp/section/article-repeat2-'.$articles->id.'.jpg', [
          "alt" => $articles->title,
          'url' => '/' . $articles->section->url. '/' . $articles->url
        ]);
      }
      ?>
    </div>

    <div class="thumbnail-body border-bottom-red">
      <div class="caption">
        <a href="/<?= $articles->section->url;?>/<?= $articles->url;?>">
          <h4><?= $articles->title;?></h4>
        </a>
        <p class="ellipsis_p"><?= mb_substr(strip_tags($articles->abstract), 0, 100);?></p>
      </div>
    </div>
  </div>
</div>
