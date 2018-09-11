<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Homepage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="homepages index large-9 medium-8 columns content">
    <h3><?= __('Homepages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('article_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('start') ?></th>
                <th><?= $this->Paginator->sort('end') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($homepages as $homepage): ?>
            <tr>
                <td><?= $this->Number->format($homepage->id) ?></td>
                <td><?= $homepage->has('article') ? $this->Html->link($homepage->article->title, ['controller' => 'Articles', 'action' => 'view', $homepage->article->id]) : '' ?></td>
                <td><?= h($homepage->title) ?></td>
                <td><?= h($homepage->start) ?></td>
                <td><?= h($homepage->end) ?></td>
                <td><?= h($homepage->created) ?></td>
                <td><?= h($homepage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $homepage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $homepage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $homepage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homepage->id)]) ?>
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
