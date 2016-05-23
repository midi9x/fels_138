<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController
{

    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow('register', 'login', 'logout');
    }

    public $components = [
        'Auth' => [
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login',
            ],
            'authenticate' => [
                'Form' => [
                    'passwordHasher' => 'Blowfish'
                ]
            ]
        ]
    ];
    
    public function register() 
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Register successfully !'), 'success');
                $this->Auth->login($this->request->data['User']);

                return $this->redirect('/');
            }
            $this->Session->setFlash(__('Could not register. Please, try again.'), 'errors');
        }
    }

    public function login() 
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect('/');
            }
            $this->Session->setFlash(_('Invalid email address or password !'), 'errors');
        }
    }

    public function logout() 
    {
        return $this->redirect($this->Auth->logout());
    }
}
