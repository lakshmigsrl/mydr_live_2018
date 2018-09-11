<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $footer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $footer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Footers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="footers form large-9 medium-8 columns content">
    <?= $this->Form->create($footer) ?>
    <fieldset>
        <legend><?= __('Edit Footer') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
