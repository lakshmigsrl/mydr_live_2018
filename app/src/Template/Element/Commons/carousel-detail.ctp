
<div class="item <?= $active;?>">
  <?php
    $article_id = $home_slide->article->id;
    // Get the file extension so we can remove it
    $article_main_image_extension = pathinfo($home_slide->article->main_image, PATHINFO_EXTENSION);
    // Get the filename so we can append it to the carousel image's filename
    $article_main_image_filename = basename($home_slide->article->main_image, $article_main_image_extension);

    if(!file_exists(ROOT.'/webroot/files/tmp/carousel/article-carousel-'.$article_id.'-'.$article_main_image_filename.'jpg')):
      $imagine = new Imagine\Gd\Imagine();
      $size    = new Imagine\Image\Box(750, 500);
      $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
      $mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
      $imagine->open($home_slide->article->main_image)
        ->thumbnail($size, $mode)
        ->save( ROOT.'/webroot/files/tmp/carousel/article-carousel-'.$article_id.'-'.$article_main_image_filename.'jpg')
      ;
    endif;
    echo $this->Html->image('/files/tmp/carousel/article-carousel-'.$article_id.'-'.$article_main_image_filename.'jpg', [
      "alt" => $home_slide->article->title,
      'url' => '/' . $home_slide->article->section->url. '/' . $home_slide->article->url
    ]);
  ?>
  <div class="carousel-caption">
    <h3 class="carousel-caption-header">
      <?php
            if(isset($home_slide->title) && trim($home_slide->title) != ""){
              echo $home_slide->title;
            }else{
              echo $home_slide->article->title;
            }
      ?>
    </h3>
    <p class="carousel-caption-text hidden-sm hidden-xs">
      <?php
            if(isset($home_slide->body) && trim($home_slide->body) != ""){
              echo $home_slide->body;
            }else{
              echo mb_substr(strip_tags($home_slide->article->abstract), 0, 100). "...";
            }
      ?>
    </p>
  </div>
</div>
