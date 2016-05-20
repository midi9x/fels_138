<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
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

    public $validate = [
        'email' => [
            'email' => [
                'rule' => 'email',
                'message' => 'Please enter a valid email address',
                'allowEmpty' => false,
            ],
            'unique' => [
                'rule' => 'isUnique',
                'message' => 'This email  has already been used'
            ],
        ],

        'username' => [
            'required' => [
                'rule' => 'notEmpty',
                'message' => 'A username is required'
            ],
            'unique' => [
                'rule' => 'isUnique',
                'message' => 'This username  has already been used'
            ],
        ],

        'password' => [
            'required' => [
                'rule' => 'notEmpty',
                'message' => 'A password is required'
            ]
        ],

        'password_confirmation' => [
            //not use equalTo in cakephp 2.4.1 :((
            'rule' =>['equalToField', 'password'],
            'message' => 'Please confirm the passsword'
        ],
    ];

    public function beforeSave($options = [])
    {
        if ($this->data[$this->alias]['password']) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        return true;
    }

    public function afterFind($results, $primary = false)
    {
        foreach ($results as $key => $val) {
            if (!$val['User']['avatar']) {
                $results[$key]['User']['avatar'] = '/uploads/noavatar.png';
            }
        }

        return $results;
    }

    public function equalToField($array, $field)
    {
        return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
    }
}
