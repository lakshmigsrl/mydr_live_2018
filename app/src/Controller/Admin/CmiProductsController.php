<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CmiProducts Controller
 *
 * @property \App\Model\Table\CmiProductsTable $CmiProducts
 */
class CmiProductsController extends AppController
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
        $query = $this->CmiProducts
          ->find('search', $this->CmiProducts->filterParams($this->request->query))
          ->contain([])
          ->where(['description IS NOT' => null]);

        $this->paginate = ['admin' => true];
        $cmiProducts = $this->paginate($query);
        $this->set(compact('cmiProducts'));
        $this->set('_serialize', ['cmiProducts']);
    }

    /**
     * View method
     *
     * @param string|null $id Cmi Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmiProduct = $this->CmiProducts->get($id, [
            'contain' => ['CmiLinkProductDocuments']
        ]);

        $this->set('cmiProduct', $cmiProduct);
        $this->set('_serialize', ['cmiProduct']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmiProduct = $this->CmiProducts->newEntity();
        if ($this->request->is('post')) {
            $cmiProduct = $this->CmiProducts->patchEntity($cmiProduct, $this->request->data);
            if ($this->CmiProducts->save($cmiProduct)) {
                $this->Flash->success(__('The cmi product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi product could not be saved. Please, try again.'));
            }
        }
        //$countries = $this->CmiProducts->Countries->find('list', ['limit' => 200]);
        //$productTypes = $this->CmiProducts->ProductTypes->find('list', ['limit' => 200]);
        //$products = $this->CmiProducts->Products->find('list', ['limit' => 200]);
        //$this->set(compact('cmiProduct', 'countries', 'productTypes', 'products'));
        $this->set(compact('cmiProduct'));
        $this->set('_serialize', ['cmiProduct']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cmi Product id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmiProduct = $this->CmiProducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmiProduct = $this->CmiProducts->patchEntity($cmiProduct, $this->request->data);
            if ($this->CmiProducts->save($cmiProduct)) {
                $this->Flash->success(__('The cmi product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi product could not be saved. Please, try again.'));
            }
        }
        //$countries = $this->CmiProducts->Countries->find('list', ['limit' => 200]);
        //$productTypes = $this->CmiProducts->ProductTypes->find('list', ['limit' => 200]);
        //$products = $this->CmiProducts->Products->find('list', ['limit' => 200]);
        //$this->set(compact('cmiProduct', 'countries', 'productTypes', 'products'));
        $this->set(compact('cmiProduct'));
        $this->set('_serialize', ['cmiProduct']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cmi Product id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmiProduct = $this->CmiProducts->get($id);
        if ($this->CmiProducts->delete($cmiProduct)) {
            $this->Flash->success(__('The cmi product has been deleted.'));
        } else {
            $this->Flash->error(__('The cmi product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
