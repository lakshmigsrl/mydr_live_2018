
<?= $this->Form->create($cmiProduct) ?>
<fieldset>
    <legend><?= __('Add Cmi Product') ?></legend>
    <?php
        echo $this->Form->input('country_id');
        echo $this->Form->input('product_type_id');
        echo $this->Form->input('product_id');
        echo $this->Form->input('description');
        echo $this->Form->input('url_name');
        echo $this->Form->input('url');
        echo $this->Form->input('full_url');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
