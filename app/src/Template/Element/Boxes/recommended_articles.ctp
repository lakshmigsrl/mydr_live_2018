<!-- Sidebar's recommended articles box -->
        <div class="col-xs-12">
          <div class="sidebar-box">
                  <div class="sidebar-heading">
                    <h4 class="sidebar-title">Recommended</h4>
                  </div>

                  <ul class="media-list media-list-aside list-group-aside featured-articles-widget">
                    <?php foreach ($recommended_articles as $latest): ?>
                      <li class="media">
                        <div class="media-body">
                          <a href="/<?= $latest->section['url'].'/'.$latest['url'] ?>"><h5 class="media-heading"><?= $latest['title'] ?></h5></a>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
          </div>
        </div>
