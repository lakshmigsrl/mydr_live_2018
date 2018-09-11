<div class="tools view large-9 medium-8 columns content">
    <h3><?= h($tool->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($tool->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($tool->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><?= h($tool->image) ?></td>
        </tr>
        <tr>
            <th><?= __('Author') ?></th>
            <td><?= $tool->has('author') ? $this->Html->link($tool->author->name, ['controller' => 'Authors', 'action' => 'view', $tool->author->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Dilhma Code') ?></th>
            <td><?= h($tool->dilhma_code) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tool->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Publisher Id') ?></th>
            <td><?= $this->Number->format($tool->publisher_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($tool->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Review') ?></th>
            <td><?= h($tool->review) ?></td>
        </tr>
        <tr>
            <th><?= __('Reviewed') ?></th>
            <td><?= h($tool->reviewed) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($tool->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($tool->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $tool->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($tool->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($tool->body)); ?>
    </div>
    <div class="row">
        <h4><?= __('Keywords') ?></h4>
        <?= $this->Text->autoParagraph(h($tool->keywords)); ?>
    </div>
    <div class="row">
        <h4><?= __('Reference') ?></h4>
        <?= $this->Text->autoParagraph(h($tool->reference)); ?>
    </div>
</div>
