<?= $this->Form->create($cmiLinkProductDocument) ?>
<fieldset>
    <legend><?= __('Edit Cmi Link Product Document') ?></legend>
    <?php
        echo $this->Form->input('country_id');
        echo $this->Form->input('product_type_id');
        echo $this->Form->input('actual_product_id');
        echo $this->Form->input('document_name');
        echo $this->Form->input('doc_type_id');
        echo $this->Form->input('description');
        echo $this->Form->input('sort_order');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
