
<div class="col-md-6" style="padding: 20px;">
    <div class="users form">
      <?= $this->Flash->render('auth') ?>
      <?= $this->Form->create() ?>
      <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('email') ?>
        <?= $this->Form->input('password') ?>
      </fieldset>
      <?= $this->Form->button(__('Login')); ?>

      <?= $this->Form->end() ?>
    </div>
</div>
<div class="col-md-6"></div>
