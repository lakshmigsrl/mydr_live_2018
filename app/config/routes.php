<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {

    // Static pages
    $routes->connect( '/about', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/contact', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/disclaimer', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/privacy', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/advertising-policy', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/terms-and-conditions', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/site-map', ['controller' => 'Articles', 'action' => 'basicpage']);
    $routes->connect( '/articles/ajax_get_articles', ['controller' => 'Articles', 'action' => 'ajaxGetArticles']);
    $routes->connect( '/surveys/ajax_add_survey', ['controller' => 'CmiProductSurveys', 'action' => 'ajaxAddSurvey']);

    /* Search Medical Dictionary */
    $routes->connect('/medical-dictionary',
      ['controller' => 'Searches', 'action' => 'medicalDictionary']
    );

    $routes->connect(
      '/:section/:url',
      ['controller' => 'Articles', 'action' => 'view'],
      ['pass' => ['section', 'url']]
    );

    $routes->connect(
      '/news',
      ['controller' => 'Articles', 'action' => 'news']
    );

    $routes->connect(
      '/:url',
      ['controller' => 'Sections', 'action' => 'view'],
      ['pass' => ['url']]
    );

    /* Tools */
    $routes->connect(
      '/tools/:url/*',
      ['controller' => 'Tools', 'action' => 'view'],
      ['pass' => ['url']]
    );

    // $routes->connect(
    //   '/articles/:action/*',
    //   ['controller' => 'Articles']
    // );

    $routes->connect(
      '/authors/:url',
      ['controller' => 'Authors', 'action' => 'view'],
      ['pass' => ['url']]
    );
    $routes->connect(
      '/authors/*',
      ['controller' => 'Authors', 'action' => 'index']
    );

    /* CMI Surveys */
    $routes->connect(
      '/cmi/surveys',
      ['controller' => 'CmiProductSurveys', 'action' => 'index']
    );

    /* CMIs */
        $routes->connect(
          '/cmi_products/:action/*',
          ['controller' => 'CmiProducts']
        );

        $routes->connect(
          '/cmi_link_product_documents/:action/*',
          ['controller' => 'CmiLinkProductDocuments']
        );

        $routes->connect(
          '/cmi_attributes/:action/*',
          ['controller' => 'CmiAttributes']
        );

        $routes->connect(
          '/cmi_issues/:action/*',
          ['controller' => 'CmiIssues']
        );

        $routes->connect(
          '/cmi_product_attributes/:action/*',
          ['controller' => 'CmiProductAttributes']
        );

        $routes->connect(
          '/medicines/cmis/:letter',
          ['controller' => 'CmiProducts', 'action' => 'letterIndex'],
          [
              'pass' => ['letter'],
              'letter' => '[A-Z]',
          ]
        );

        $routes->connect(
          '/medicines/cmis/:id',
          ['controller' => 'CmiProducts', 'action' => 'view'],
          ['pass' => ['id']]
        );

        $routes->connect(
          '/medicines/cmis/:id/:subid',
          ['controller' => 'CmiProducts', 'action' => 'view'],
          ['pass' => ['id', 'subid']]
        );

    /* Homepage */
        $routes->connect(
          '/homepages/:action/*',
          ['controller' => 'Homepages']
        );
    /* Section Slides */
        $routes->connect(
          '/section_slides/:action/*',
          ['controller' => 'SectionSlides']
        );

    /* Search CMI */
        $routes->connect('/search/cmi',
          ['controller' => 'Searches', 'action' => 'cmi']
        );

    /* Search GP */
        $routes->connect('/search/gp',
          ['controller' => 'Searches', 'action' => 'gp']
        );

    $routes->redirect('/pharmacy-care/common-conditions/', '/pharmacy-care/', ['status' => 301]);
    $routes->redirect('/pain/pain-relief-ladder-for-cancer-pain/', '/pain/cancer-pain', ['status' => 301]);
    $routes->redirect('/tests-investigations/lung-function-testing-in-children/', '/tests-investigations/lung-function-tests', ['status' => 301]);

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    //$routes->connect('/', ['controller' => 'Articles', 'action' => 'homepage', 'home']);

    $routes->connect('/tools/', ['controller' => 'Pages', 'action' => 'tools_list']);
    $routes->connect('/search/', ['controller' => 'Searches', 'action' => 'index']);
    $routes->connect('/', ['controller' => 'Homepages', 'action' => 'home']);


    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

Router::prefix('admin', function ($routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.

    $routes->connect('/', ['controller' => 'Articles', 'action' => 'index']);
    $routes->fallbacks('DashedRoute');
});


/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
