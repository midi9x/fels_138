<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/05/2016
 * Time: 09:37
 */
class UserCommonComponent extends Component
{
    //Check Current User Logged is following $userID or not
    public function checkFollow($userId, $loggedId)
    {
        if (!isset($userId) || !isset($loggedId) || (int)$userId == (int)$loggedId) {

            return 0;
        }
        $userModel = ClassRegistry::init('User');
        $options = [
            'joins' => [
                [
                    'table' => 'relationships',
                    'alias' => 'RS',
                    'type' => 'INNER',
                    'conditions' => ['RS.follower_id = User.id',]
                ]
            ],
            'conditions' => ['RS.following_id' => $loggedId],
            'fields' => ['RS.id'],
            'recursive' => -1
        ];
        $isFollow = $userModel->find('first', $options);
        if (count($isFollow) > 0) {

            return 1;
        }

        return -1;
    }

    public function getFollowList($userId)
    {
        if (!$userId) {

            return [];
        }
        $relationshipModel = ClassRegistry::init('Relationship');
        $options = [
            'joins' => [
                [
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'INNER',
                    'conditions' => ['u.id = Relationship.following_id']
                ],
            ],
            'conditions' => ['Relationship.follower_id' => $userId],
            'recursive' => -1,
            'fields' => ['u.id', 'u.username']
        ];
        $follower = $relationshipModel->find('list', $options);
        $options['joins'][0]['conditions'] = ['u.id = Relationship.follower_id'];
        $options['conditions'] = ['Relationship.following_id' => $userId];
        $following = $relationshipModel->find('list', $options);

        return [
            'follower' => $follower,
            'following' => $following,
        ];
    }
}