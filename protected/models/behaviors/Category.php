<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $category_id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $category_name
 * @property string $category_description
 * @property string $category_slug
 * @property integer $active
 * @property integer $module_id
 * @property integer $is_indeks
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_name', 'required'),
			array('lft, rgt, level, category_description, category_slug, active, module_id, is_indeks', 'default'),
			array('root, lft, rgt, level, active, module_id, is_indeks', 'numerical', 'integerOnly'=>true),
			array('category_name,category_slug', 'length', 'max'=>125),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('category_id, root, lft, rgt, level, category_name, category_description, category_slug, active, module_id', 'safe', 'on'=>'search'),
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
			'category_id' => 'Category',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'category_name' => 'Nama Kategori',
			'category_description' => 'Deskripsi Kategori',
			'category_slug' => 'Category Slug',
			'active' => 'Active',
			'module_id' => 'Module',
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
			),
			'SlugBehavior' => array(
				'class' => 'application.models.behaviors.SlugBehavior',
				'slug_col' => 'category_slug',
				'title_col' => 'category_name',
				'max_slug_chars' => 125,
				'overwrite' => true
			)
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('root',$this->root);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('category_description',$this->category_description,true);
		$criteria->compare('category_slug',$this->category_slug,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('module_id',$this->module_id);
		$criteria->order('lft', 'ASC');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function itemAlias($diff, $code = 0){
		if($diff == "categoryStatus"){
			if($code == 1)
				return "Aktif";
			else{
				return "Tidak Aktif";
			}
		}
	}
}
