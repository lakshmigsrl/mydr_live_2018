<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Authors Controller
 *
 * @property \App\Model\Table\AuthorsTable $Authors
 */
class AuthorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $authors = $this->paginate($this->Authors);

        $this->set(compact('authors'));
        $this->set('_serialize', ['authors']);
    }

    /**
     * View method
     *
     * @param string|null $id Author id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $author = $this->Authors->get($id, [
            'contain' => ['Articles']
        ]);

        $this->set('author', $author);
        $this->set('_serialize', ['author']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $author = $this->Authors->newEntity();
        if ($this->request->is('post')) {
            $author = $this->Authors->patchEntity($author, $this->request->data);
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The author could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('author'));
        $this->set('_serialize', ['author']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Author id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $author = $this->Authors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $author = $this->Authors->patchEntity($author, $this->request->data);
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The author could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('author'));
        $this->set('_serialize', ['author']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Author id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $author = $this->Authors->get($id);
        if ($this->Authors->delete($author)) {
            $this->Flash->success(__('The author has been deleted.'));
        } else {
            $this->Flash->error(__('The author could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
