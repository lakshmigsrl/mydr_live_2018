<?php
//namespace App\Controller;
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CmiIssues Controller
 *
 * @property \App\Model\Table\CmiIssuesTable $CmiIssues
 */
class CmiIssuesController extends AppController
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
        $cmiIssues = $this->paginate($this->CmiIssues);

        $this->set(compact('cmiIssues'));
        $this->set('_serialize', ['cmiIssues']);
    }

    /**
     * View method
     *
     * @param string|null $id Cmi Issue id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmiIssue = $this->CmiIssues->get($id, [
            'contain' => []
        ]);

        $this->set('cmiIssue', $cmiIssue);
        $this->set('_serialize', ['cmiIssue']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmiIssue = $this->CmiIssues->newEntity();
        if ($this->request->is('post')) {
            $cmiIssue = $this->CmiIssues->patchEntity($cmiIssue, $this->request->data);
            if ($this->CmiIssues->save($cmiIssue)) {
                $this->Flash->success(__('The cmi issue has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi issue could not be saved. Please, try again.'));
            }
        }
        $issues = $this->CmiIssues->Issues->find('list', ['limit' => 200]);
        $this->set(compact('cmiIssue', 'issues'));
        $this->set('_serialize', ['cmiIssue']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cmi Issue id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmiIssue = $this->CmiIssues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmiIssue = $this->CmiIssues->patchEntity($cmiIssue, $this->request->data);
            if ($this->CmiIssues->save($cmiIssue)) {
                $this->Flash->success(__('The cmi issue has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi issue could not be saved. Please, try again.'));
            }
        }
        //$issues = $this->CmiIssues->Issues->find('list', ['limit' => 200]);
        $this->set(compact('cmiIssue'));
        $this->set('_serialize', ['cmiIssue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cmi Issue id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmiIssue = $this->CmiIssues->get($id);
        if ($this->CmiIssues->delete($cmiIssue)) {
            $this->Flash->success(__('The cmi issue has been deleted.'));
        } else {
            $this->Flash->error(__('The cmi issue could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
