<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cmiProductSurvey->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProductSurvey->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cmi Product Surveys'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cmi Products'), ['controller' => 'CmiProducts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cmi Product'), ['controller' => 'CmiProducts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cmiProductSurveys form large-9 medium-8 columns content">
    <?= $this->Form->create($cmiProductSurvey) ?>
    <fieldset>
        <legend><?= __('Edit Cmi Product Survey') ?></legend>
        <?php
            echo $this->Form->input('cmi_product_id', ['options' => $cmiProducts]);
            echo $this->Form->input('cmi_full_url');
            echo $this->Form->input('answer1');
            echo $this->Form->input('answer2');
            echo $this->Form->input('answer3');
            echo $this->Form->input('data1');
            echo $this->Form->input('data2');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
