<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cmiProductAttribute->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProductAttribute->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cmi Product Attributes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cmiProductAttributes form large-9 medium-8 columns content">
    <?= $this->Form->create($cmiProductAttribute) ?>
    <fieldset>
        <legend><?= __('Edit Cmi Product Attribute') ?></legend>
        <?php
            echo $this->Form->input('country_id', ['type' => 'textbox']);
            echo $this->Form->input('product_type_id', ['type' => 'textbox']);
            echo $this->Form->input('product_id', ['type' => 'textbox']);
            echo $this->Form->input('attribute_id', ['type' => 'textbox']);
            echo $this->Form->input('value_id', ['type' => 'textbox']);
            echo $this->Form->input('sort_order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
