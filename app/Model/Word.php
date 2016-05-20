<?php
App::uses('AppModel', 'Model');

/**
 * Word Model
 *
 * @property Category $Category
 * @property WordAnswer $WordAnswer
 * @property Lesson $Lesson
 */
class Word extends AppModel
{


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = [
        'Category' => [
            'className' => 'Category',
        ]
    ];

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = [
        'WordAnswer' => [
            'className' => 'WordAnswer',
        ]
    ];


    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = [
        'Lesson' => [
            'className' => 'Lesson',
        ]
    ];

}
