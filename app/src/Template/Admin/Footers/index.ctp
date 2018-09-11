<h3 class="pull-left"><?= __('Footers') ?></h3>
<div class="pull-right"><?= $this->Html->link(__('Add'), ['action' => 'add'],  ['class' => 'btn btn-primary']) ?></div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('value') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($footers as $footer): ?>
        <tr>
            <td><?= $this->Number->format($footer->id) ?></td>
            <td><?= h($footer->name) ?></td>
            <td><?= h($footer->value) ?></td>
            <td><?= h($footer->created) ?></td>
            <td><?= h($footer->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $footer->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $footer->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $footer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $footer->id)]) ?>
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