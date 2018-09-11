<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cmiIssue->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cmiIssue->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cmi Issues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cmiIssues form large-9 medium-8 columns content">
    <?= $this->Form->create($cmiIssue) ?>
    <fieldset>
        <legend><?= __('Edit Cmi Issue') ?></legend>
        <?php
            echo $this->Form->input('issue');
            echo $this->Form->input('issue_id');
            echo $this->Form->input('data_version');
            echo $this->Form->input('dat_data_version', ['empty' => true]);
            echo $this->Form->input('copyright');
            echo $this->Form->input('dat_release', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
