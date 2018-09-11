<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Topic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="topics index large-9 medium-8 columns content">
    <h3><?= __('Topics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('section_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('url') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('main_image') ?></th>
                <th><?= $this->Paginator->sort('main_image_alttext') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topics as $topic): ?>
            <tr>
                <td><?= $this->Number->format($topic->id) ?></td>
                <td><?= $topic->has('section') ? $this->Html->link($topic->section->name, ['controller' => 'Sections', 'action' => 'view', $topic->section->id]) : '' ?></td>
                <td><?= h($topic->title) ?></td>
                <td><?= h($topic->url) ?></td>
                <td><?= $this->Number->format($topic->status) ?></td>
                <td><?= h($topic->main_image) ?></td>
                <td><?= h($topic->main_image_alttext) ?></td>
                <td><?= h($topic->created) ?></td>
                <td><?= h($topic->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $topic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $topic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <!-- Pagination -->
        <ul class="pagination">
            <li><?= $this->Paginator->prev(__('<i class="fa fa-chevron-left"></i> Previous'), ['escape' => false]) ?></li>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <li><?= $this->Paginator->next(__('Next') . '  <i class="fa fa-chevron-right"></i>', ['escape' => false]) ?></li>
        </ul>
        <p>
            <?php
            echo $this->Paginator->counter(
              'Page {{page}} of {{pages}}, showing {{current}} records out of
        {{count}} total, starting on record {{start}}, ending on {{end}}'
            );
            ?></p>
        <!-- end Pagination -->
    </div>
</div>
