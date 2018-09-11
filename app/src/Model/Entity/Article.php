<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $blurb
 * @property string $description
 * @property string $body
 * @property string $main_image
 * @property string $page_image
 * @property string $generic_image
 * @property string $note
 * @property string $reference
 * @property string $format_type
 * @property string $medical_type
 * @property string $audience
 * @property string $hi_status
 * @property string $content_gender
 * @property int $section_id
 * @property \App\Model\Entity\Section $section
 * @property int $source_id
 * @property \App\Model\Entity\Source $source
 * @property int $author_id
 * @property \App\Model\Entity\Author $author
 * @property int $footer_id
 * @property \App\Model\Entity\Footer $footer
 * @property string $licensable
 * @property int $status
 * @property int $legacy_id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property \Cake\I18n\Time $next_review
 * @property \Cake\I18n\Time $reviewed
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $article_video
 */
class Article extends Entity
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
