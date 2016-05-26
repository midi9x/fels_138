<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 */
class Group extends AppModel 
{
    public $actsAs = ['Acl' => ['type' => 'requester']];

    public function parentNode() {
        return null;
    }

    public $validate = [
        'name' => [
            'notempty' => [
                'rule' => ['notempty'],
                'message' => 'The name is required',
            ],
        ],
    ];

    public $hasMany = [
        'User' => [
            'className' => 'User'
        ]
    ];

}
