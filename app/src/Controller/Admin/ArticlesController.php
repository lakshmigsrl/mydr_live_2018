<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\ValidationRule;
use Cake\I18n\Time;
// use Cake\Collection\Collection;
// use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    public function initialize()
    {
      parent::initialize();
      $this->loadComponent('Search.Prg', [
        'actions' => ['index']
      ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      $query = $this->Articles
        // Use the plugins 'search' custom finder and pass in the
        // processed query params
        ->find('search', $this->Articles->filterParams($this->request->query))
        ->contain(['Sections', 'Sources', 'Authors', 'Footers'])
        ->where(['title IS NOT' => null]);

      // Set default order
      if(!isset($this->request->data['sort']))
      {
        $query->order(['Articles.modified' => 'DESC']);
      }
      // For pass beforeFind
      $this->paginate = ['admin' => true];
      $articles = $this->paginate($query);
      $this->set('constant_options', $this->Articles->constant_options);


      $this->set('_serialize', ['articles']);
      $sections = $this->Articles->Sections->find('list');
      $authors = $this->Articles->Authors->find('list');
      $this->set(compact('sections', 'articles', 'authors'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($url = null)
    {
        $query = $this->Articles->find('all', [
          'conditions' => ['Articles.url' => $url],
            'contain' => ['Sections', 'Sources', 'Authors', 'Footers', 'RelatedArticles.Sections']
            /* RelatedArticles.Section to get related articles'related Sections, see "Eager Loading Associations" .*/
        ]);
        $article = $query->first();
        $this->set('article', $article);
        $this->set('related_articles', $article->related_articles);
        $this->set('_serialize', ['article']);


        $query = $this->Articles->find('all', ['limit'=>6, 'order'=>['Articles.reviewed'=>'DESC']]);
        $query->contain(['Sections']);
        $latest_articles = [];
        /* not yet performed. so perform above query by looping.*/
        foreach($query as $latest){
            array_push($latest_articles, [
                'section_url' => $latest['section']['url'],
                'article_title' => $latest['title'],
                'article_url' => $latest['url'],
            ]);
        }
        $this->set('latest_articles', $latest_articles);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);

            /* RELATED_ARTICLES: Delete all related article first then add them back in. */
            if(isset($article->dummy_related_articles)){
              $connection = ConnectionManager::get('default');
              $connection->delete('articles_articles', ['article_id' => $article->id]);
              $all_related_articles = [];
              foreach ($article->dummy_related_articles as $key => $value) {
                  $related = $this->Articles->get($key);
                  array_push($all_related_articles, $related);
              }
              //$relArt = $this->Articles->RelatedArticles->get(3320);
              // $this->Articles->RelatedArticles->link($article, [$relArt]);
              $article->related_articles = $all_related_articles;
            }

            /* ARTICLE_LOGS: Cannot be deleted.*/
            if(isset($article['articleLogToSave']['confirmed'])){
              $articlelog = $this->Articles->ArticleLogs->newEntity();
              $articlelog->log_type = $article['articleLogToSave']['log_type'];
              $articlelog->user_id = $article['articleLogToSave']['user_id'];
              $articlelog->date = $article['articleLogToSave']['date']['year'].'-'.
                                  $article['articleLogToSave']['date']['month'].'-'.
                                  $article['articleLogToSave']['date']['day'];
              $article->article_logs = [$articlelog];
            }

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set('constant_options', $this->Articles->constant_options);

        $this->loadModel('Users');
        $users = $this->Users->find('list', ['limit' => 200, 'valueField' => 'lname']);
        $sections = $this->Articles->Sections->find('list', ['limit' => 200]);
        $sources = $this->Articles->Sources->find('list', ['limit' => 200, 'valueField' => 'value', 'order' => 'value']);
        $authors = $this->Articles->Authors->find('list', ['limit' => 200, 'order' => 'name']);
        $footers = $this->Articles->Footers->find('list', ['limit' => 200]);
        $topics = $this->Articles->Topics->find('list', ['limit' => 200]);
        //$legacies = $this->Articles->Legacies->find('list', ['limit' => 200]);
        //$this->set(compact('article', 'sections', 'sources', 'authors', 'footers', 'legacies'));
        $this->set(compact('article', 'sections', 'sources', 'authors', 'footers', 'topics', 'users'));
        $this->set('_serialize', ['article']);
    }

    public function addToHomeSlide()
    {
      //$homepages = TableRegistry::get('Homepages');
      //$homepage = $this->Articles->Homepages->find('all')->where(['article_id' => 4])->first();
      //$homepage->title = 'nice-nico';
      //$homepages->save($homepage);

      $article_id = $this->request->data['article_id']; //* Get ajax-submitted data. */
      $homepage = $this->Articles->Homepages->find('all')->where(['article_id' => $article_id])->first();
      if($homepage == null){
        $homepage = $this->Articles->Homepages->newEntity();
        $homepage->article_id = $article_id;
        $homepage->title = $this->request->data['title'];
        $homepage->body = $this->request->data['body'];
        $homepage->start = Time::now();
        $this->Articles->Homepages->save($homepage);
        echo "<h2>Added to top of home slides! </h2>";  /* This line will display at the ajax targeted html element. */
      }else{
        $homepage->title = $this->request->data['title'];
        $homepage->body = $this->request->data['body'];
        $homepage->start = Time::now();
        $this->Articles->Homepages->save($homepage);
        echo "<h2>Updated to top of home slides! </h2>"; /* This line will display at the ajax targeted html element. */
      }

      $this->render('/Element/ajax_view', 'ajax');
    }

    public function typeAheadArticles()
    {
        //$query = $this->request->data['query'];
        // $retData = array(array("id"=>"1","value"=>"madman"),array("id"=>"2","value"=>"girlgo"));
        //header('Content-Type: application/json');
        //$retData = json_encode($retData);
        //echo $retData;

        $article_title = $this->request->data['article_title'];
        $query = $this->Articles->find('all', [
              'limit' => 20,
              'conditions' => ['Articles.title LIKE' => '%'.$article_title.'%'],
              'order' => ['Articles.reviewed'=>'DESC']
        ]);
        $query->contain(['Sections']);
        $latest_articles = [];
        /* not yet performed. so perform above query by looping.*/
        $retHtml = "";
        foreach($query as $latest){
            array_push($latest_articles, [
                'section_url' => $latest['section']['url'],
                'article_title' => $latest['title'],
                'article_url' => $latest['url'],
            ]);
            $retHtml .= "<option value='0'>".$latest['title']."<a href='#'> add</a></option>";
        }
        $retHtml = "<select size='10'>".$retHtml."</select>";
        echo $retHtml;

        // echo "<select multiple='multiple'>".
        //     "<option value='0'>lino</option>".
        //     "<option value='1'>xzyra</option>".
        //     "<option value='2'>nico</option>".
        //     "</select>";

        $this->render('/Element/ajax_view', 'ajax');
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['RelatedArticles.Sections', 'Topics', 'Homepages', 'ArticleLogs.Contributors', 'Sections'],
            'admin' => true,
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data);

            /* RELATED_ARTICLES: Delete all related article first then add them back in. */
            if(isset($article->dummy_related_articles)){
              $connection = ConnectionManager::get('default');
              $connection->delete('articles_articles', ['article_id' => $article->id]);
              $all_related_articles = [];
              foreach ($article->dummy_related_articles as $key => $value) {
                  $related = $this->Articles->get($key);
                  array_push($all_related_articles, $related);
              }
              //$relArt = $this->Articles->RelatedArticles->get(3320);
              // $this->Articles->RelatedArticles->link($article, [$relArt]);
              $article->related_articles = $all_related_articles;
            }

            /* ARTICLE_LOGS: Cannot be deleted.*/
            if(isset($article['articleLogToSave']['confirmed'])){
              $articlelog = $this->Articles->ArticleLogs->newEntity();
              $articlelog->log_type = $article['articleLogToSave']['log_type'];
              $articlelog->contributor_id = $article['articleLogToSave']['contributor_id'];
              $articlelog->date = $article['articleLogToSave']['date']['year'].'-'.
                                  $article['articleLogToSave']['date']['month'].'-'.
                                  $article['articleLogToSave']['date']['day'];
              $article->article_logs = [$articlelog];
            }
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }

        $this->loadModel('Users');
        $users = $this->Users->find('list', ['limit' => 200, 'valueField' => 'lname']);
        $this->loadModel('Contributors');
        $contributors = $this->Contributors->find('list', [
                                                            'limit' => 200,
                                                            'valueField' => function ($e) {
                                                                return $e->get('first_name')." ".$e->get('last_name');;
                                                              }
                                                            ]);

        $this->set('constant_options', $this->Articles->constant_options);
        $sections = $this->Articles->Sections->find('list', ['limit' => 200]);
        $sources = $this->Articles->Sources->find('list', ['limit' => 200, 'valueField' => 'value', 'order' => 'value']);
        $authors = $this->Articles->Authors->find('list', ['limit' => 200, 'order' => 'name']);
        $footers = $this->Articles->Footers->find('list', ['limit' => 200]);
        $topics = $this->Articles->Topics->find('list', ['limit' => 200]);
        //$articles = $this->Articles->find('list', ['limit' => 200]);
        $this->set(compact('article', 'sections', 'sources', 'authors', 'footers', 'articles', 'topics', 'article_logs', 'users', 'contributors'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
