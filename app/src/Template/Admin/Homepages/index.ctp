<h3 class="pull-left"><?= __('Homepages') ?></h3>
<div class="pull-right"><?= $this->Html->link(__('Add'), ['action' => 'add'],  ['class' => 'btn btn-primary']) ?></div>

    <table class="table table-bordered">
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
        <!-- Pagination -->
        <ul class="pagination">
           <li><?= $this->Paginator->prev(__('<i class="fa fa-chevron-left"></i> Previous'), ['escape' => false]) ?></li>
           <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
           <li><?= $this->Paginator->next(__('Next') . '  <i class="fa fa-chevron-right"></i>', ['escape' => false]) ?></li>
           <li><p><?= $this->Paginator->counter() ?></p></li>
        </ul>
        <!-- end Pagination -->
    </div>
