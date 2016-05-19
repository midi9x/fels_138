<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Activity $Activity
 * @property Lesson $Lesson
 */
class User extends AppModel
{


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = [
        'Activity' => [
            'className' => 'Activity',
        ],
        'Lesson' => [
            'className' => 'Lesson',
        ]
    ];

    public $hasAndBelongsToMany = [
        'Following' => [
            'className' => 'User',
            'joinTable' => 'relationships',
            'foreignKey' => 'follower_id',
            'associationForeignKey' => 'following_id',
        ],
        'Follower' => [
            'className' => 'User',
            'joinTable' => 'relationships',
            'foreignKey' => 'following_id',
            'associationForeignKey' => 'follower_id',
        ]
    ];

}
