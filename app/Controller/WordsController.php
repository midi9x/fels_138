<?php

App::uses('AppController', 'Controller');

class WordsController extends AppController
{
    public $uses = ['Category', 'Word', 'User', 'WordAnswer', 'Lesson'];

    public $components = ['FilterWord', 'Session', 'Paginator'];

    public function index()
    {
        $options = [
            'fields' => 'Word.content',
            'limit' => 5,
            'order' => 'Word.created'
        ];
        
        if ($this->request->is('get')) {
            $category_id = $this->request->query('category_id');
            $filter = $this->request->query('filter');
            $options += $this->FilterWord->filter($this->Auth->user('id'), $category_id, $filter);
        }

        $this->Paginator->settings = $options;
        $this->set('words', $this->Paginator->paginate('Word'));
        $this->set('categories', $this->Category->find('list', ['fields' => [
            'Category.id', 
            'Category.name'
        ]]));
    }

    public function add() 
    {
        $this->set('categories', $this->Category->find('list', ['fields' => [
            'Category.id', 
            'Category.name'
        ]]));
        if ($this->request->is('post')) {
            if ($this->Word->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('Add word successfully !'), 'success');

                return $this->redirect(['action' => 'index']);
            }
            $this->Session->setFlash(__('Could not add word. Please, try again.'), 'errors');
        }
    }

    public function delete($id) 
    {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Word->delete($id)) {
            $this->Session->setFlash(
                __('The word has been deleted'), 'success'
            );
        } else {
            $this->Flash->error(
                __('The word could not be deleted.'), 'errors'
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function edit($id = null) 
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid word'));
        }

        $word = $this->Word->findById($id);
        if (!$word) {
            throw new NotFoundException(__('Invalid word'));
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Word->id = $id;
            if ($this->Word->save($this->request->data['Word'])) {
                $this->WordAnswer->saveMany($this->request->data['WordAnswer']);
                $this->Session->setFlash(__('Your word has been updated.'), 'success');

                return $this->redirect(['action' => 'index']);
            }
            $this->Session->setFlash(__('Unable to update your word.'), 'errors');
        }

        if (!$this->request->data) {
            $this->request->data = $word;
        }
        
        $this->set('categories', $this->Category->find('list', ['fields' => [
            'Category.id', 
            'Category.name'
        ]]));
    }
}
