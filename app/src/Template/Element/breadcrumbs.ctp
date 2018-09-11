<div class="fluid-container breadcrumbs-container">
  <div class="container">
    <div class="row">
      <div id="bc1" class="btn-group btn-breadcrumb col-xs-12 col-md-6">
          <a href="/" class="btn btn-default"><i class="fa fa-home"></i></a>
        <?php if(!empty($section)):?>
          <a href="/<?= $section->url ?>" class="btn btn-default"><div><?= $section->name ?></div></a>
        <?php endif;?>
        <?php if(!empty($author)):?>
          <a href="#" class="btn btn-default"><div>Authors</div></a>
          <a href="#" class="btn btn-default"><div><?= $author->name ?></div></a>
        <?php elseif(!empty($tool)):?>
          <a href="/tools/" class="btn btn-default"><div>Health Tools</div></a>
          <a href="#" class="btn btn-default"><div><?= $tool->title; ?></div></a>
        <?php else:?>
          <a href="#" class="btn btn-default"><div><?= $article->title ?></div></a>
        <?php endif;?>

      </div>
    </div>
  </div>
</div>
