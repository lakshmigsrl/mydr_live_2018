<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cmi Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cmiProducts index large-9 medium-8 columns content">
    <h3><?= __('Cmi Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('product_type_id') ?></th>
                <th><?= $this->Paginator->sort('product_id') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('url_name') ?></th>
                <th><?= $this->Paginator->sort('url') ?></th>
                <th><?= $this->Paginator->sort('full_url') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cmiProducts as $cmiProduct): ?>
            <tr>
                <td><?= $this->Number->format($cmiProduct->id) ?></td>
                <td><?= $this->Number->format($cmiProduct->country_id) ?></td>
                <td><?= $this->Number->format($cmiProduct->product_type_id) ?></td>
                <td><?= $this->Number->format($cmiProduct->product_id) ?></td>
                <td><?= h($cmiProduct->description) ?></td>
                <td><?= h($cmiProduct->url_name) ?></td>
                <td><?= h($cmiProduct->url) ?></td>
                <td><?= h($cmiProduct->full_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cmiProduct->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmiProduct->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cmiProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProduct->id)]) ?>
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
