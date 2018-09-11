<?php
echo $this->element('../Users/_side');
?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Login') ?></th>
            <td><?= h($user->login) ?></td>
        </tr>
        <tr>
            <th><?= __('Fname') ?></th>
            <td><?= h($user->fname) ?></td>
        </tr>
        <tr>
            <th><?= __('Initials') ?></th>
            <td><?= h($user->initials) ?></td>
        </tr>
        <tr>
            <th><?= __('Lname') ?></th>
            <td><?= h($user->lname) ?></td>
        </tr>
        <tr>
            <th><?= __('Nickname') ?></th>
            <td><?= h($user->nickname) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Homepage') ?></th>
            <td><?= h($user->homepage) ?></td>
        </tr>
        <tr>
            <th><?= __('Pwd') ?></th>
            <td><?= h($user->pwd) ?></td>
        </tr>
        <tr>
            <th><?= __('Tmp Pwd') ?></th>
            <td><?= h($user->tmp_pwd) ?></td>
        </tr>
        <tr>
            <th><?= __('Salt') ?></th>
            <td><?= h($user->salt) ?></td>
        </tr>
        <tr>
            <th><?= __('Hint') ?></th>
            <td><?= h($user->hint) ?></td>
        </tr>
        <tr>
            <th><?= __('Addr1') ?></th>
            <td><?= h($user->addr1) ?></td>
        </tr>
        <tr>
            <th><?= __('Addr2') ?></th>
            <td><?= h($user->addr2) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= h($user->state) ?></td>
        </tr>
        <tr>
            <th><?= __('Postcode') ?></th>
            <td><?= h($user->postcode) ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= h($user->country) ?></td>
        </tr>
        <tr>
            <th><?= __('Otherhealth') ?></th>
            <td><?= h($user->otherhealth) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= $this->Number->format($user->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Oldid') ?></th>
            <td><?= $this->Number->format($user->oldid) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Login') ?></th>
            <td><?= h($user->last_login) ?></td>
        </tr>
        <tr>
            <th><?= __('Tmp Pwd Expiry') ?></th>
            <td><?= h($user->tmp_pwd_expiry) ?></td>
        </tr>
        <tr>
            <th><?= __('Dob') ?></th>
            <td><?= h($user->dob) ?></td>
        </tr>
        <tr>
            <th><?= __('Update') ?></th>
            <td><?= h($user->update) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= h($user->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Email Status') ?></th>
            <td><?= $user->email_status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Updates') ?></th>
            <td><?= $user->updates ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Newsletters') ?></th>
            <td><?= $user->newsletters ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Thirdpartyoffers') ?></th>
            <td><?= $user->thirdpartyoffers ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Surveys') ?></th>
            <td><?= $user->surveys ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Samples') ?></th>
            <td><?= $user->samples ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Trials') ?></th>
            <td><?= $user->trials ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Reports') ?></th>
            <td><?= $user->reports ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Forums') ?></th>
            <td><?= $user->forums ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $user->status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Terms') ?></th>
            <td><?= $user->terms ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Gender') ?></h4>
        <?= $this->Text->autoParagraph(h($user->gender)); ?>
    </div>
    <div class="row">
        <h4><?= __('Type') ?></h4>
        <?= $this->Text->autoParagraph(h($user->type)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related User History') ?></h4>
        <?php if (!empty($user->user_history)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Id') ?></th>
                <th><?= __('Timestamp') ?></th>
                <th><?= __('Ip') ?></th>
                <th><?= __('Type') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_history as $userHistory): ?>
            <tr>
                <td><?= h($userHistory->user_id) ?></td>
                <td><?= h($userHistory->timestamp) ?></td>
                <td><?= h($userHistory->ip) ?></td>
                <td><?= h($userHistory->type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserHistory', 'action' => 'view', $userHistory->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserHistory', 'action' => 'edit', $userHistory->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserHistory', 'action' => 'delete', $userHistory->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userHistory->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Logins') ?></h4>
        <?php if (!empty($user->user_logins)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Id') ?></th>
                <th><?= __('Timestamp') ?></th>
                <th><?= __('Ip') ?></th>
                <th><?= __('Referer') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_logins as $userLogins): ?>
            <tr>
                <td><?= h($userLogins->user_id) ?></td>
                <td><?= h($userLogins->timestamp) ?></td>
                <td><?= h($userLogins->ip) ?></td>
                <td><?= h($userLogins->referer) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserLogins', 'action' => 'view', $userLogins->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserLogins', 'action' => 'edit', $userLogins->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserLogins', 'action' => 'delete', $userLogins->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userLogins->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
