<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Footer'), ['action' => 'edit', $footer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Footer'), ['action' => 'delete', $footer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $footer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Footers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Footer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="footers view large-9 medium-8 columns content">
    <h3><?= h($footer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($footer->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= h($footer->value) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($footer->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($footer->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($footer->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Articles') ?></h4>
        <?php if (!empty($footer->articles)): ?>
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
            <?php foreach ($footer->articles as $articles): ?>
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
