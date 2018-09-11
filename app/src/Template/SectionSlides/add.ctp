<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Section Slides'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sectionSlides form large-9 medium-8 columns content">
    <?= $this->Form->create($sectionSlide) ?>
    <fieldset>
        <legend><?= __('Add Section Slide') ?></legend>
        <?php
            echo $this->Form->input('section_id', ['options' => $sections]);
            echo $this->Form->input('title');
            echo $this->Form->input('body');
            echo $this->Form->input('main_image');
            echo $this->Form->input('sub_image');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
