<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArticleLog Entity.
 *
 * @property int $id
 * @property int $article_id
 * @property \App\Model\Entity\Article $article
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $log_type
 * @property \Cake\I18n\Time $date
 * @property string $notes
 * @property \Cake\I18n\Time $created
 */
class ArticleLog extends Entity
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
