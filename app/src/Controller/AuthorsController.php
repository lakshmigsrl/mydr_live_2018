<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Authors Controller
 *
 * @property \App\Model\Table\AuthorsTable $Authors
 */
class AuthorsController extends AppController
{
    public function initialize()
    {

        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //$authors = $this->paginate($this->Authors);
        $authors = $this->Authors->find('all');
        $authors->select([
                          'Authors.id', 'Authors.name', 'Authors.first_name', 'Authors.last_name', 'Authors.main_image', 'Authors.url',
                          'Authors.facebook_link',
                          'Authors.linkedin_link',
                          'Authors.twitter_link',
                          'Authors.created',
                          'total_articles' => $authors->func()->count('Articles.id')
                          ])
                ->leftJoinWith('Articles', function($q){
                      return $q->where(['Articles.status' => 1]);
                    })
                //->where(['Authors.id >' => 4 ])
                ->group(['Authors.id']);
        $authors = $this->paginate($authors);

        $this->set(compact('authors'));
        $this->set('_serialize', ['authors']);

        $this->loadModel('Articles');
        $this->set('latest_articles', $this->Articles->getLatestArticles());
        $breadcrumb = (object)(['section' => null,'label' => 'Authors']);
        $this->set('breadcrumb', $breadcrumb);
    }

    /**
     * View method
     *
     * @param string|null $id Author id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($url = null)
    {
        $query = $this->Authors->find('all', [
          'conditions' => ['Authors.url' => $url]
        ]);
        $author = $query->first();


        $this->loadModel('Articles');
        $this->paginate = [
          'conditions' => ['author_id' => $author->id],
          'contain' => ['Sections', 'Sources', 'Authors', 'Footers'],
          'order' => ['Articles.start_date' => 'DESC', 'Articles.reviewed' => 'DESC'],
        ];

        $articles = $this->paginate($this->Articles);
        $articles_inArr = $articles->toArray();
        if(empty($articles_inArr)){
            throw new NotFoundException(__("We're sorry, the author page you are searching for can't be found."));
        }
        $this->set('articles', $articles);

        $this->set('author', $author);
        $this->set('_serialize', ['author']);
    }

}
