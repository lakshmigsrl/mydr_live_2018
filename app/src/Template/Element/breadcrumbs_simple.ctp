<div class="fluid-container breadcrumbs-container">
    <div class="container">
        <div class="row">
            <div id="bc1" class="btn-group btn-breadcrumb col-xs-12 col-md-6">
                <a href="/" class="btn btn-default"><i class="fa fa-home"></i></a>
                <?php if($breadcrumb->section != null){ ?>
                  <a href="/<?= $breadcrumb->section->url ?>" class="btn btn-default"><div><?= $breadcrumb->section->label ?></div></a>
                <?php } ?>
                <a href="#" class="btn btn-default"><div><?= $breadcrumb->label ?></div></a>
            </div>
        </div>
    </div>
</div>
