<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contributor'), ['action' => 'edit', $contributor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contributor'), ['action' => 'delete', $contributor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contributor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contributors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contributor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Article Logs'), ['controller' => 'ArticleLogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article Log'), ['controller' => 'ArticleLogs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contributors view large-9 medium-8 columns content">
    <h3><?= h($contributor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Display Name') ?></th>
            <td><?= h($contributor->display_name) ?></td>
        </tr>
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($contributor->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($contributor->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($contributor->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Profile') ?></th>
            <td><?= h($contributor->profile) ?></td>
        </tr>
        <tr>
            <th><?= __('Alias') ?></th>
            <td><?= h($contributor->alias) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contributor->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Legacy User Id') ?></th>
            <td><?= $this->Number->format($contributor->legacy_user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($contributor->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($contributor->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Article Logs') ?></h4>
        <?php if (!empty($contributor->article_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Article Id') ?></th>
                <th><?= __('Contributor Id') ?></th>
                <th><?= __('Log Type') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Notes') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($contributor->article_logs as $articleLogs): ?>
            <tr>
                <td><?= h($articleLogs->id) ?></td>
                <td><?= h($articleLogs->article_id) ?></td>
                <td><?= h($articleLogs->contributor_id) ?></td>
                <td><?= h($articleLogs->log_type) ?></td>
                <td><?= h($articleLogs->date) ?></td>
                <td><?= h($articleLogs->notes) ?></td>
                <td><?= h($articleLogs->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ArticleLogs', 'action' => 'view', $articleLogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ArticleLogs', 'action' => 'edit', $articleLogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ArticleLogs', 'action' => 'delete', $articleLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleLogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
