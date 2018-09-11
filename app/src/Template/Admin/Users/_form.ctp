<?= $this->Form->create($user) ?>
<fieldset>
  <legend><?= __('User') ?></legend>
  <?php
//  echo $this->Form->input('login');
  //            echo $this->Form->input('last_login', ['empty' => true]);
  //            echo $this->Form->input('title');
  echo $this->Form->input('fname');
  echo $this->Form->input('lname');
  echo $this->Form->input('email');
  echo $this->Form->input('password');
  echo $this->Form->input('role_id', ['options' => $roles]);
  ?>
</fieldset>
<?= $this->Form->button(__('Save')) ?>
<?php
echo $this->Form->button('Cancel', array(
  'type' => 'button',
  'onclick' => 'location.href=\'/admin/users/\''
));
?>
<?= $this->Form->end() ?>