<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $menu_id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $menu_title
 * @property string $menu_slug
 * @property string $menu_description
 * @property integer $menu_url_id
 * @property string $menu_url
 * @property string $menu_type
 * @property string $category_id
 */
class Menu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lft, rgt, level, menu_title, menu_slug, menu_description, menu_url_id, menu_url, menu_type, category_id, group_id, menu_title_attribute', 'default'),
			array('root, lft, rgt, level, menu_url_id, category_id, group_id', 'numerical', 'integerOnly'=>true),
			array('menu_title, menu_slug, menu_url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_url_id, menu_url, menu_type, category_id, group_id, menu_title_attribute', 'safe', 'on'=>'search'),
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
			'menu_id' => 'Menu',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'menu_title' => 'Menu Title',
			'menu_slug' => 'Menu Slug',
			'menu_description' => 'Menu Description',
			'menu_url_id' => 'Menu Url',
			'menu_url' => 'Menu Url',
			'menu_type' => 'Menu Type',
			'category_id' => 'Kategori',
		);
	}
	
	public function behaviors()
	{
		return array(
			'nestedSetBehavior'=>array(
				'class'=>'application.models.behaviors.NestedSetBehavior',
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
				'hasManyRoots'=>false
			),
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

		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('root',$this->root);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);
		$criteria->compare('menu_title',$this->menu_title,true);
		$criteria->compare('menu_slug',$this->menu_slug,true);
		$criteria->compare('menu_description',$this->menu_description,true);
		$criteria->compare('menu_title_attribute',$this->menu_title_attribute);
		$criteria->compare('menu_url_id',$this->menu_url_id);
		$criteria->compare('menu_url',$this->menu_url,true);
		$criteria->compare('menu_type',$this->menu_type,true);
		$criteria->compare('category_id',$this->menu_url);
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
