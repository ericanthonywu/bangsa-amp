<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $subject
 * @property string $message
 * @property string $quiry_date
 * @property integer $is_read
 * @property integer $users_id
 *
 * The followings are the available model relations:
 * @property Users $users
 */
class Contact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, website, subject, message, is_read', 'default'),
			array('quiry_date','default', 
				  'value'=>new CDbExpression('NOW()'),
				  'setOnEmpty'=>false, 
				  'on'=>'insert'
			),
			array('type','default', 
				  'value'=>'send',
				  'setOnEmpty'=>false, 
				  'on'=>'insert'
			),
			array('users_id','default', 
				  'value'=>Yii::app()->user->id,
				  'setOnEmpty'=>false, 
				  'on'=>'insert'
			),
			array('is_read, users_id', 'numerical', 'integerOnly'=>true),
			array('name, email, website', 'length', 'max'=>50),
			array('subject', 'length', 'max'=>20),
			array('type', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email, website, subject, message, quiry_date, is_read, users_id, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'users' => array(self::BELONGS_TO, 'Users', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'website' => 'Website',
			'subject' => 'Subject',
			'message' => 'Message',
			'quiry_date' => 'Quiry Date',
			'is_read' => 'Is Read',
			'users_id' => 'Users',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('quiry_date',$this->quiry_date,true);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('users_id',$this->users_id);
		
		if(Yii::app()->user->id != 1){
			$criteria->addCondition('users_id=' . Yii::app()->user->id);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function itemAlias($type,$code=NULL)
	{
		if( $type == 'Author' ){
			$author = User::model()->findByAttributes(array('id'=>$code));
			return $author->username;
		}
		elseif($type == 'Status'){
			if( $code == 1){
				return "Sudah Dibaca";
			}
			elseif( $code == 0){
				return "Belum Dibaca";
			}
		}
		else
			return false;
	}
}
