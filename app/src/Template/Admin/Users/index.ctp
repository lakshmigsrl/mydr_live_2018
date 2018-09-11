<h3 class="pull-left"><?= __('Users') ?></h3>
<div class="pull-right"><?= $this->Html->link(__('Add'), ['action' => 'add'],  ['class' => 'btn btn-primary']) ?></div>
<table class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('fname') ?></th>
                <th><?= $this->Paginator->sort('lname') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->fname) ?></td>
                <td><?= h($user->lname) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->status) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
