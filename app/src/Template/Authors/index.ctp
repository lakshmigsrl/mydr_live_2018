
<div class="container">
    <div class="row row-offcanvas-sm row-offcanvas-sm-right box-padding">
        <div class="col-md-8">
            <section id="content">

                <div class="row">
                    <!-- Blog Listing -->
                    <div class="blog clearfix">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-flat-asbestos btn-icon hidden-md hidden-lg hidden-xs pull-right" data-toggle="offcanvas-sm">
                                <i class="fa fa-share"></i> Recent Articles &amp; Categories
                            </button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="col-sm-12 col-md-12 blog-item">
                            <div class="box">
                                <ul class="media-list">
                                    <?php foreach ($authors as $author):?>
                                    <li class="media">
                                        <?php
                                        if(!empty($author->main_image)):
                                            echo $this->Html->image($author->main_image, [
                                              "alt" => $author->name,
                                              'class' => 'media-object'
                                            ]);
                                        endif;
                                        ?>
                                        <div class="media-body">
                                          <?php if($author->total_articles > 0){ ?>
                                            <a href="/authors/<?= $author->url;?>">
                                                <h4 class="media-heading"><?= $author->name;?></h4>
                                            </a>
                                          <?php }else{ ?>
                                                <h4 class="media-heading"><?= $author->name;?></h4>
                                          <?php } ?>
                                            <p class="ellipsis"><?= mb_substr(strip_tags($author->profile), 0, 100);?></p>

                                        </div>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->numbers() ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
        <?= $this->element('sidebar') ?>
        <!-- End Sidebar -->
    </div>
</div>
