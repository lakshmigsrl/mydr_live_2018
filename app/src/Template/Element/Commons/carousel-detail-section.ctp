
<div class="item <?= $active;?>">
  <?php
  echo $this->Html->image($slide->main_image, [
    "alt" => $slide->title,
    'url' => $slide->url
  ]);
  ?>
  <div class="carousel-caption">
    <h3 class="carousel-caption-header"><?= $slide->title;?></h3>
    <p class="carousel-caption-text hidden-sm hidden-xs">
      <?= mb_substr(strip_tags($slide->body), 0, 100);?>
    </p>
  </div>
</div>
