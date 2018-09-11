<?php echo $this->element('Blocks/meta_block', ['type'=>'seach']); ?>

<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">

    <!-- main section -->
    <div class="col-xs-12 col-sm-12 col-md-8 ">
          <section id="content" class="article-box">
            <div class="row">

              <div class="col-xs-12 col-md-12 blog-item blog-single">
                <h1 class="rounded">Find a GP</h1>
                <p>
                    To search for a General Practitioner or practice on myDr please enter your keywords in either one of the boxes below.
                </p>
                <p>
                    You don't need to fill information in both boxes.
                </p>
                <?= $this->Form->create(null, ['url' => "http://directory.mydr.com.au/search"]) ?>

                    <?php echo $this->Form->input('data[Practice][searchStr1]', ['label' => 'Practice name']); ?>
                    <?php echo $this->Form->input('data[Practice][searchStr2]', ['label' => 'Doctor name']); ?>
                    <?= $this->Form->button(__('Submit')) ?>

                    <br /><br />
                <?= $this->Form->end() ?>
              </div>

              <div class="col-xs-12 col-md-12 blog-item blog-single">
                <h1 class="rounded">Professionals Login</h1>
                <p>
                    Welcome to the myDr Health Professionals' Login. This area is available only to registered Health Professionals. It provides you with access to administer your Health Professional Web Site on the myDr Web Site Directory.
                </p>
                <p>
                    If you are a registered user please login below:
                </p>
                <?= $this->Form->create(null, ['url' => "http://directory.mydr.com.au/users/login"]) ?>

                    <?php echo $this->Form->input('data[User][email]', ['label' => 'login/email']); ?>
                    <?php echo $this->Form->input('data[User][password]', ['label' => 'password', 'type' => 'password']); ?>
                    <?= $this->Form->button(__('Submit')) ?>

                    <br /><br />
                <?= $this->Form->end() ?>
              </div>

            </div>
          </section>
    </div>
    <!-- End main section -->
    <?= $this->element('sidebar') ?>

  </div>
</div>
