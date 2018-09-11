<div class="row">
    <div class="col-md-11">
        <h3 class="pull-left"><?= __('Cmi Products') ?></h3>
        <div class="pull-right"><?= $this->Html->link(__('Add'), ['action' => 'add'],  ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>
<div class="row">
    <div class="col-md-11">
        <div class="row background--main pbs">

            <?php
            echo $this->Form->create();
            ?>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('q', ['label' => 'Title']);
                ?>
            </div>
            <div class="col-md-12">
                <?php
                echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-primary mrs']);
                echo $this->Html->link('Reset', ['action' => 'index'], [ 'class' => 'btn btn-default']);
                echo $this->Form->end();
                ?>
            </div>

        </div>
    </div>
</div>


<div class="row ptm">
    <div class="col-md-11">
        <table class="table table-bordered">
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
                        <?= $this->Html->link(__('View Fields'), ['action' => 'view', $cmiProduct->id]) ?> /
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmiProduct->id]) ?> /
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cmiProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProduct->id)]) ?> /
                        <a href="/medicines/cmis/<?= $cmiProduct->full_url ?>">View Actual</a>
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
    </div>
</div>
