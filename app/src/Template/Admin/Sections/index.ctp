
<div class="row">
    <div class="col-md-11">
        <h3 class="pull-left"><?= __('Sections') ?></h3>
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
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('url') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sections as $section): ?>
            <tr>
                <td><?= $this->Number->format($section->id) ?></td>
                <td><?= h($section->name) ?></td>
                <td><?= h($section->url) ?></td>
                <td><?= $this->Number->format($section->status) ?></td>
                <td><?= h($section->created) ?></td>
                <td><?= h($section->modified) ?></td>
                <td class="actions">
                    <a href='/<?= $section->url?>'>View</a>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $section->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $section->id], ['confirm' => __('Are you sure you want to delete # {0}?', $section->id)]) ?>
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
