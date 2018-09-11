<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $helpers = ['AssetCompress.AssetCompress'];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {

        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Dfp');
        $dfp_values = $this->Dfp->dpf_valuables($this->request->params);
        $this->set(compact('dfp_values'));

        $site_config = Configure::read('SiteConfig');
        $this->set(compact('site_config'));

        /* Check current controller and action and more... */
        //$this->set('paamo', $this->request);

        if(isset($this->request->params['prefix']))
        {
            $this->loadComponent('Auth', [
//              'authorize' => [
//                'TinyAuth.Tiny' => [
//                  'multiRole' => false
//                ]
//              ],
              'authenticate' => [
                'Form' => [
                  'fields' => [
                    'username' => 'email',
                    'password' => 'password'
                  ]
                ]
              ],
              'loginRedirect' => [ // After login
                'controller' => 'Users',
                'action' => 'index'
              ],
              'logoutRedirect' => [ // After logout
                'controller' => 'Users',
                'action' => 'login',
              ]
            ]);
            $this->set('authUser', $this->Auth->user());

            /* For CkFinder Authentication */
            $user = $this->Auth->user();
            if($user['role_id']==1){
              setcookie('ckfallmeow', base64_encode('authorized'));
            }
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
