<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Dfp component
 */
class DfpComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function dpf_valuables($params) {
        $dfp_values = [];
        if ($params['controller'] === 'Homepages') {
            $dfp_values['section'] = 'homepage';
        }
        // Add Article information
        elseif($params['controller'] === 'Articles' && $params['action'] === 'view') {
            $this->Articles = TableRegistry::get('Articles');
            $query = $this->Articles->find('all', [
              'conditions' => ['Articles.url' => $params['url']]
            ]);
            $article = $query->first();
            if($article !== null){
                $dfp_values['section'] = $params['section'];
                $dfp_values['article_id'] = $article->id;
                $dfp_values['content_type'] = $article->format_type;
            }
        }
        // Add Section information
        elseif($params['controller'] === 'Sections' && $params['action'] === 'view') {
            $dfp_values['section'] = $params['url'];
        }
        // Add CMI information
        elseif($params['controller'] === 'CmiProducts' && $params['action'] === 'view' ) {
            $this->CmiProducts = TableRegistry::get('CmiProducts');
            $query = $this->CmiProducts->find('byUrl', ['url' => $params['id'], 'contain' => 'CmiLinkProductDocuments']);
            $cmiProduct = $query->first();
            $dfp_values['section'] = 'cmi';
            $dfp_values['article_id'] = $cmiProduct->id;
        }
        // Add Tool information
        elseif($params['controller'] === 'Tools' && $params['action'] === 'view' ) {
//            $this->CmiProducts = TableRegistry::get('CmiProducts');
//            $query = $this->CmiProducts->find('byUrl', ['url' => $params['id'], 'contain' => 'CmiLinkProductDocuments']);
//            $cmiProduct = $query->first();
            $dfp_values['section'] = 'tool';
//            $dfp_values['article_id'] = $cmiProduct->id;
        }
        return $dfp_values;
    }
}
