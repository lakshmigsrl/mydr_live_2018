<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * Url behavior
 */
class UrlBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function generateUrl($title, $delimiter='-')
    {
        // Replace sybbol to -
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '-', html_entity_decode($title));
        $clean = strtolower(trim($clean, '-'));
        // -- to -
        $url = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $url;
    }
}
