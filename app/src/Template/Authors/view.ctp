
<div class="container">
    <div class="row row-offcanvas-sm row-offcanvas-sm-right box-padding white-background margin-top box-shadow">
        <div class="col-xs-12">
            <section id="content">

                <div class="row">
                    <!-- Blog Listing -->
                    <div class="blog clearfix">

                        <div class="col-xs-12 col-md-11 col-md-offset-1 blog-item blog-single">
                            <div class="media-list">
                                <div class="media box">
                                    <div class="media-body">

                                        <div class="col-sm-3 col-xs-12 ">

                                            <?php
                                              if(strlen(trim($author->main_image)) > 1){
                                                echo $this->Html->image($author->main_image, [
                                                      "alt" => $author->name,
                                                      'style' => 'width:100%;'
                                                ]);
                                               }
                                            ?>
                                            <?php
                                            if( !empty($author->linkedin_link) || !empty($author->facebook_link) || !empty($author->twitter_link) ):
                                            ?>
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

                                        <div class="col-sm-8 col-xs-12">
                                            <h2><?= $author->name;?></h2>
                                            <hr class="author-hr">
                                            <h4><?= $author->job_title;?></h4>
                                            <p><?= $author->profile;?></p>
                                        </div>

                                        <div class="col-xs-12"><hr></div>


                                        <?php if (!empty($articles)): ?>
                                        <div class="related-content">
                                            <div class="author-articles col-xs-12"><h4 class="panel-title">Articles by <?= $author->name;?></h4></div>
                                            <?php foreach ($articles as $article): ?>
                                            <!-- Start Block -->
                                            <div class="prop-item col-xs-12 col-sm-6 col-md-4 auther-articles-list">
                                                <div class="thumbnail border-top-blue">
                                                    <div class="thumbnail-body  left-align" >
                                                        <div class="caption">
                                                            <a href="/<?=$article->section->url?>/<?=$article->url;?>">
                                                                <h5><?= $article->title?></h5>
                                                                <span class="ellipsis"><?= mb_substr(strip_tags($article->body), 0, 100);?></span>
                                                                <span class="view-more-link" href="/<?=$article->section->url?>/<?=$article->url;?>">View More <i class="fa fa-caret-right"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Block -->
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>


                                    </div>


                                </div>
                            </div>

                            <div class="paginator">
                                <ul class="pagination">
                                    <?= $this->Paginator->numbers() ?>
                                </ul>
                                <p><?= $this->Paginator->counter() ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
