
<!-- To access from backend go to: /admin/cmi-product-surveys -->
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cmi Product Survey'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cmi Products'), ['controller' => 'CmiProducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cmi Product'), ['controller' => 'CmiProducts', 'action' => 'add']) ?></li>
    </ul>
</nav> -->

<div class="row">
    <div class="col-md-11">
        <div class="row background--main pbs">

            <?php
            echo $this->Form->create();
            ?>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('q', ['label' => 'CMI Url']);
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


<h3><?= __('Cmi Product Surveys') ?></h3>
<div class="row ptm">
  <div class="col-md-11">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('cmi_product_id') ?></th>
                <th><?= $this->Paginator->sort('cmi_full_url') ?></th>
                <th><?= $this->Paginator->sort('answer1') ?></th>
                <th><?= $this->Paginator->sort('answer2') ?></th>
                <th><?= $this->Paginator->sort('data1') ?></th>
                <th><?= $this->Paginator->sort('answer3') ?></th>
                <th><?= $this->Paginator->sort('data2') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cmiProductSurveys as $cmiProductSurvey): ?>
            <tr>
                <td><?= $this->Number->format($cmiProductSurvey->id) ?></td>
                <td>
                    <?php if ($cmiProductSurvey->has('cmi_product')):?>
                        <a href="/medicines/cmis/<?= $cmiProductSurvey->cmi_product->full_url ?>"><?= $cmiProductSurvey->cmi_product->url_name;?></a>
                    <?php endif;?>
                </td>
                <td><?= h($cmiProductSurvey->cmi_full_url) ?></td>
                <td><?= h($cmiProductSurvey->answer1) ?></td>
                <td><?= h($cmiProductSurvey->answer2) ?></td>
                <td><?= h($cmiProductSurvey->data1) ?></td>
                <td><?= h($cmiProductSurvey->answer3) ?></td>
                <td><?= h($cmiProductSurvey->data2) ?></td>
                <td><?= h($cmiProductSurvey->created) ?></td>
                <td><?= h($cmiProductSurvey->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cmiProductSurvey->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmiProductSurvey->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cmiProductSurvey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProductSurvey->id)]) ?>
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
