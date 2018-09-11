<h3 class="pull-left"><?= __('Sources') ?></h3>
<div class="pull-right"><?= $this->Html->link(__('Add'), ['action' => 'add'],  ['class' => 'btn btn-primary']) ?></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('value') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sources as $source): ?>
        <tr>
            <td><?= $this->Number->format($source->id) ?></td>
            <td><?= h($source->value) ?></td>
            <td><?= h($source->created) ?></td>
            <td><?= h($source->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $source->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $source->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $source->id], ['confirm' => __('Are you sure you want to delete # {0}?', $source->id)]) ?>
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