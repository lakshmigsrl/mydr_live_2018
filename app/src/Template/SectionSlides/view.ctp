<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Section Slide'), ['action' => 'edit', $sectionSlide->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Section Slide'), ['action' => 'delete', $sectionSlide->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sectionSlide->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Section Slides'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section Slide'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sectionSlides view large-9 medium-8 columns content">
    <h3><?= h($sectionSlide->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= $sectionSlide->has('section') ? $this->Html->link($sectionSlide->section->name, ['controller' => 'Sections', 'action' => 'view', $sectionSlide->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($sectionSlide->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Main Image') ?></th>
            <td><?= h($sectionSlide->main_image) ?></td>
        </tr>
        <tr>
            <th><?= __('Sub Image') ?></th>
            <td><?= h($sectionSlide->sub_image) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($sectionSlide->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($sectionSlide->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($sectionSlide->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($sectionSlide->body)); ?>
    </div>
</div>
