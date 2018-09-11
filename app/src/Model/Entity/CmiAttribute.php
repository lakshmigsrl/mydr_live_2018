<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmiAttribute Entity.
 *
 * @property int $id
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $attribute_id
 * @property \App\Model\Entity\Attribute $attribute
 * @property string $description
 * @property int $selection_type_id
 * @property \App\Model\Entity\SelectionType $selection_type
 * @property int $include_in_quick_search
 * @property int $include_in_advance_search
 * @property int $include_in_identa_quick_search
 * @property int $include_in_identa_advanced_search
 * @property int $multi_value
 * @property string $property_value
 * @property int $is_numeric
 */
class CmiAttribute extends Entity
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
