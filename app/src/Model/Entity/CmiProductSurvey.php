<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmiProductSurvey Entity.
 *
 * @property int $id
 * @property int $cmi_product_id
 * @property \App\Model\Entity\CmiProduct $cmi_product
 * @property string $cmi_full_url
 * @property string $answer1
 * @property string $answer2
 * @property string $answer3
 * @property string $data1
 * @property string $data2
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CmiProductSurvey extends Entity
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
