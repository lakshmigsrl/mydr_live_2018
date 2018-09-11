<?php echo $this->Html->script('/ckeditor/ckeditor.js');?>
<?php echo $this->Html->script('/ckfinder/ckfinder.js');?>
<?php echo $this->Html->script('/js/bootstrap/bootstrap3-typeahead.js');?>
<div class="col-md-8">
<?php
// echo "<input type='text' value='' id='linoInput' />";
// echo "<div id='myDivA'></div>";
?>

    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Edit Article: ').' <span style="color: #606060; font-size: 16px; font-style: italic;"> '.$article->title.' [ '.$article->id.' ]</span>' ?></legend>
        <?php
        echo $this->element('../Admin/Articles/_form');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?php
        echo $this->Form->button('Cancel', array(
           'type' => 'button',
           'onclick' => 'location.href=\'/admin\''
        ));
    ?>
    <?= $this->Form->end() ?>
    <br /><br /><br />

</div>
<?php echo $this->Html->script('article'); ?>
<?php echo $this->Html->script('article_ajax'); ?>
