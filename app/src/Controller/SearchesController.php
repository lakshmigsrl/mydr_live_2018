<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;
/**
 * Static content controller
 *
 * This controller will render views from Template/Searches/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/Searches-controller.html
 */
class SearchesController extends AppController
{

  public function index()
  {
    $this->set('searchText', $this->request->query['q']);

    $breadcrumb = (object)(['section' => null, 'label' => 'Search']);
    $this->set('breadcrumb', $breadcrumb);

    /* Get latest/recommended articles */
    $this->loadModel('Articles');
    $this->set('latest_articles', $this->Articles->getLatestArticles());
  }

  public function gp()
  {
    /* Get latest/recommended articles */
    $this->loadModel('Articles');
    $this->set('latest_articles', $this->Articles->getLatestArticles());

    $breadcrumb = (object)(['section' => null, 'label' => 'GP search']);
    $this->set('breadcrumb', $breadcrumb);
  }

  public function medicalDictionary()
  {
    /* Get latest/recommended articles */
    $this->loadModel('Articles');
    $this->set('latest_articles', $this->Articles->getLatestArticles());

    $breadcrumb = (object)(['section' => null, 'label' => 'Online Dictionary']);
    $this->set('breadcrumb', $breadcrumb);
  }

  public function cmi()
  {
    if (isset($_POST['search_term'])) {
        $conn = ConnectionManager::get('default');
        $search_post_term = str_replace(['%', '"'], [''], $_POST['search_term']);
        $this->set('search_term', $search_post_term);
        $this->set('search_type', $_POST['search_type']);

        if($_POST['search_type']=='name'){
            $stmt = $conn->prepare(
                'SELECT * FROM  cmi_products WHERE name_attribute LIKE "%'.$search_post_term.'%" '.
                'OR description LIKE "%'.$search_post_term.'%" ORDER BY description LIMIT 0, 45'
            );
        }else{
            $stmt = $conn->prepare(
                'SELECT * FROM  cmi_products WHERE condition_attribute LIKE "%'.$search_post_term.'%" ORDER BY description LIMIT 0, 45'
            );
        }

        $stmt->execute();
        //$row = $stmt->fetch('assoc');
        $rows = $stmt->fetchAll('assoc');
        $this->set('search_result', $rows);


    }

    /* Get latest/recommended articles */
    $this->loadModel('Articles');
    $this->set('latest_articles', $this->Articles->getLatestArticles());

    $breadcrumb = (object)(['section' => null, 'label' => 'cmi search']);
    $this->set('breadcrumb', $breadcrumb);

  }
}
