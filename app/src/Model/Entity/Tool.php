<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tool Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $description
 * @property string $body
 * @property string $keywords
 * @property string $reference
 * @property string $image
 * @property int $author_id
 * @property \App\Model\Entity\Author $author
 * @property int $publisher_id
 * @property \App\Model\Entity\Publisher $publisher
 * @property bool $status
 * @property string $dilhma_code
 * @property int $type
 * @property \Cake\I18n\Time $review
 * @property \Cake\I18n\Time $reviewed
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Tool extends Entity
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

    function js_code(){
        $results = false;
        if(!empty($this->js_code)){
            foreach(explode(',', $this->js_code) as $v) {
                $results[] = 'xzyra/tools/'.$v;
            }
        }
        return $results;
    }
    function js_code_bottom(){
        $results = null;
        if( $this->js_code_bottom === true ) {
            $results = 'scriptBottom';
        }
        return $results;
    }

}
