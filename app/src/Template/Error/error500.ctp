<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

// $this->layout = 'error';
$this->layout = 'default_error';
?>

<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">
      <!-- main section -->
      <div class="col-xs-12 col-sm-12 col-md-8 ">

              <?php
              if (Configure::read('debug')):
                  $this->layout = 'dev_error';

                  $this->assign('title', $message);
                  $this->assign('templateName', 'error500.ctp');

                  $this->start('file');
              ?>
              <?php if (!empty($error->queryString)) : ?>
                  <p class="notice">
                      <strong>SQL Query: </strong>
                      <?= h($error->queryString) ?>
                  </p>
              <?php endif; ?>
              <?php if (!empty($error->params)) : ?>
                      <strong>SQL Query Params: </strong>
                      <?php Debugger::dump($error->params) ?>
              <?php endif; ?>
              <?php if ($error instanceof Error) : ?>
                      <strong>Error in: </strong>
                      <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
              <?php endif; ?>
              <?php
                  echo $this->element('auto_table_warning');

                  if (extension_loaded('xdebug')):
                      xdebug_print_function_stack();
                  endif;

                  $this->end();
              endif;
              ?>
              <p class="error" style="display: none;">
                  <strong><?= __d('cake', 'Error') ?>: </strong>
                  <?= h($message) ?>
              </p>

              <div id="errorpage" class="errorcore" style="padding: 20px;">
                  <h1>We're sorry, the page you are searching for can't be found,.</h1>
                  <p>
                        This may be because:
                        <ul>
                              <li class="indentedlarge">There is an error in the address</li>
                              <li class="indentedlarge">The page has been removed from our site</li>
                              <li class="indentedlarge">The page has moved on our site</li>
                              <li class="indentedlarge">There is a technical error in publishing the page</li>
                        </ul>
                  </p>
                  <p>
                    To find content, view our <a href="/site-map" >Site map</a>, use the search box above or select from the links below.
                  <p>
                    To report a technical error or a broken link, please email <a href="mailto:admin@mydr.com.au">admin@mydr.com.au</a> telling us the URL of the page
                  </p>
              </div>


      </div> <!-- END main section -->
  </div>
</div> <!-- END container -->
