<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Contributors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Article Logs'), ['controller' => 'ArticleLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article Log'), ['controller' => 'ArticleLogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contributors form large-9 medium-8 columns content">
    <?= $this->Form->create($contributor) ?>
    <fieldset>
        <legend><?= __('Add Contributor') ?></legend>
        <?php
            echo $this->Form->input('display_name');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('email');
            echo $this->Form->input('profile');
            echo $this->Form->input('alias');
            // echo $this->Form->input('legacy_user_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
