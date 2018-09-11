<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cmi Link Product Document'), ['action' => 'edit', $cmiLinkProductDocument->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cmi Link Product Document'), ['action' => 'delete', $cmiLinkProductDocument->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiLinkProductDocument->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cmi Link Product Documents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cmi Link Product Document'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cmiLinkProductDocuments view large-9 medium-8 columns content">
    <h3><?= h($cmiLinkProductDocument->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Document Name') ?></th>
            <td><?= h($cmiLinkProductDocument->document_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($cmiLinkProductDocument->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cmiLinkProductDocument->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($cmiLinkProductDocument->country_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Type Id') ?></th>
            <td><?= $this->Number->format($cmiLinkProductDocument->product_type_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Actual Product Id') ?></th>
            <td><?= $this->Number->format($cmiLinkProductDocument->actual_product_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Doc Type Id') ?></th>
            <td><?= $this->Number->format($cmiLinkProductDocument->doc_type_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($cmiLinkProductDocument->sort_order) ?></td>
        </tr>
    </table>
</div>
