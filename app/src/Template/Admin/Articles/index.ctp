
<div class="row">
    <div class="col-md-11">
        <h3 class="pull-left"><?= __('Articles') ?></h3>
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
        //echo $this->Form->input('next_review', ['type' => 'date']);
        // Match the search param in your table configuration
        echo $this->Form->input('q', ['label' => 'Title']);
        ?>
    </div>
    <div class="col-md-3">
        <?php
        echo $this->Form->input('section_id', ['empty' => '-']);
        echo $this->Form->input('format_type',['options' => $constant_options['format_type'],'empty' => '-'] );
        echo $this->Form->input('medical_type',['options' => $constant_options['medical_type'],'empty' => '-'] );
        ?>
    </div>

    <div class="col-md-3">
        <?php
        echo $this->Form->input('status',['options' => $constant_options['status'],'empty' => '-'] );
        echo $this->Form->input('hi_status',['options' => $constant_options['hi_status'],'empty' => '-'] );
//        echo $this->Form->input('status',['options' => $constant_options['status'],'empty' => '-'] );
        echo $this->Form->input('author_id', ['empty' => '-']);
        //echo $this->Form->input('next_review', ['type' => 'date']);
        // Match the search param in your table configuration
//        echo $this->Form->input('q', ['label' => 'Title']);
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
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('format_type') ?></th>
                <th><?= $this->Paginator->sort('medical_type') ?></th>
                <th><?= $this->Paginator->sort('section_id',['label' => 'Primary Section']) ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('reviewed') ?></th>
                <th>
                    <?= $this->Paginator->sort('created') ?> /
                    <?= $this->Paginator->sort('modified') ?>
                </th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= h($article->id) ?></td>
                <td><?= h($article->title) ?></td>
                <td><?= h($article->format_type) ?></td>
                <td><?= h($article->medical_type) ?></td>
                <td><?= h($article->section->name ?? "") ?></td>
                <td><?= h($constant_options['status'][$article->status]) ?></td>
                <td>
                    <?php
                    echo date("d/M/Y", strtotime($article->reviewed));
                    ?>
                </td>
                <td>
                    C:<?= h($article->created) ?><br>
                    M:<?= h($article->modified) ?></td>
                <td class="actions">
                    <?php if(isset($article->section)){ ?>
                          <?= $this->Html->link(__('View'), '/'.$article->section->url . '/' . $article->url , ['target' => '_blank']); ?>
                    <?php } ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                    /
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
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
