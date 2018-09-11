<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contributor Entity.
 *
 * @property int $id
 * @property string $display_name
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $profile
 * @property string $alias
 * @property int $legacy_user_id
 * @property \App\Model\Entity\LegacyUser $legacy_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\ArticleLog[] $article_logs
 */
class Contributor extends Entity
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
