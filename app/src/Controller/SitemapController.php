<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Sitemap Controller
 *
 */

class SitemapController extends AppController
{
    public function initialize()
    {
        $this->loadComponent('Sitemap.Sitemap');
    }

    /**
     * Create Sitemap index XML
     */
    public function index()
    {
        $this->Sitemap->createIndex();
        $articles = array(
          'articles','cmis','sections','authors','tools'
        );
        foreach ($articles as $v) {
                $this->Sitemap->addLocation(
                  [
                    'plugin' => NULL,
                    'controller' => 'sitemap',
                    'action' => $v
                  ]
                );
        }
        $this->render(NULL, 'index');
        $this->Sitemap->addLocation(['action' => 'products']);
    }

    /**
     * Create Sitemap index XML
     */
    public function articles()
    {
        $this->Sitemap->createIndex();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all',[
          'contain' => ['Sections'],
          'conditions' => [
            'Articles.status' =>1
          ],
          'order' => ['Articles.modified' => 'DESC'],
          'limit' => 9999
        ]);
        foreach ($articles as $v) {
            if(!empty($v->section->url)) {
                $this->Sitemap->addLocation(
                  [
                    'plugin' => NULL,
                    'controller' => $v->section->url,
                    'action' => $v->url
                  ], // url
                  0.5, // priority
                  $v->modified, // last modified date
                  'weekly', // change frequency
                  $v->title
                );
            }
        }
        $this->render(NULL, 'sitemap');
        $this->Sitemap->addLocation(['action' => 'products']);
    }

    /**
     * Create Sitemap CMI XML
     */
    public function cmis()
    {
        $this->Sitemap->createIndex();
        $this->loadModel('CmiProducts');
        $cmis = $this->CmiProducts->find('all',[
          'limit' => 9999
        ]);
        foreach ($cmis as $v) {
            $this->Sitemap->addLocation(
              [
                'plugin' => NULL,
                'controller' => 'medicines/cmis',
                'action' => $v->full_url
              ], // url
              0.5, // priority
              $v->modified, // last modified date
              'monthly', // change frequency
              $v->title
            );
        }
        $this->render(NULL, 'sitemap');
        $this->Sitemap->addLocation(['action' => 'products']);
    }

    /**
     * Create Sitemap Author XML
     */
    /*public function authors()
    {
        $this->Sitemap->createIndex();
        $this->loadModel('Authors');
        $Authors = $this->Authors->find('all',[
          'order' => ['Authors.modified' => 'DESC'],
          'limit' => 9999
        ]);
        foreach ($Authors as $v) {
            $this->Sitemap->addLocation(
              [
                'plugin' => NULL,
                'controller' => 'Authors',
                'action' => $v->url
              ], // url
              0.5, // priority
              $v->modified, // last modified date
              'monthly', // change frequency
              $v->title
            );
        }
        $this->render(NULL, 'sitemap');
        $this->Sitemap->addLocation(['action' => 'products']);
    }*/

    /**
     * Create Sitemap Section XML
     */
    public function sections()
    {
        $this->Sitemap->createIndex();
        $this->loadModel('Sections');
        $Sections = $this->Sections->find('all',[
          'conditions' => ['Sections.status' =>1],
          'order' => ['Sections.modified' => 'DESC'],
          'limit' => 9999
        ]);
        foreach ($Sections as $v) {
            $this->Sitemap->addLocation(
              [
                'plugin' => NULL,
                'controller' => NULL,
                'action' => $v->url
              ], // url
              0.5, // priority
              $v->modified, // last modified date
              'monthly', // change frequency
              $v->title
            );
        }
        $this->render(NULL, 'sitemap');
        $this->Sitemap->addLocation(['action' => 'products']);
    }

    /**
     * Create Sitemap Tool XML
     */
    public function tools()
    {
        $this->Sitemap->createIndex();
        $this->loadModel('Tools');
        $tools = $this->Tools->find('all',[
          'conditions' => ['Tools.status' =>1],
          'order' => ['Tools.modified' => 'DESC'],
          'limit' => 9999
        ]);
        foreach ($tools as $v) {
            $this->Sitemap->addLocation(
              [
                'plugin' => NULL,
                'controller' => 'tools',
                'action' => $v->url
              ], // url
              0.5, // priority
              $v->modified, // last modified date
              'monthly', // change frequency
              $v->title
            );
        }
        $this->render(NULL, 'sitemap');
        $this->Sitemap->addLocation(['action' => 'products']);
    }

    /**
     * Create Sitemap XML from model
     */
    /*public function pages()
    {
        $this->Sitemap->create();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all',[
          'contain' => ['Sections'],
          'conditions' => [
            'Articles.status' =>1, 'Articles.format_type' => 'news',
            'OR' => [
              ['Articles.modified >=' => date("Y-m-d", strtotime("-2 days"))],
              ['Articles.start_date >=' => date("Y-m-d", strtotime("-2 days"))],
            ]
          ]
        ]);
        foreach ($articles as $v) {
            $this->Sitemap->addLocation(
              ['plugin' => null, 'controller' => $v->section->url, 'action' => $v->url], // url
              0.5, // priority
              $v->modified, // last modified date
              'monthly', // change frequency
              $v->title
            );
        }
        $this->render(NULL, 'googlesitemap');
    }*/
}
