<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController 
{
    public $actsAs = ['Acl' => ['type' => 'requester']];

    public function parentNode() {
        return null;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public $components = ['Paginator'];

    public function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->Paginator->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved.'), 'success');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'errors');
            }
        }
    }

    public function edit($id = null) {
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->request->is(['post', 'put'])) {
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved.'), 'success');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'errors');
            }
        } else {
            $options = ['conditions' => ['Group.' . $this->Group->primaryKey => $id]];
            $this->request->data = $this->Group->find('first', $options);
        }
    }

    public function delete($id = null) {
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Group->delete()) {
            $this->Session->setFlash(__('The group has been deleted.'), 'success');
        } else {
            $this->Session->setFlash(__('The group could not be deleted. Please, try again.'), 'error');
        }
        return $this->redirect(['action' => 'index']);
    }
}
