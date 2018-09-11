<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Homepages Controller
 *
 * @property \App\Model\Table\HomepagesTable $Homepages
 */
class HomepagesController extends AppController
{
  public function home()
  {
      $promotions = $this->Homepages->find('all', [
          'contain' => ['Articles.Sections'],
          'order' => ['Homepages.start' => 'DESC']
      ]);
      $this->set('promotions', $promotions);

      /* Get Latest News Articles */
      $this->loadModel('Articles');
      $articles = $this->Articles->find('all', [
          'contain' => ['Sections'],
          'conditions' => ['format_type' => 'news'],
          'order' => ['Articles.reviewed' => 'DESC', 'Articles.created' => 'DESC'],
          'limit' => 6,
      ])->toArray();
      $this->set('latest_news', $articles);

      /* Get Latest Articles */
      $this->loadModel('Articles');
      $articles = $this->Articles->find('all', [
          'contain' => ['Sections'],
          'conditions' => ['format_type !=' => 'news'],
          'order' => ['Articles.reviewed' => 'DESC', 'Articles.created' => 'DESC'],
          'limit' => 20,
      ])->toArray();
      $this->set('all_articles', $articles);

      /* Get Latest News */
      $news = $this->Articles->find('all', [
          'contain' => ['Sections'],
          'conditions' => ['format_type' => 'news'],
          'order' => ['Articles.reviewed' => 'DESC', 'Articles.created' => 'DESC'],
          'limit' => 20,
      ])->toArray();
      $this->set('latest_news', $news);

      /* Get Latest Articles */
      $this->loadModel('Articles');
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
      $this->set('recentarticles', $latest_articles);
  }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles']
        ];
        $homepages = $this->paginate($this->Homepages);

        $this->set(compact('homepages', 'articles'));
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
            'contain' => []
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
