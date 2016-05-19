<?php
App::uses('AppModel', 'Model');

/**
 * WordAnswer Model
 *
 * @property Word $Word
 */
class WordAnswer extends AppModel
{


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = [
        'Word' => [
            'className' => 'Word',
        ]
    ];

    public $hasAndBelongsToMany = [
        'Lesson' => [
            'className' => 'Lesson',
        ]
    ];
}
