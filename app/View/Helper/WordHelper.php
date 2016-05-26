<?php

App::uses('AppHelper', 'View/Helper', 'AuthComponent', 'AclComponent');

class WordHelper extends AppHelper 
{
    public $helpers = ['Html', 'Form'];
    public $acl;

    public function __construct() 
    {
        $this->acl = new AclComponent(new ComponentCollection());
    }

    public function showLink($text, $class, $action, $id = null)
    {
        if ($this->acl->check(['User' => AuthComponent::user()], 'controllers/words/' . $action)) {
            return $this->Html->link($text, ['action' => $action, $id], [
                'class' => $class,
                'escape' => false
            ]);
        }
    }

    public function showDelete($id)
    {
        if ($this->acl->check(['User' => AuthComponent::user()], 'controllers/words/delete')) {
            return $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $id], [
                'confirm' => __('Are you sure to delete ?'),
                'class' => 'btn btn-danger',
                'escape' => false
            ]);
        }
    }
}