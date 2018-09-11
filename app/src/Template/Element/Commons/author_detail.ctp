<div class="author-container col-xs-12">
  <div class="author-img">

    <?php
    echo $this->Html->image($author->main_image, [
      "alt" => $author->name,
    ]);
    ?>
  </div>
  <div class="author-text">
    <a href="/authors/<?= $author->url;?>">
      <h4><?= $author->name;?>
    </a>
    <p>
      <?= $author->profile;?>
    </p>
  </div>
  <div class="author-links">
    <?php
    if( !empty($author->linkedin_link) || !empty($author->facebook_link) || !empty($author->twitter_link) ):
    ?>
      <h5>Social Links</h5>
      <?php if(!empty($author->linkedin_link)):?>
        <a class="btn btn-social-icon btn-linkedin" href="<?= $author->linkedin_link;?>" target="_blank"><i class="fa fa-linkedin"></i></a>
      <?php endif;?>
      <?php if(!empty($author->facebook_link)):?>
        <a class="btn btn-social-icon btn-facebook" href="<?= $author->facebook_link;?>" target="_blank"><i class="fa fa-facebook"></i></a>
      <?php endif;?>
      <?php if(!empty($author->twitter_link)):?>
        <a class="btn btn-social-icon btn-twitter" href="<?= $author->twitter_link;?>" target="_blank"><i class="fa fa-twitter"></i></a>
      <?php endif;?>
    <?php endif;?>
  </div>
</div>
