<?php

/**
 * This is the model class for table "widget".
 *
 * The followings are the available columns in table 'widget':
 * @property integer $widget_id
 * @property string $widget_name
 * @property string $widget_type
 * @property integer $module_id
 * @property integer $object_id
 * @property integer $widget_group_id
 * @property string $widget_style
 * @property string $widget_setting_two
 */
class Widget extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'widget';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('root, lft, rgt, level, widget_name, widget_type, module_id, object_id, widget_group_id, widget_style, widget_setting_two', 'default'),
			array('module_id, object_id, widget_group_id', 'numerical', 'integerOnly'=>true),
			array('widget_type, widget_style', 'length', 'max'=>20),
			array('widget_setting_two, widget_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('widget_id, widget_name, widget_type, module_id, object_id, widget_group_id, widget_style, widget_setting_two', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'widget_id' => 'Widget',
			'widget_name' => 'Widget Name',
			'widget_type' => 'Widget Type',
			'module_id' => 'Module',
			'object_id' => 'Object',
			'widget_group_id' => 'Widget Group',
			'widget_style' => 'Widget Style',
			'widget_setting_two' => 'Widget Setting Two',
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

		$criteria->compare('widget_id',$this->widget_id);
		$criteria->compare('widget_name',$this->widget_name,true);
		$criteria->compare('widget_type',$this->widget_type,true);
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('widget_group_id',$this->widget_group_id);
		$criteria->compare('widget_style',$this->widget_style);
		$criteria->compare('widget_setting_two',$this->widget_setting_two,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Widget the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function behaviors()
	{
		return array(
			'nestedSetBehavior'=>array(
				'class'=>'application.models.behaviors.NestedSetBehavior',
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
			),
		);
	}
}
