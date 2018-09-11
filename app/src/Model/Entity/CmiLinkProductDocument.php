<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmiLinkProductDocument Entity.
 *
 * @property int $id
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $product_type_id
 * @property \App\Model\Entity\ProductType $product_type
 * @property int $actual_product_id
 * @property \App\Model\Entity\ActualProduct $actual_product
 * @property string $document_name
 * @property int $doc_type_id
 * @property \App\Model\Entity\DocType $doc_type
 * @property string $description
 * @property int $sort_order
 */
class CmiLinkProductDocument extends Entity
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
