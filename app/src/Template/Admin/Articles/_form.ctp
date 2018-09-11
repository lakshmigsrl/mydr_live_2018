

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Core</a></li>
    <li role="presentation"><a href="#history" aria-controls="home" role="tab" data-toggle="tab">History</a></li>
    <li role="presentation"><a href="#references" aria-controls="home" role="tab" data-toggle="tab">References</a></li>
    <li role="presentation"><a href="#homepage_slide" aria-controls="profile" role="tab" data-toggle="tab">Homepage Carousel</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
                <?php
                  /* Title, URL, Body... */
                  echo $this->Form->input('status',['options' => $constant_options['status']]);
                  echo $this->Form->input('title');
                  echo $this->Form->input('title_header');
                  if($this->request->action === 'edit'):
                    echo $this->Form->input('url');
                  endif;
                  echo $this->Form->input('abstract');
                  echo $this->Form->input('body', ['id' => 'body']);
                  echo $this->Form->input('article_video', array('type' => 'text', 'label' => 'Video'));
                  /* Image */
                  echo $this->Form->input('main_image', ['id' => 'main_image', 'label' => 'Display image']);
                  echo '<a id="ckfinder-modal-1" class="button-a button-a-background">Browse Server</a>';
                  echo $this->Form->input('page_image', ['id' => 'page_image', 'autocomplete'=>'off', 'class' => 'typeahead']);
                  echo '<a id="ckfinder-modal-2" class="button-a button-a-background">Browse Server</a>';
                  /* Section */
                  echo $this->Form->input('section_id', ['options' => $sections, 'empty' => 'NA']);
                  /* Format Type */
                  echo $this->Form->input('format_type',['options' => $constant_options['format_type']]);
                  echo $this->Form->input('medical_type', ['options' => $constant_options['medical_type'], 'empty' => 'Not Applicable']);
                  /* Scheduling */
                  echo $this->Form->input('start_date', ['empty' => true]);
                  echo $this->Form->input('end_date', ['empty' => true]);
                  echo $this->Form->input('created', ['empty' => true, 'label' => 'Published date']);
                  echo "<p>If you don't add 'Start Date', we use this one to published date";
                ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="homepage_slide">
                <br />
                <?php if(!$article->isNew()): ?>
                    <div class="form-group text">
                      <label class="control-label" for="slideTitle">Slide Title</label>
                      <input id="slideTitle" name="slideTitle" type="text" class="form-control" value="<?= $article['homepage']['title'] ?>" />
                    </div>
                    <div class="form-group text">
                      <label class="control-label" for="slideAbstract">Slide Abstract</label>
                      <input id="slideAbstract" name="slideAbstract" type="text" class="form-control" value="<?= $article['homepage']['body'] ?>" />
                    </div>
                    <input id="addToSlide" type="button" value="Add/Update to Homepage Slides" class="btn btn-default"
                        onclick="ajax_add_to_homeslide(<?= $article['id']; ?>, $('#slideTitle').val(), $('#slideAbstract').val(), 'slideStatus');" />
                    <div id="slideStatus"></div>
                <?php else: ?>
                    <p>Cannot add to homepage until this article is saved.</p>
                <?php endif; ?>
                <br /><br />
        </div>

        <div role="tabpanel" class="tab-pane" id="history">
                <?php /* History Section */ ?>
                <row>
                    <div class="panel panel-default">
                      <div class="panel-heading" style="display: inline-block; width: 100%;">
                            <row>
                                <div class="col-sm-2">
                                  <?php echo $this->Form->input('articleLogToSave.log_type', ['options' => $constant_options['log_type']]); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?php echo $this->Form->input('articleLogToSave.contributor_id', ['options' => $contributors]); ?>
                                </div>
                                <div class="col-sm-4">
                                  <?php
                                      //echo $this->Form->input('articlelogs.date');
                                      echo $this->Form->input('articleLogToSave.date', [
                                          'label' => 'Log date',
                                          'type' => 'date',
                                      ]);
                                  ?>
                                </div>
                                <div class="col-sm-2">
                                  <div class="form-group">
                                      <label>Action</label><br />
                                      <span class="button-checkbox">
                                          <button type="button" class="btn" data-color="success">Add Log</button>
                                          <input type="checkbox" name='articleLogToSave[confirmed]' class="hidden" />
                                      </span>
                                  </div>
                                </div>
                            </row>
                            <row>
                              <div class="col-sm-12">
                                <h3>History</h3>
                              </div>
                            </row>
                            <?php if(!$article->isNew()): ?>
                                  <?php foreach($article->article_logs as $log){ ?>
                                    <?php if(!empty($log->contributor)): ?>
                                      <row style="border-bottom: 1px solid #c0c0c0;">
                                        <div class="col-sm-4">

                                          <?= $constant_options['log_type'][$log->log_type] ?>
                                        </div>
                                        <div class="col-sm-4">
                                          <?= $log->contributor->first_name." ".$log->contributor->last_name ?>
                                        </div>
                                        <div class="col-sm-4">
                                          <?= $log->date ?>
                                        </div>
                                      </row>
                                      <row><div style="width: 100%; display: inline-block; border-bottom: 1px solid #c0c0c0;"></div></row>
                                    <?php endif; ?>
                                  <?php } ?>
                          <?php endif; ?>
                      </div>
                    </div>
                </row>
                <?php /* END History Section */ ?>
      </div>
      <div role="tabpanel" class="tab-pane" id="references">
                <?php
                echo $this->Form->input('note');
                echo $this->Form->input('reference');

                echo $this->Form->input('audience', ['options' => $constant_options['audience']]);
                echo $this->Form->input('hi_status', ['options' => $constant_options['hi_status']]);
                echo $this->Form->input('content_gender', ['options' => $constant_options['gender']]);

                echo $this->Form->input('source_id', ['options' => $sources, 'empty' => 'Not Applicaple']);
                echo $this->Form->input('author_id', ['options' => $authors, 'empty' => 'Not Applicaple']);
                echo $this->Form->input('footer_id', ['options' => $footers, 'empty' => 'Not Applicable']);
                echo $this->Form->input('licensable', ['options' => $constant_options['licensable']]);
                echo $this->Form->input('legacy_id', ['type' => 'text', 'label' => 'legacy ID', 'disabled' => 'disabled']);
                echo $this->Form->input('next_review');
                echo $this->Form->input('reviewed');

                /* Get Related Articles */
                //echo $this->Form->input('related_articles._ids', ['options' => $articles]);
                echo $this->Form->input('relatedArticlesSearchBox', ['id' => 'ajaxSearchArticlesBox']);
                echo "<div class='col-sm-12'><ul id='relatedArticlesUl'>";
                if(!$article->isNew()){
                    $ctr=0;
                    foreach($article->related_articles as $relArt){
                          $section_url = isset($relArt->section->url) ? "/".$relArt->section->url : "";
                          echo "<li id='li_relArt_".$ctr."'>"
                                  ."<input type='hidden' value='".$relArt->title."' name='dummy_related_articles[".$relArt->id."]' />"
                                  ."<a href='".$section_url."/".$relArt->url."' target='blank'>".$relArt->title."</a>"
                                  ."<a href='#relatedArticlesUl' onclick=\"$('#li_relArt_".$ctr."').remove();\" style='color: #990000;'><i> [delete] </i></a>"
                              ."</li>";
                          $ctr++;
                    }
                    // echo "<li><input type='text' value='sugar baby' name='dummy_related_articles[4]' /></li>";
                }
                echo "</ul></div>";
                /* END Get Related Articles */

                echo $this->Form->input('topics._ids', ['options' => $topics]);
                ?>

      </div>
  </div>
  <hr />
