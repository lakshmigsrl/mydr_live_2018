<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CmiProductSurveys Controller
 *
 * @property \App\Model\Table\CmiProductSurveysTable $CmiProductSurveys
 */
class CmiProductSurveysController extends AppController
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
        $query = $this->CmiProductSurveys
          ->find('search', $this->CmiProductSurveys->filterParams($this->request->query))
          ->contain(['CmiProducts']);
        $cmiProductSurveys = $this->paginate($query);

        $this->set(compact('cmiProductSurveys'));
        $this->set('_serialize', ['cmiProductSurveys']);
    }

    /**
     * View method
     *
     * @param string|null $id Cmi Product Survey id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmiProductSurvey = $this->CmiProductSurveys->get($id, [
            'contain' => ['CmiProducts']
        ]);

        $this->set('cmiProductSurvey', $cmiProductSurvey);
        $this->set('_serialize', ['cmiProductSurvey']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmiProductSurvey = $this->CmiProductSurveys->newEntity();
        if ($this->request->is('post')) {
            $cmiProductSurvey = $this->CmiProductSurveys->patchEntity($cmiProductSurvey, $this->request->data);
            if ($this->CmiProductSurveys->save($cmiProductSurvey)) {
                $this->Flash->success(__('The cmi product survey has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi product survey could not be saved. Please, try again.'));
            }
        }
        $cmiProducts = $this->CmiProductSurveys->CmiProducts->find('list', ['limit' => 200]);
        $this->set(compact('cmiProductSurvey', 'cmiProducts'));
        $this->set('_serialize', ['cmiProductSurvey']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cmi Product Survey id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmiProductSurvey = $this->CmiProductSurveys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmiProductSurvey = $this->CmiProductSurveys->patchEntity($cmiProductSurvey, $this->request->data);
            if ($this->CmiProductSurveys->save($cmiProductSurvey)) {
                $this->Flash->success(__('The cmi product survey has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi product survey could not be saved. Please, try again.'));
            }
        }
        $cmiProducts = $this->CmiProductSurveys->CmiProducts->find('list', ['limit' => 200]);
        $this->set(compact('cmiProductSurvey', 'cmiProducts'));
        $this->set('_serialize', ['cmiProductSurvey']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cmi Product Survey id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmiProductSurvey = $this->CmiProductSurveys->get($id);
        if ($this->CmiProductSurveys->delete($cmiProductSurvey)) {
            $this->Flash->success(__('The cmi product survey has been deleted.'));
        } else {
            $this->Flash->error(__('The cmi product survey could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
