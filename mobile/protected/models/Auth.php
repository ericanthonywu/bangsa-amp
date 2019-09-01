<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $create_at
 * @property string $lastvisit_at
 * @property integer $status
 * @property integer $level
 *
 * The followings are the available model relations:
 * @property Contact[] $contacts
 * @property Page[] $pages
 */
class Users extends CActiveRecord
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('lastvisit_at, create_at', 'default'),
			array('username, password', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
		);
	}

}
