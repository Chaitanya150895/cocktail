<?php
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{

    use \Crud\Controller\ControllerTrait;

    public function beforeFilter(Event $event)
    {
       
        parent::beforeFilter($event);
        $this->response = $this->response->cors($this->request)
        ->allowOrigin(['*'])
        ->allowMethods(['GET', 'POST'])
        ->allowHeaders(['X-CSRF-Token'])
        ->allowCredentials()
        ->exposeHeaders(['Link'])
        ->maxAge(300)
        ->build();
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]);
        // $this->loadComponent('Auth', [
        //     'storage' => 'Memory',
        //     'authenticate' => [
        //         'Form' => [
        //             'scope' => ['Users.active' => 1]
        //         ],
        //         'ADmad/JwtAuth.Jwt' => [
        //             'parameter' => 'token',
        //             'userModel' => 'Users',
        //             'scope' => ['Users.active' => 1],
        //             'fields' => [
        //                 'username' => 'id'
        //             ],
        //             'queryDatasource' => true
        //         ]
        //     ],
        //     'unauthorizedRedirect' => false,
        //     'checkAuthIn' => 'Controller.initialize'
        // ]);
        
    }
}