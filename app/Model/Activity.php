<?php
App::uses('AppModel', 'Model');
/**
 * Activity Model
 *
 * @property Target $Target
 * @property User $User
 */
class Activity extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = [
		'User' => [
			'className' => 'User',
		]
	];
}
