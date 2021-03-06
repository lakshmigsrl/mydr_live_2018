<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmiIssue Entity.
 *
 * @property int $id
 * @property \App\Model\Entity\Issue $issue
 * @property string $issue_id
 * @property int $data_version
 * @property \Cake\I18n\Time $dat_data_version
 * @property string $copyright
 * @property \Cake\I18n\Time $dat_release
 */
class CmiIssue extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
