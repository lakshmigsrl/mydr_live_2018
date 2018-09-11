<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CmiAttributes Controller
 *
 * @property \App\Model\Table\CmiAttributesTable $CmiAttributes
 */
class CmiAttributesController extends AppController
{

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
        $cmiAttributes = $this->paginate($this->CmiAttributes);

        $this->set(compact('cmiAttributes'));
        $this->set('_serialize', ['cmiAttributes']);
    }

    /**
     * View method
     *
     * @param string|null $id Cmi Attribute id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmiAttribute = $this->CmiAttributes->get($id, [
            'contain' => []
        ]);

        $this->set('cmiAttribute', $cmiAttribute);
        $this->set('_serialize', ['cmiAttribute']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmiAttribute = $this->CmiAttributes->newEntity();
        if ($this->request->is('post')) {
            $cmiAttribute = $this->CmiAttributes->patchEntity($cmiAttribute, $this->request->data);
            if ($this->CmiAttributes->save($cmiAttribute)) {
                $this->Flash->success(__('The cmi attribute has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi attribute could not be saved. Please, try again.'));
            }
        }
        $countries = $this->CmiAttributes->Countries->find('list', ['limit' => 200]);
        $attributes = $this->CmiAttributes->Attributes->find('list', ['limit' => 200]);
        $selectionTypes = $this->CmiAttributes->SelectionTypes->find('list', ['limit' => 200]);
        $this->set(compact('cmiAttribute', 'countries', 'attributes', 'selectionTypes'));
        $this->set('_serialize', ['cmiAttribute']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cmi Attribute id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmiAttribute = $this->CmiAttributes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmiAttribute = $this->CmiAttributes->patchEntity($cmiAttribute, $this->request->data);
            if ($this->CmiAttributes->save($cmiAttribute)) {
                $this->Flash->success(__('The cmi attribute has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi attribute could not be saved. Please, try again.'));
            }
        }
        //$countries = $this->CmiAttributes->Countries->find('list', ['limit' => 200]);
        //$attributes = $this->CmiAttributes->Attributes->find('list', ['limit' => 200]);
        //$selectionTypes = $this->CmiAttributes->SelectionTypes->find('list', ['limit' => 200]);
        //$this->set(compact('cmiAttribute', 'countries', 'attributes', 'selectionTypes'));
        $this->set(compact('cmiAttribute'));
        $this->set('_serialize', ['cmiAttribute']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cmi Attribute id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmiAttribute = $this->CmiAttributes->get($id);
        if ($this->CmiAttributes->delete($cmiAttribute)) {
            $this->Flash->success(__('The cmi attribute has been deleted.'));
        } else {
            $this->Flash->error(__('The cmi attribute could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
