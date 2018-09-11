<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cmi Product Attributes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cmiProductAttributes form large-9 medium-8 columns content">
    <?= $this->Form->create($cmiProductAttribute) ?>
    <fieldset>
        <legend><?= __('Add Cmi Product Attribute') ?></legend>
        <?php
            echo $this->Form->input('country_id');
            echo $this->Form->input('product_type_id');
            echo $this->Form->input('product_id');
            echo $this->Form->input('attribute_id');
            echo $this->Form->input('value_id');
            echo $this->Form->input('sort_order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
