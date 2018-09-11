<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cmi Product Attribute'), ['action' => 'edit', $cmiProductAttribute->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cmi Product Attribute'), ['action' => 'delete', $cmiProductAttribute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProductAttribute->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cmi Product Attributes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cmi Product Attribute'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cmiProductAttributes view large-9 medium-8 columns content">
    <h3><?= h($cmiProductAttribute->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->country_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Type Id') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->product_type_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Id') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->product_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Attribute Id') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->attribute_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Value Id') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->value_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($cmiProductAttribute->sort_order) ?></td>
        </tr>
    </table>
</div>
