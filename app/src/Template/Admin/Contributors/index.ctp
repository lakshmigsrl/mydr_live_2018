<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Contributor'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Article Logs'), ['controller' => 'ArticleLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article Log'), ['controller' => 'ArticleLogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contributors index large-9 medium-8 columns content">
    <h3><?= __('Contributors') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('display_name') ?></th>
                <th><?= $this->Paginator->sort('first_name') ?></th>
                <th><?= $this->Paginator->sort('last_name') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('profile') ?></th>
                <th><?= $this->Paginator->sort('alias') ?></th>
                <th><?= $this->Paginator->sort('legacy_user_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contributors as $contributor): ?>
            <tr>
                <td><?= $this->Number->format($contributor->id) ?></td>
                <td><?= h($contributor->display_name) ?></td>
                <td><?= h($contributor->first_name) ?></td>
                <td><?= h($contributor->last_name) ?></td>
                <td><?= h($contributor->email) ?></td>
                <td><?= h($contributor->profile) ?></td>
                <td><?= h($contributor->alias) ?></td>
                <td><?= $this->Number->format($contributor->legacy_user_id) ?></td>
                <td><?= h($contributor->created) ?></td>
                <td><?= h($contributor->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contributor->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contributor->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contributor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contributor->id)]) ?>
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
