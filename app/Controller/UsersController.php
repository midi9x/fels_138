<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    CONST GROUP_AMIN = 1;
    CONST GROUP_USER = 2;

    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow('index', 'register', 'login', 'logout', 'initAcl');
    }
    
    public function initAcl() {
        $group = $this->User->Group;
        // Allow admins to everything
        $group->id = self::GROUP_AMIN;
        $this->Acl->allow($group, 'controllers');

        // Allow user
        $group->id = self::GROUP_USER;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/words/index');
        $this->Acl->allow($group, 'controllers/pages/display');
        $this->Acl->allow($group, 'controllers/categories/index');

        echo 'init ok';
        exit;
    }

    public function register() 
    {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['group_id'] = self::GROUP_USER;
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
