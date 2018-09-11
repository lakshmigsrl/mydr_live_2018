<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Footers Controller
 *
 * @property \App\Model\Table\FootersTable $Footers
 */
class FootersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $footers = $this->paginate($this->Footers);

        $this->set(compact('footers'));
        $this->set('_serialize', ['footers']);
    }

    /**
     * View method
     *
     * @param string|null $id Footer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $footer = $this->Footers->get($id, [
            'contain' => ['Articles']
        ]);

        $this->set('footer', $footer);
        $this->set('_serialize', ['footer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $footer = $this->Footers->newEntity();
        if ($this->request->is('post')) {
            $footer = $this->Footers->patchEntity($footer, $this->request->data);
            if ($this->Footers->save($footer)) {
                $this->Flash->success(__('The footer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The footer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('footer'));
        $this->set('_serialize', ['footer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Footer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $footer = $this->Footers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $footer = $this->Footers->patchEntity($footer, $this->request->data);
            if ($this->Footers->save($footer)) {
                $this->Flash->success(__('The footer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The footer could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('footer'));
        $this->set('_serialize', ['footer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Footer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $footer = $this->Footers->get($id);
        if ($this->Footers->delete($footer)) {
            $this->Flash->success(__('The footer has been deleted.'));
        } else {
            $this->Flash->error(__('The footer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
