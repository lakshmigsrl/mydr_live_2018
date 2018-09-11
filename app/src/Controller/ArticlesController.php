<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{

    public function ajaxGetArticles()
    {
        $searchStr = $this->request->data['q'];
        $query = $this->Articles->find('all', [
              'limit' => 20,
              'conditions' => ['Articles.title LIKE' => '%'.$searchStr.'%'],
              'order' => ['Articles.reviewed'=>'DESC']
        ]);
        $query->contain(['Sections']);
        $latest_articles = [];
        /* not yet performed. so perform above query by looping.*/
        $retHtml = "";
        foreach($query as $latest){
            array_push($latest_articles, [
                'id' => $latest['id'],
                'url' => $latest['url'],
                'name' => "ID:".$latest['id'] . "-".$latest['title'],
                'section_url' => $latest['section']['url'],
                'main_image' => $latest['main_image'],
            ]);
        }

        $this->set('dataRet', $latest_articles);
        $this->set('_serialize', ['dataRet']);
        //echo json_encode($dataRet); // Do this at the view file.

        //$this->viewBuilder()->layout("ajax");
        $this->render('/Element/ajax_view', 'ajax');
    }

    /**
     * News method
     *
     * @return \Cake\Network\Response|null
     */
    public function news()
    {
        $this->paginate = [
            'conditions' => ['format_type' => 'news'],
            'contain' => ['Sections', 'Sources', 'Authors', 'Footers'],
            'order' => ['Articles.start_date' => 'DESC', 'Articles.reviewed' => 'DESC'],
        ];
        $articles = $this->paginate($this->Articles);

        /* Get latest/recommended articles */
        $this->set('latest_articles', $this->Articles->getLatestArticles());

        $breadcrumb = (object)([
            //'section' => (object)['label' => $article->section->name, 'url' => $article->section->url],
            'section' => null,
            'label' => 'News'
        ]);
        $this->set('breadcrumb', $breadcrumb);

        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);
    }

    public function homepage()
    {
        $id = 3;
        $this->loadModel('Sections');
        $section = $this->Sections->get($id, [
          'contain' => [
            'Articles'  => function ($q) {
                return $q->contain(['Sections'])->limit(7);
            },
          ]
        ]);

        $this->set(compact('section'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($section_url = null, $url = null)
    {
        $query = $this->Articles->find('all', [
            'contain' => ['Sections', 'Sources', 'Authors', 'Footers', 'RelatedArticles.Sections'],
            //'conditions' => ['Articles.url' => $url, 'Sections.url' => $section_url],
            'conditions' => ['Articles.url' => $url],
            /* RelatedArticles.Section to get related articles'related Sections, see "Eager Loading Associations" .*/
        ]);
        $article = $query->first();
        if (empty($article)) {
            throw new NotFoundException(__("We're sorry, the page you are searching for can't be found."));
        }
        $prime_section_url = $article->section->url;
        if($prime_section_url != $section_url){
          $this->redirect("/".$prime_section_url."/".$url, 301);
        }

        $this->set('article', $article);
        $this->set('related_articles', $article->related_articles);
        $this->set('_serialize', ['article']);

        /* Get latest/recommended articles */
        $this->set('latest_articles', $this->Articles->getLatestArticles());
    }

    public function basicpage($url = null)
    {
        $query = $this->Articles->find('all', [
            'conditions' => ['Articles.url' => $this->request->url],
            /* RelatedArticles.Section to get related articles'related Sections, see "Eager Loading Associations" .*/
        ]);
        $article = $query->first();
        if (empty($article)) {
            throw new NotFoundException(__("We're sorry, the page you are searching for can't be found."));
        }
        $this->set('url', $this->request->url);
        $this->set('article', $article);
        $this->set('_serialize', ['article']);

        /* Get latest/recommended articles */
        $this->set('latest_articles', $this->Articles->getLatestArticles());
    }



}
