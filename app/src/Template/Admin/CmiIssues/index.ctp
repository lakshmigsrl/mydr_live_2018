<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cmi Issue'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cmiIssues index large-9 medium-8 columns content">
    <h3><?= __('Cmi Issues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('issue') ?></th>
                <th><?= $this->Paginator->sort('issue_id') ?></th>
                <th><?= $this->Paginator->sort('data_version') ?></th>
                <th><?= $this->Paginator->sort('dat_data_version') ?></th>
                <th><?= $this->Paginator->sort('copyright') ?></th>
                <th><?= $this->Paginator->sort('dat_release') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cmiIssues as $cmiIssue): ?>
            <tr>
                <td><?= $this->Number->format($cmiIssue->id) ?></td>
                <td><?= h($cmiIssue->issue) ?></td>
                <td><?= h($cmiIssue->issue_id) ?></td>
                <td><?= $this->Number->format($cmiIssue->data_version) ?></td>
                <td><?= h($cmiIssue->dat_data_version) ?></td>
                <td><?= h($cmiIssue->copyright) ?></td>
                <td><?= h($cmiIssue->dat_release) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cmiIssue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmiIssue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cmiIssue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiIssue->id)]) ?>
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
