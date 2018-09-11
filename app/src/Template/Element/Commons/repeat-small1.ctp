<div class="prop-item col-sm-6 col-md-15">
  <div class="thumbnail">
    <div class="thumbnail-container">
      <?php
      echo $this->Html->image($articles->main_image, [
        "alt" => $articles->title,
        'url' => '/' . $articles->section->url. '/' . $articles->url
      ]);
      ?>
    </div>

    <div class="thumbnail-body border-bottom-red">
      <div class="caption">
        <h4><?= $articles->title;?></h4>
        <span class="item-meta">
          <?php
          if(isset($articles->start_date)){
            echo '<i class="fa fa-calendar"></i> ';
            echo date(DATE_FORMAT, strtotime($articles->start_date));
          }else{
            echo date(DATE_FORMAT, strtotime($articles->created));
          }
          ?>
        </span>
        <p><?= mb_substr(strip_tags($articles->abstract), 0, 100);?></p>
      </div>
    </div>
  </div>
</div>