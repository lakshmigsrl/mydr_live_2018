<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Tools Controller
 *
 * @property \App\Model\Table\ToolsTable $Tools
 */
class ToolsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Authors', 'Publishers']
        ];
        $tools = $this->paginate($this->Tools);

        $this->set(compact('tools'));
        $this->set('_serialize', ['tools']);
    }

    /**
     * View method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($url = null)
    {
        $query = $this->Tools->find('all', [
          'conditions' => ['Tools.url' => $url],
          'contain' => ['Authors']
        ]);
        $tool = $query->first();
        if (empty($tool)) {
            throw new NotFoundException(__("We're sorry, the page you are searching for can't be found..."));
        }
        $this->set('_serialize', ['tool']);

        /* Get latest/recommended articles */
        $this->loadModel('Articles');
        $latest_articles =  $this->Articles->getLatestArticles();
        $async = false;
        $this->set(compact('tool', 'async', 'latest_articles'));

//        $topFive = ['baby-due-date-calculator', 'bmi-calculator', 'calories-burned-calculator', 'ovulation-calculator', ''];
        $topFive = ['bmi-calculator', 'calories-burned-calculator', 'ovulation-calculator', ''];
        if(!in_array($tool->url, $topFive)){
          $this->render('view_basic');
        }
    }

}
