<div class="prop-item col-xs-12 col-sm-6 col-md-3">
  <div class="thumbnail">
    <div class="thumbnail-container">
      <?php
          if(isset($tool->image)){
              echo $this->Html->image($tool->image, [
                "alt" => $tool->title,
                'url' => '/tools/' . $tool->url
              ]);
          }
      ?>
    </div>

    <div class="thumbnail-body border-bottom-red">
      <div class="caption">
        <a href="/tools/<?= $tool->url;?>">
          <h4><?= $tool->title;?></h4>
        </a>
        <p class="ellipsis_p"><?= mb_substr(strip_tags($tool->abstract), 0, 100);?></p>
      </div>
    </div>
  </div>
</div>
