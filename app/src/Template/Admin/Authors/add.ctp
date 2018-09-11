<script src="//cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
<?php echo $this->Html->script('/ckfinder/ckfinder.js');?>
<?= $this->Form->create($author) ?>
<fieldset>
    <legend><?= __('Add Author') ?></legend>
    <?php
    echo $this->element('../Admin/Authors/_form');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

<?php
echo $this->Html->script('author');
?>