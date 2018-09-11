<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Topic'), ['action' => 'edit', $topic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Topic'), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Topics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Topic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="topics view large-9 medium-8 columns content">
    <h3><?= h($topic->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= $topic->has('section') ? $this->Html->link($topic->section->name, ['controller' => 'Sections', 'action' => 'view', $topic->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($topic->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($topic->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Main Image') ?></th>
            <td><?= h($topic->main_image) ?></td>
        </tr>
        <tr>
            <th><?= __('Main Image Alttext') ?></th>
            <td><?= h($topic->main_image_alttext) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($topic->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($topic->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($topic->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($topic->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($topic->body)); ?>
    </div>
    <div class="row">
        <h4><?= __('Keywords') ?></h4>
        <?= $this->Text->autoParagraph(h($topic->keywords)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($topic->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Header') ?></h4>
        <?= $this->Text->autoParagraph(h($topic->header)); ?>
    </div>
    <div class="row">
        <h4><?= __('Details') ?></h4>
        <?= $this->Text->autoParagraph(h($topic->details)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Articles') ?></h4>
        <?php if (!empty($topic->articles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Blurb') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('Main Image') ?></th>
                <th><?= __('Generic Image') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Reference') ?></th>
                <th><?= __('Format Type') ?></th>
                <th><?= __('Medical Type') ?></th>
                <th><?= __('Audience') ?></th>
                <th><?= __('Hi Status') ?></th>
                <th><?= __('Content Gender') ?></th>
                <th><?= __('Section Id') ?></th>
                <th><?= __('Source Id') ?></th>
                <th><?= __('Author Id') ?></th>
                <th><?= __('Footer Id') ?></th>
                <th><?= __('Licensable') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Legacy Id') ?></th>
                <th><?= __('Start Date') ?></th>
                <th><?= __('End Date') ?></th>
                <th><?= __('Next Review') ?></th>
                <th><?= __('Reviewed') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($topic->articles as $articles): ?>
            <tr>
                <td><?= h($articles->id) ?></td>
                <td><?= h($articles->title) ?></td>
                <td><?= h($articles->url) ?></td>
                <td><?= h($articles->blurb) ?></td>
                <td><?= h($articles->description) ?></td>
                <td><?= h($articles->body) ?></td>
                <td><?= h($articles->main_image) ?></td>
                <td><?= h($articles->generic_image) ?></td>
                <td><?= h($articles->note) ?></td>
                <td><?= h($articles->reference) ?></td>
                <td><?= h($articles->format_type) ?></td>
                <td><?= h($articles->medical_type) ?></td>
                <td><?= h($articles->audience) ?></td>
                <td><?= h($articles->hi_status) ?></td>
                <td><?= h($articles->content_gender) ?></td>
                <td><?= h($articles->section_id) ?></td>
                <td><?= h($articles->source_id) ?></td>
                <td><?= h($articles->author_id) ?></td>
                <td><?= h($articles->footer_id) ?></td>
                <td><?= h($articles->licensable) ?></td>
                <td><?= h($articles->status) ?></td>
                <td><?= h($articles->legacy_id) ?></td>
                <td><?= h($articles->start_date) ?></td>
                <td><?= h($articles->end_date) ?></td>
                <td><?= h($articles->next_review) ?></td>
                <td><?= h($articles->reviewed) ?></td>
                <td><?= h($articles->created) ?></td>
                <td><?= h($articles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
