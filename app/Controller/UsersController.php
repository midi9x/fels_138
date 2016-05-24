<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    protected $savePath = APP . WEBROOT_DIR . DS . 'img' . DS . 'uploads' . DS;
    protected $tempPath = APP . WEBROOT_DIR . DS . 'files' . DS . 'temp' . DS;

    public $uses = ['Relationship'];

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('register', 'login', 'logout', 'update', 'view');
    }


    public $helper = ['ShowContent'];

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
        ],
        'UserCommon',
        'Word'
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

    public function update($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('User Not Found'));
        }
        $this->loadModel('User');
        $user = $this->User->find('first', [
            'conditions' => ['id' => $id],
            'recursive' => -1
        ]);
        if (!$user) {
            throw new NotFoundException(__('User Not Found'));
        }
        if ($this->request->is(array('post'))) {
            $dataUpdate = $this->processDataUpdate($this->request->data);
            $fileName = $dataUpdate['fileName'];
            if (!$fileName) {
                $this->User->validator()->remove('avatar_image', 'valid');
            }
            $this->User->validator()->remove('password');
            $this->User->validator()->remove('password_confirmation');
            $this->User->id = $id;
            if ($this->User->save($dataUpdate['data'])) {
                $this->Session->setFlash(__('Profile has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            unlink($this->savePath . $fileName);
            $this->Session->setFlash(__('Unable to update profile.'));
        }
        $this->set('user', $user['User']);
    }

    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('User Not Found!'));
        }
        $this->loadModel('User');
        $user = $this->User->find('first', [
            'recursive' => -1,
            'conditions' => ['id' => $id]
        ]);
        $this->loadModel('Activity');
        $activities = $this->Activity->find('list', [
            'recursive' => -1,
            'conditions' => ['user_id' => $id],
            'fields' => ['id', 'content'],
            'order' => ['created DESC'],
            'limit' => 20
        ]);
        $totalWordLearned = $this->Word->countTotalWordLearned($id);
        //first param is user want to check has following
        //second param is id of current user logged
        //0 is show follow button, 1 is show unfollow button
        $followType = $this->UserCommon->checkFollow($id, $this->Auth->user('id'));
        $followList = $this->UserCommon->getFollowList($id);
        $this->set([
            'user' => $user['User'],
            'activities' => $activities,
            'totalWordLearned' => $totalWordLearned,
            'followType' => $followType,
            'follower' => $followList['follower'],
            'following' => $followList['following'],
            'id' => $id
        ]);
    }

    private function processDataUpdate($data)
    {
        if (!$data['User']['avatar_image']['name']) {
            unset($data['User']['avatar_image']);
            $fileName = null;
        } else {
            $fileName = time() . '_' . $data['User']['avatar_image']['name'];
            move_uploaded_file($data['User']['avatar_image']['tmp_name'], $this->savePath . basename($fileName));
            unset($data['User']['avatar_image']);
            $data['User']['avatar_image'] = $this->savePath . $fileName;
            $data['User']['avatar'] = $fileName;
        }

        return ['data' => $data, 'fileName' => $fileName];
    }

    public function follow($followerId)
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $requestFollow = [
                'following_id' => $this->Auth->user('id'),
                'follower_id' => $followerId
            ];
            if ($this->Relationship->save($requestFollow)) {
                return json_encode(['success' => true]);
            }
            
            return json_encode(['success' => false, 'messages' => __('Has an errors')]);
        }
    }

    public function unFollow($followerId)
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $requestUnFollow = [
                'following_id' => $this->Auth->user('id'),
                'follower_id' => $followerId
            ];
            if ($this->Relationship->deleteAll($requestUnFollow)) {
                return json_encode(['success' => true]);
            }

            return json_encode(['success' => false, 'messages' => __('Has an errors')]);
        }
    }
}
