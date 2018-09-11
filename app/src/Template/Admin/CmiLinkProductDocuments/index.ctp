<h3 class="pull-left"><?= __('Cmi Link Product Documents') ?></h3>
<div class="pull-right"><?= $this->Html->link(__('Add'), ['action' => 'add'],  ['class' => 'btn btn-primary']) ?></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('country_id') ?></th>
            <th><?= $this->Paginator->sort('product_type_id') ?></th>
            <th><?= $this->Paginator->sort('actual_product_id') ?></th>
            <th><?= $this->Paginator->sort('document_name') ?></th>
            <th><?= $this->Paginator->sort('doc_type_id') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th><?= $this->Paginator->sort('sort_order') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cmiLinkProductDocuments as $cmiLinkProductDocument): ?>
        <tr>
            <td><?= $this->Number->format($cmiLinkProductDocument->id) ?></td>
            <td><?= $this->Number->format($cmiLinkProductDocument->country_id) ?></td>
            <td><?= $this->Number->format($cmiLinkProductDocument->product_type_id) ?></td>
            <td><?= $this->Number->format($cmiLinkProductDocument->actual_product_id) ?></td>
            <td><?= h($cmiLinkProductDocument->document_name) ?></td>
            <td><?= $this->Number->format($cmiLinkProductDocument->doc_type_id) ?></td>
            <td><?= h($cmiLinkProductDocument->description) ?></td>
            <td><?= $this->Number->format($cmiLinkProductDocument->sort_order) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $cmiLinkProductDocument->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmiLinkProductDocument->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cmiLinkProductDocument->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiLinkProductDocument->id)]) ?>
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
