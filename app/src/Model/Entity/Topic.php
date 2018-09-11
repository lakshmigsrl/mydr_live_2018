<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Topic Entity.
 *
 * @property int $id
 * @property string $section_id
 * @property \App\Model\Entity\Section $section
 * @property string $title
 * @property string $url
 * @property string $body
 * @property string $keywords
 * @property string $description
 * @property string $header
 * @property string $details
 * @property int $status
 * @property string $main_image
 * @property string $main_image_alttext
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Article[] $articles
 */
class Topic extends Entity
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
