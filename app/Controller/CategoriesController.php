<?php
App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 */
class CategoriesController extends AppController
{
    public $helper = ['Form', 'Html', 'PrintData'];
    public $components = ['Paginator', 'Word'];
    public $paginate = [
        'limit' => 10,
        'order' => [
            'Category.id' => 'asc'
        ],
        'recursive' => -1,
    ];

    public function index()
    {
        $this->Paginator->settings = $this->paginate;

        $categories = $this->Paginator->paginate('Category');
        $totalWordLearned = $this->Word->countWordLearned(1);
        $totalWordInCategory = $this->Word->countTotalWordInCategory();
        $this->set([
            'categories' => $categories,
            'totalWordLearned' => $this->Word->fillIssetValue($totalWordLearned, $categories),
            'totalWordInCategory' => $this->Word->fillIssetValue($totalWordInCategory, $categories)
        ]);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your Category has been created.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Session->setFlash(__('Unable to create your Category.'));
        }
    }

    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Category not found!'));
        }
        $category = $this->Category->findById($id);
        if (!$category) {
            throw new NotFoundException(__('Category not found!'));
        }
        if ($this->request->is('post')) {
            $this->Category->id = $id;
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your Category has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Session->setFlash(__('Unable to update your Category.'));
        }
        $this->set('category', $category['Category']);
    }

    public function view($id)
    {
        if (!$id) {
            throw new NotFoundException(__('Category not found!'));
        }
        $category = $this->Category->find('first', [
            'conditions' => ['id' => $id],
            'recursive' => -1
        ]);
        if (!$category) {
            throw new NotFoundException(__('Category not found!'));
        }
        $this->loadModel('Word');
        $words = $this->Word->find('list', [
            'conditions' => ['category_id' => $category['Category']['id']],
            'recursive' => -1,
            'fields' => ['Word.id', 'Word.content']
        ]);
        $this->set([
            'category' => $category['Category'],
            'words' => $words,
        ]);
    }
}
