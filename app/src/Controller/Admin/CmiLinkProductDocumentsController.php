<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CmiLinkProductDocuments Controller
 *
 * @property \App\Model\Table\CmiLinkProductDocumentsTable $CmiLinkProductDocuments
 */
class CmiLinkProductDocumentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CmiProducts']
        ];
        $cmiLinkProductDocuments = $this->paginate($this->CmiLinkProductDocuments);

        $this->set(compact('cmiLinkProductDocuments'));
        $this->set('_serialize', ['cmiLinkProductDocuments']);
    }

    /**
     * View method
     *
     * @param string|null $id Cmi Link Product Document id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmiLinkProductDocument = $this->CmiLinkProductDocuments->get($id, [
            'contain' => ['CmiProducts']
        ]);

        $this->set('cmiLinkProductDocument', $cmiLinkProductDocument);
        $this->set('_serialize', ['cmiLinkProductDocument']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmiLinkProductDocument = $this->CmiLinkProductDocuments->newEntity();
        if ($this->request->is('post')) {
            $cmiLinkProductDocument = $this->CmiLinkProductDocuments->patchEntity($cmiLinkProductDocument, $this->request->data);
            if ($this->CmiLinkProductDocuments->save($cmiLinkProductDocument)) {
                $this->Flash->success(__('The cmi link product document has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi link product document could not be saved. Please, try again.'));
            }
        }
        $countries = $this->CmiLinkProductDocuments->Countries->find('list', ['limit' => 200]);
        $productTypes = $this->CmiLinkProductDocuments->ProductTypes->find('list', ['limit' => 200]);
        $actualProducts = $this->CmiLinkProductDocuments->ActualProducts->find('list', ['limit' => 200]);
        $docTypes = $this->CmiLinkProductDocuments->DocTypes->find('list', ['limit' => 200]);
        $this->set(compact('cmiLinkProductDocument', 'countries', 'productTypes', 'actualProducts', 'docTypes'));
        $this->set('_serialize', ['cmiLinkProductDocument']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cmi Link Product Document id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmiLinkProductDocument = $this->CmiLinkProductDocuments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmiLinkProductDocument = $this->CmiLinkProductDocuments->patchEntity($cmiLinkProductDocument, $this->request->data);
            if ($this->CmiLinkProductDocuments->save($cmiLinkProductDocument)) {
                $this->Flash->success(__('The cmi link product document has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cmi link product document could not be saved. Please, try again.'));
            }
        }
        //$countries = $this->CmiLinkProductDocuments->Countries->find('list', ['limit' => 200]);
        //$productTypes = $this->CmiLinkProductDocuments->ProductTypes->find('list', ['limit' => 200]);
        //$actualProducts = $this->CmiLinkProductDocuments->ActualProducts->find('list', ['limit' => 200]);
        //$docTypes = $this->CmiLinkProductDocuments->DocTypes->find('list', ['limit' => 200]);
        //$this->set(compact('cmiLinkProductDocument', 'countries', 'productTypes', 'actualProducts', 'docTypes'));
        $this->set(compact('cmiLinkProductDocument'));
        $this->set('_serialize', ['cmiLinkProductDocument']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cmi Link Product Document id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmiLinkProductDocument = $this->CmiLinkProductDocuments->get($id);
        if ($this->CmiLinkProductDocuments->delete($cmiLinkProductDocument)) {
            $this->Flash->success(__('The cmi link product document has been deleted.'));
        } else {
            $this->Flash->error(__('The cmi link product document could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
