<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{

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
              'SectionSlides',
              'TopMedicines',
              'Tools',
              'TopArticles.Sections',
              'Articles' => [
                      'strategy' => 'select',
                      'queryBuilder' => function ($q) {
                          return $q->where(['Articles.format_type' => 'news'])->order(['Articles.created' =>'DESC'])->limit(20);
                      }],
            ],
        ]);
        $section = $query->first();
        if (empty($section)) {
            throw new NotFoundException(__("We're sorry, the page you are searching for can't be found.."));
        }

        $this->set(compact('section'));
        $this->set('_serialize', ['section']);

        if($section->url=='pharmacy-care'){

          $this->loadModel('Articles');
          $query = $this->Articles->find('all', [
            'contain' => ['Sections'],
            'conditions' => ['Articles.medical_type' => 'pharmacy_self_care', 'Articles.format_type !=' => 'news'],
            'order' => ['title' => 'ASC'],
            'limit' => 75
          ])->toArray();
          $this->set('common_conditions', $query);
          $this->render('view_pharmacy_care');
        }else if($section->url=='medicines'){

          $this->render('view_medicines');
        }else if($section->url=='symptoms'){

          $this->loadModel('Articles');
          $query = $this->Articles->find('all', [
            'contain' => ['Sections'],
            'conditions' => ['Articles.medical_type' => 'symptoms', 'Articles.format_type !=' => 'news'],
            'order' => ['title' => 'ASC'],
            'limit' => 75
          ])->toArray();
          $this->set('symptoms_list', $query);
          $this->render('view_symptoms');
        }
    }

}
