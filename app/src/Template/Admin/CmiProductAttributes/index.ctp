<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cmi Product Attribute'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cmiProductAttributes index large-9 medium-8 columns content">
    <h3><?= __('Cmi Product Attributes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('product_type_id') ?></th>
                <th><?= $this->Paginator->sort('product_id') ?></th>
                <th><?= $this->Paginator->sort('attribute_id') ?></th>
                <th><?= $this->Paginator->sort('value_id') ?></th>
                <th><?= $this->Paginator->sort('sort_order') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cmiProductAttributes as $cmiProductAttribute): ?>
            <tr>
                <td><?= $this->Number->format($cmiProductAttribute->id) ?></td>
                <td><?= $this->Number->format($cmiProductAttribute->country_id) ?></td>
                <td><?= $this->Number->format($cmiProductAttribute->product_type_id) ?></td>
                <td><?= $this->Number->format($cmiProductAttribute->product_id) ?></td>
                <td><?= $this->Number->format($cmiProductAttribute->attribute_id) ?></td>
                <td><?= $this->Number->format($cmiProductAttribute->value_id) ?></td>
                <td><?= $this->Number->format($cmiProductAttribute->sort_order) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cmiProductAttribute->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmiProductAttribute->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cmiProductAttribute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProductAttribute->id)]) ?>
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
