<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Homepages Controller
 *
 * @property \App\Model\Table\HomepagesTable $Homepages
 */
class HomepagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles'],
            'order' => ['start' => 'DESC'],
        ];
        $homepages = $this->paginate($this->Homepages);

        $this->set(compact('homepages'));
        $this->set('_serialize', ['homepages']);
    }

    /**
     * View method
     *
     * @param string|null $id Homepage id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $homepage = $this->Homepages->get($id, [
            'contain' => ['Articles']
        ]);

        $this->set('homepage', $homepage);
        $this->set('_serialize', ['homepage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homepage = $this->Homepages->newEntity();
        if ($this->request->is('post')) {
            $homepage = $this->Homepages->patchEntity($homepage, $this->request->data);
            if ($this->Homepages->save($homepage)) {
                $this->Flash->success(__('The homepage has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The homepage could not be saved. Please, try again.'));
            }
        }
        $articles = $this->Homepages->Articles->find('list', ['limit' => 200]);
        $this->set(compact('homepage', 'articles'));
        $this->set('_serialize', ['homepage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Homepage id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homepage = $this->Homepages->get($id, [
            'contain' => ['Articles.Sections']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homepage = $this->Homepages->patchEntity($homepage, $this->request->data);
            if ($this->Homepages->save($homepage)) {
                $this->Flash->success(__('The homepage has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The homepage could not be saved. Please, try again.'));
            }
        }
        $articles = $this->Homepages->Articles->find('list', ['limit' => 200]);
        $this->set(compact('homepage', 'articles'));
        $this->set('_serialize', ['homepage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Homepage id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homepage = $this->Homepages->get($id);
        if ($this->Homepages->delete($homepage)) {
            $this->Flash->success(__('The homepage has been deleted.'));
        } else {
            $this->Flash->error(__('The homepage could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
