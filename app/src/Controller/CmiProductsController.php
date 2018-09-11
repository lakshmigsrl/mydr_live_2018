<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\NotFoundException;

/**
 * CmiProducts Controller
 *
 * @property \App\Model\Table\CmiProductsTable $CmiProducts
 */
class CmiProductsController extends AppController
{

  public function ajaxGetCmis()
  {
      $searchStr = $this->request->data['q'];
      $query = $this->CmiProducts->find('all', [
            'limit' => 20,
            'conditions' => ['CmiProducts.description LIKE' => '%'.$searchStr.'%'],
            'order' => ['CmiProducts.description'=>'ASC']
      ]);
      $latest_cmis = [];
      /* not yet performed. so perform above query by looping.*/
      $retHtml = "";
      foreach($query as $latest){
          array_push($latest_cmis, [
              'id' => $latest['id'],
              'url' => $latest['full_url'],
              'name' => $latest['description'],
          ]);
      }

      $this->set('dataRet', $latest_cmis);
      $this->set('_serialize', ['dataRet']);

      $this->render('/Element/ajax_view', 'ajax');
  }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $cmiProducts = $this->paginate($this->CmiProducts);

        $this->set(compact('cmiProducts'));
        $this->set('_serialize', ['cmiProducts']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function letterIndex($letter = null)
    {
        $cmiProducts = $this->CmiProducts->find('all', [
              'conditions' => ['description LIKE' => $letter.'%'],
              'order' => ['CmiProducts.description'=>'ASC']
        ]);

        $breadcrumb = (object)([
            'section' => (object)['label' => 'medicines', 'url' => 'medicines'],
            'label' => $letter,
        ]);
        $this->set('breadcrumb', $breadcrumb);

        $this->set('cmiProducts', $cmiProducts);
        $this->set('letter', $letter);

        /* Get latest/recommended articles */
        $this->loadModel('Articles');
        $this->set('recentarticles', $this->Articles->getLatestArticles());
    }

    /**
     * View method
     *
     * @param string|null $id Cmi Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $subid = null)
    {
        /* Get issue date */
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT * FROM cmi_issues')->fetchAll('assoc');
        $this->set('cmi_issue', $results[0]);

        $cmis = TableRegistry::get('CmiProducts');
        $cmiUrlSearch = $cmis->find('byUrl', ['url' => $id, 'contain' => 'CmiLinkProductDocuments']);
        $cmiProduct = $cmiUrlSearch->first();
        if (empty($cmiProduct)) {
            throw new NotFoundException(__("We're sorry, the cmi page you are searching for cannot be found...."));
        }
        if($subid == NULL){
          $document_name = $cmiProduct['cmi_link_product_documents'][0]['document_name'];
          $this->set('cmi_doc_count', count($cmiProduct['cmi_link_product_documents']));

          $pdf_small_path = "cmis/ReducedPDFs/CMR".$cmiProduct['cmi_link_product_documents'][0]['document_name'].".pdf";
          /* Get rid of 00xxx filenames so it looks like 0xxx. */
          $pdfdocname = $cmiProduct['cmi_link_product_documents'][0]['document_name'];
          $ch0 = substr($pdfdocname, 0, 1);
          $ch1 = substr($pdfdocname, 1, 1);
          $pdf_big_path = "cmis/PDFs/CMI" . ltrim($pdfdocname,'0') . ".pdf";
          if($ch0=="0" && $ch1=="0"){
              $pdf_big_path = "cmis/PDFs/CMI" . substr($pdfdocname,1) . ".pdf";
          }
          $this->set('pdf_big_path', $pdf_big_path);
          $this->set('pdf_small_path', $pdf_small_path);

        }else{
          $cmi_multi = $this->CmiProducts->CmiLinkProductDocuments->find('all', ['conditions' => ['url' => $subid]]);
          $cmi_multi = $cmi_multi->first();
          if (empty($cmi_multi)) {
            throw new NotFoundException(__("We're sorry, the medication you are searching for cannot be found...."));
          }
          $document_name = $cmi_multi['document_name'];
          $this->set('multi_doc', $cmi_multi);
          $this->set('cmi_doc_count', 1);
        }

        /* Get CMI related articles */
        $conn = ConnectionManager::get('default');
        $stmt = $conn->prepare(
            'SELECT products.product_id, products.url_name, products.full_url,
                  prodAtt.value_id as AttributeValue, theraLink.attribute_name, theraLink.article_id_list
                FROM cmi_products as products
                  LEFT JOIN cmi_product_attributes as prodAtt ON prodAtt.product_id = products.product_id
                  LEFT JOIN therapeutic_links as theraLink ON theraLink.attribute_value_id = prodAtt.value_id
                WHERE products.id = '.$cmiProduct['id'].' AND prodAtt.attribute_id=6'
        );
        $stmt->execute();
        $therapeutics = $stmt->fetchAll('assoc');
        if(count($therapeutics)>0){
            $all_linked_articles = "";
            foreach($therapeutics as $theralink){
                    $all_linked_articles .= $theralink['article_id_list'].",";
            }
            $all_linked_articles = substr($all_linked_articles, 0, strlen($all_linked_articles)-1);
            // $this->set('therapeutic_row', $all_linked_articles);

            $inArr = explode(',', $all_linked_articles);
            $this->loadModel('Articles');
            $cmiRelatedArticles = $this->Articles->find('all', [
                  'contain' => ['Sections'],
                  'limit' => 20,
                  'conditions' => ['Articles.id IN' => $inArr],
            ])->select(['id', 'title', 'url', 'Sections.url']);
            $this->set('cmi_related_articles', $cmiRelatedArticles);
        }

        /* get CMI document html //$filename = dirname(APP)."/files/OutXHTML/CM"."11285.htm"; */
        $filename = dirname(APP)."/files/OutXHTML/CM".$document_name.".htm";
        $handle = fopen($filename, "r");
        $filecontents = stream_get_contents($handle);
        fclose($handle);
        $filecontents = strstr($filecontents, '<h1>');
        $filecontents = str_replace("</body></html>", '', $filecontents);
        $filecontents = str_replace("\\", '/', $filecontents);
        $filecontents = str_replace("ImagePath/", '/img/cmis/ImagePath/', $filecontents);
        $filecontents = trim($filecontents);
        $this->set('product', ['cmi_html_document' => $filecontents]);

        /* Get latest/recommended articles */
        $this->loadModel('Articles');
        $this->set('recentarticles', $this->Articles->getLatestArticles());

        $this->set('cmiProduct', $cmiProduct);
        $this->set('_serialize', ['cmiProduct']);

        // Check survey modal cookies, cookies set by jscode.js
        //$this->set('survey_modal', isset($_COOKIE['mydr_cmi_' . $cmiProduct->id]));
    }

}
