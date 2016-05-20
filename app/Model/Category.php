<?php
App::uses('AppModel', 'Model');

/**
 * Category Model
 *
 * @property Lesson $Lesson
 * @property Word $Word
 */
class Category extends AppModel
{


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */

    public $validate = [
        'name' => [
            'rule' => 'notEmpty'
        ]
    ];

    public $hasMany = [
        'Lesson' => [
            'className' => 'Lesson',
        ],
        'Word' => [
            'className' => 'Word',
        ]
    ];

}
