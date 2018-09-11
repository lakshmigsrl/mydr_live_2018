<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\ValidationRule;
use Cake\Datasource\ConnectionManager;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{
    public function initialize()
    {
      parent::initialize();
      $this->loadComponent('Search.Prg', [
        'actions' => ['index']
      ]);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      $query = $this->Sections
        ->find('search', $this->Sections->filterParams($this->request->query))
        ->contain([])
        ->where(['name IS NOT' => null]);

      // Set default order
      if(!isset($this->request->data['sort']))
      {
        $query->order(['Sections.modified' => 'DESC']);
      }
      $this->paginate = ['admin' => true];
      $sections = $this->paginate($query);

      $this->set(compact('sections'));
      $this->set('_serialize', ['sections']);
    }

    /**
     * View method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($url = null)
    {
        $query = $this->Sections->find('all', [
            'conditions' => ['Sections.url' => $url],
            'contain' => [
              'TopArticles'  => function ($q) {
                  return $q->contain(['Sections'])->limit(7);
              }
            ]
        ]);
        $section = $query->first();

        $this->set(compact('section'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      $section = $this->Sections->newEntity();
      if ($this->request->is(['patch', 'post', 'put'])) {
        $section = $this->Sections->patchEntity($section, $this->request->data);
      }

      $tools = $this->Sections->Tools->find('list', ['limit' => 200]);
      /* To ajaxify later */
      $top_articles = $this->Sections->TopArticles->find('list', ['limit' => 200, 'order'=> ['TopArticles.created' => 'DESC'], 'admin' => true,]);
      /* To ajaxify later */
      $top_medicines = $this->Sections->TopMedicines->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'description']);

      if ($this->request->is('post')) {
          $section = $this->Sections->patchEntity($section, $this->request->data);
          if ($this->Sections->save($section)) {
              $this->Flash->success(__('The section has been saved.'));
              return $this->redirect(['action' => 'index']);
          } else {
              $this->Flash->error(__('The section could not be saved. Please, try again.'));
          }
      }
      $this->set(compact('section', 'top_articles', 'top_medicines', 'tools'));
      $this->set('_serialize', ['section']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => ['SectionSlides', 'TopArticles', 'TopMedicines', 'Tools'],
            'admin' => true
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->data);

            /* RELATED_ARTICLES: Delete all related article first then add them back in. */
            if(isset($section->dummy_related_articles)){
              $connection = ConnectionManager::get('default');
              $connection->delete('articles_sections', ['section_id' => $section->id]);
              $all_related_articles = [];
              foreach ($section->dummy_related_articles as $key => $value) {
                  $related = $this->Sections->Articles->get($key);
                  array_push($all_related_articles, $related);
              }
              $section->top_articles = $all_related_articles;
            }

            /* RELATED_CMIS: Delete all related cmi first then add them back in. */
            if(isset($section->dummy_related_cmis)){
              $this->loadModel('CmiProducts');
              $connection = ConnectionManager::get('default');
              $connection->delete('cmi_products_sections', ['section_id' => $section->id]);
              $all_related_cmis = [];
              foreach ($section->dummy_related_cmis as $key => $value) {
                  $related = $this->CmiProducts->get($key);
                  array_push($all_related_cmis, $related);
              }
              $section->top_medicines = $all_related_cmis;
            }

            /* Save */
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));
                /* Section_Slide Remove rows labelled as delete-me. */
                $this->Sections->SectionSlides->deleteAll(['title' => 'delete-me']);
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
            }
        }

        $tools = $this->Sections->Tools->find('list', ['limit' => 200]);
        $top_articles = $this->Sections->TopArticles->find('list', ['limit' => 200, 'order'=> ['TopArticles.created' => 'DESC'], 'admin' => true,]);
        $top_medicines = $this->Sections->TopMedicines->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'description']);
        $this->set(compact('section', 'top_articles', 'top_medicines', 'tools'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $section = $this->Sections->get($id);
        if ($this->Sections->delete($section)) {
            $this->Flash->success(__('The section has been deleted.'));
        } else {
            $this->Flash->error(__('The section could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
