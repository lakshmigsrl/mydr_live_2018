<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cmi Issue'), ['action' => 'edit', $cmiIssue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cmi Issue'), ['action' => 'delete', $cmiIssue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiIssue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cmi Issues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cmi Issue'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cmiIssues view large-9 medium-8 columns content">
    <h3><?= h($cmiIssue->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Issue') ?></th>
            <td><?= h($cmiIssue->issue) ?></td>
        </tr>
        <tr>
            <th><?= __('Issue Id') ?></th>
            <td><?= h($cmiIssue->issue_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Copyright') ?></th>
            <td><?= h($cmiIssue->copyright) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cmiIssue->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Version') ?></th>
            <td><?= $this->Number->format($cmiIssue->data_version) ?></td>
        </tr>
        <tr>
            <th><?= __('Dat Data Version') ?></th>
            <td><?= h($cmiIssue->dat_data_version) ?></td>
        </tr>
        <tr>
            <th><?= __('Dat Release') ?></th>
            <td><?= h($cmiIssue->dat_release) ?></td>
        </tr>
    </table>
</div>
