
<div class="row">
    <div class="col-md-11">

        <h3 class="pull-left"><?= __('Tools') ?></h3>
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
                echo $this->Form->input('id', ['label' => 'Article ID']);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('q', ['label' => 'Title']);
                ?>
            </div>

            <div class="col-md-3">
                <?php
                echo $this->Form->input('author_id', ['empty' => '-']);
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
<table class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('url') ?></th>
                <th><?= $this->Paginator->sort('author_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('review', 'Next Review') ?></th>
                <th><?= $this->Paginator->sort('reviewed') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tools as $tool): ?>
            <tr>
                <td><?= $this->Number->format($tool->id) ?></td>
                <td><?= h($tool->title) ?></td>
                <td><?= h($tool->url) ?>a</td>
                <td>
                    <?= $tool->has('author') ? $this->Html->link($tool->author->name, ['controller' => 'Authors', 'action' => 'view', $tool->author->id]) : '' ?>
                </td>
                <td><?= h($constant_options['status'][$tool->status]) ?></td>
                <td><?= h($tool->review) ?></td>
                <td><?= h($tool->reviewed) ?></td>
                <td><?= h($tool->created) ?></td>
                <td><?= h($tool->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), '/tools/' . $tool->url , ['target' => '_blank']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tool->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tool->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tool->id)]) ?>
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
</div>
