<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SectionSlides Controller
 *
 * @property \App\Model\Table\SectionSlidesTable $SectionSlides
 */
class SectionSlidesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sections']
        ];
        $sectionSlides = $this->paginate($this->SectionSlides);

        $this->set(compact('sectionSlides'));
        $this->set('_serialize', ['sectionSlides']);
    }

    /**
     * View method
     *
     * @param string|null $id Section Slide id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sectionSlide = $this->SectionSlides->get($id, [
            'contain' => ['Sections']
        ]);

        $this->set('sectionSlide', $sectionSlide);
        $this->set('_serialize', ['sectionSlide']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sectionSlide = $this->SectionSlides->newEntity();
        if ($this->request->is('post')) {
            $sectionSlide = $this->SectionSlides->patchEntity($sectionSlide, $this->request->data);
            if ($this->SectionSlides->save($sectionSlide)) {
                $this->Flash->success(__('The section slide has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section slide could not be saved. Please, try again.'));
            }
        }
        $sections = $this->SectionSlides->Sections->find('list', ['limit' => 200]);
        $this->set(compact('sectionSlide', 'sections'));
        $this->set('_serialize', ['sectionSlide']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Section Slide id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sectionSlide = $this->SectionSlides->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sectionSlide = $this->SectionSlides->patchEntity($sectionSlide, $this->request->data);
            if ($this->SectionSlides->save($sectionSlide)) {
                $this->Flash->success(__('The section slide has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section slide could not be saved. Please, try again.'));
            }
        }
        $sections = $this->SectionSlides->Sections->find('list', ['limit' => 200]);
        $this->set(compact('sectionSlide', 'sections'));
        $this->set('_serialize', ['sectionSlide']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Section Slide id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sectionSlide = $this->SectionSlides->get($id);
        if ($this->SectionSlides->delete($sectionSlide)) {
            $this->Flash->success(__('The section slide has been deleted.'));
        } else {
            $this->Flash->error(__('The section slide could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
