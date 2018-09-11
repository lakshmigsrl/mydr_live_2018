<div class="homepages form large-9 medium-8 columns content">
  <?= $this->Form->create($homepage) ?>
  <fieldset>
    <legend><?= __('Homepage') ?></legend>
    <?php
          /* Get Related Articles */
          echo $this->Form->input('relatedArticlesSearchBox', ['id' => 'ajaxSearchArticlesBox', 'label' => 'Article']);
          echo "<div class='col-sm-12'><ul id='relatedArticlesUl'>";
          if(!$homepage->isNew()){

                    echo "<li id='li_ArticleId'>"
                            ."<input type='hidden' value='".$homepage->article->id."' name='article_id' />"
                            ."<img src='".$homepage->article->main_image."' style='width: 80px;' /> "
                            ."<a href='http://www.mydr.com.au/".$homepage->article->section->url."/".$homepage->article->url."' target='blank'> ".$homepage->article->title."</a>"
                        ."</li>";
          }
          echo "</ul></div>";
          /* END Get Related Articles */
    ?>

    <?php
    // echo $this->Form->input('article_id', ['options' => $articles]);
    echo $this->Form->input('title');
    echo $this->Form->input('body');
    echo $this->Form->input('start');
    echo $this->Form->input('end');

    ?>
  </fieldset>
  <br /><br />
  <?= $this->Form->button(__('Submit')) ?>
  <br /><br /><br /><br />
  <?= $this->Form->end() ?>
</div>
