<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $page_id
 * @property string $page_title
 * @property string $page_content
 * @property integer $page_status
 * @property string $page_slug
 * @property integer $page_author
 * @property string $page_date
 * @property string $page_modified
 * @property string $page_link
 * @property string $page_template
 *
 * The followings are the available model relations:
 * @property Users $pageAuthor
 */
class Page extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'page';
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_title, page_content', 'required'),
			array('page_modified','default',
				  'value'=>new CDbExpression('NOW()'),
				  'setOnEmpty'=>false,'on'=>'update'),
			array('page_author','default',
				  'value'=>Yii::app()->user->id,
				  'setOnEmpty'=>false,'on'=>'insert'),
			array('page_date, page_modified','default',
				  'value'=>new CDbExpression('NOW()'),
				  'setOnEmpty'=>false,'on'=>'insert'),
			array('page_link, page_template, page_status, page_slug,', 'default'),
			array('page_status, page_author', 'numerical', 'integerOnly'=>true),
			array('page_title, page_slug', 'length', 'max'=>100),
			array('page_link', 'length', 'max'=>120),
			array('page_template', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('page_title, page_author, page_status, page_date', 'safe', 'on'=>'search'),
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
			'pageAuthor' => array(self::BELONGS_TO, 'Users', 'page_author'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'page_id' => 'Page',
			'page_title' => 'Page Title',
			'page_content' => 'Page Content',
			'page_status' => 'Page Status',
			'page_slug' => 'Page Slug',
			'page_author' => 'Page Author',
			'page_date' => 'Page Date',
			'page_modified' => 'Page Modified',
			'page_link' => 'Page Link',
			'page_template' => 'Page Template',
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

		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_author',$this->page_author);
		$criteria->compare('page_date',$this->page_date,true);
		
		$status = $this->page_status;
		
		if(isset($status) && $status== 3){ // If Trash
			$criteria->compare('page_status',3,true);
		}
		elseif(isset($status) && $status== 2){ // If Draft
			$criteria->compare('page_status',2,true);
		}
		else{ // if default & publish
			$criteria->compare('page_status',1,true);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'page_date DESC',
			)
		));
	}
	
	public function behaviors()
	{
		return array(
			'SlugBehavior' => array(
				'class' => 'application.models.behaviors.SlugBehavior',
				'slug_col' => 'page_slug',
				'title_col' => 'page_title',
				'max_slug_chars' => 125,
				'overwrite' => true
			)
		);
	}
	
	public function beforeSave()
	{	
		if($this->isNewRecord){
			return parent::beforeSave();
		}
		else{
			return parent::beforeSave();
		}
	}
	
	public static function itemAlias($type,$code=NULL)
	{
		if( $type == 'Author' ){
			$author = Users::model()->findByAttributes(array('id'=>$code));
			if($author){
				return $author->username;
			}
			else{
				return "User telah dihapus";
			}
			
		}
		elseif($type == 'Status'){
			if( $code == 1){
				return "Published";
			}
			elseif( $code == 2){
				return "Draft";
			}
			elseif( $code == 3){
				return "Trash";
			}
		}
		else
			return false;
	}
	
	public static function searchStatus($code){
		if($code == 1){
			return count(Yii::app()->db->createCommand()->select('page_title')->from('page')->where('page_status=1')->queryAll());
		}
		elseif($code == 2){
			return count(Yii::app()->db->createCommand()->select('page_title')->from('page')->where('page_status=2')->queryAll());
		}
		elseif($code == 3){
			return count(Yii::app()->db->createCommand()->select('page_title')->from('page')->where('page_status=3')->queryAll());
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
