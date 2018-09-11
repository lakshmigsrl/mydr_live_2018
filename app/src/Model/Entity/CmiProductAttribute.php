<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmiProductAttribute Entity.
 *
 * @property int $id
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $product_type_id
 * @property \App\Model\Entity\ProductType $product_type
 * @property int $product_id
 * @property \App\Model\Entity\Product $product
 * @property int $attribute_id
 * @property \App\Model\Entity\Attribute $attribute
 * @property int $value_id
 * @property \App\Model\Entity\Value $value
 * @property int $sort_order
 */
class CmiProductAttribute extends Entity
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
