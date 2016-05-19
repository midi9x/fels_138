<?php
App::uses('AppModel', 'Model');

/**
 * Lesson Model
 *
 * @property User $User
 * @property Category $Category
 * @property Word $Word
 */
class Lesson extends AppModel
{

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = [
        'User' => [
            'className' => 'User',
        ],
        'Category' => [
            'className' => 'Category',
        ]
    ];

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = [
        'Word' => [
            'className' => 'Word',
        ],
        'WordAnswer' => [
            'className' => 'WordAnswer',
        ]
    ];



}
