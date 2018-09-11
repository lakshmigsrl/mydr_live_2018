<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Section Slide'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sectionSlides index large-9 medium-8 columns content">
    <h3><?= __('Section Slides') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('section_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('main_image') ?></th>
                <th><?= $this->Paginator->sort('sub_image') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sectionSlides as $sectionSlide): ?>
            <tr>
                <td><?= $this->Number->format($sectionSlide->id) ?></td>
                <td><?= $sectionSlide->has('section') ? $this->Html->link($sectionSlide->section->name, ['controller' => 'Sections', 'action' => 'view', $sectionSlide->section->id]) : '' ?></td>
                <td><?= h($sectionSlide->title) ?></td>
                <td><?= h($sectionSlide->main_image) ?></td>
                <td><?= h($sectionSlide->sub_image) ?></td>
                <td><?= h($sectionSlide->created) ?></td>
                <td><?= h($sectionSlide->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sectionSlide->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sectionSlide->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sectionSlide->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sectionSlide->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
