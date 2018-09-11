<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cmi Product Survey'), ['action' => 'edit', $cmiProductSurvey->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cmi Product Survey'), ['action' => 'delete', $cmiProductSurvey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmiProductSurvey->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cmi Product Surveys'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cmi Product Survey'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cmi Products'), ['controller' => 'CmiProducts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cmi Product'), ['controller' => 'CmiProducts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cmiProductSurveys view large-9 medium-8 columns content">
    <h3><?= h($cmiProductSurvey->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Cmi Product') ?></th>
            <td><?= $cmiProductSurvey->has('cmi_product') ? $this->Html->link($cmiProductSurvey->cmi_product->id, ['controller' => 'CmiProducts', 'action' => 'view', $cmiProductSurvey->cmi_product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Cmi Full Url') ?></th>
            <td><?= h($cmiProductSurvey->cmi_full_url) ?></td>
        </tr>
        <tr>
            <th><?= __('Answer1') ?></th>
            <td><?= h($cmiProductSurvey->answer1) ?></td>
        </tr>
        <tr>
            <th><?= __('Answer2') ?></th>
            <td><?= h($cmiProductSurvey->answer2) ?></td>
        </tr>
        <tr>
            <th><?= __('Answer3') ?></th>
            <td><?= h($cmiProductSurvey->answer3) ?></td>
        </tr>
        <tr>
            <th><?= __('Data1') ?></th>
            <td><?= h($cmiProductSurvey->data1) ?></td>
        </tr>
        <tr>
            <th><?= __('Data2') ?></th>
            <td><?= h($cmiProductSurvey->data2) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cmiProductSurvey->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($cmiProductSurvey->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($cmiProductSurvey->modified) ?></td>
        </tr>
    </table>
</div>
