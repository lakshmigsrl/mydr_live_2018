<?php echo $this->Html->script('/ckeditor/ckeditor.js');?>
<?php echo $this->Html->script('/ckfinder/ckfinder.js');?>
<?php echo $this->Html->script('/js/bootstrap/bootstrap3-typeahead.js');?>

<div class="col-md-8">

    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
        echo $this->element('../Admin/Articles/_form');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php echo $this->Html->script('article'); ?>
<?php echo $this->Html->script('article_ajax'); ?>
