<!-- Sidebar's related articles box -->
        <div class="col-xs-12">
          <div class="sidebar-box">
                  <div class="sidebar-heading">
                    <h4 class="sidebar-title">Related Articles</h4>
                  </div>

                  <ul class="media-list media-list-aside list-group-aside featured-articles-widget">
                    <?php foreach ($related_articles as $article): ?>
                      <li class="media">
                        <div class="media-body">
                          <a href="/<?= $article->section['url'].'/'.$article['url']  ?>"><h5 class="media-heading"><?= $article['title'] ?></h5></a>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
          </div>
        </div>
