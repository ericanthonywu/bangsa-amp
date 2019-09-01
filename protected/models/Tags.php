<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $id
 * @property integer $tag_name
 * @property string $tag_title
 */
class Tags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, tag_name, tag_title', 'default'),
			// array('comment_news_id, comment_status', 'numerical', 'integerOnly'=>true),
			array('tag_title, tag_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tag_title, tag_name', 'safe', 'on'=>'search'),
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
			'id' => 'Id',
			'tag_name' => 'Tag Name',
			'tag_title' => 'Tag Title',
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
		$criteria->compare('tag_name',$this->tag_name);
		$criteria->compare('tag_title',$this->tag_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	static function itemAlias($type, $data=null){
		if($type=='Status'){
			if($data==1){
				return "Disetujui";
			}
			elseif($data==0){
				return "Tidak Disetujui";
			}
		}
	}
	
	static function whomever( $data ){
		$sql = "SELECT news_id, news_slug, news_title FROM module_news WHERE news_id = '$data'";
		$modelz = Yii::app()->db->createCommand($sql)->queryRow();
		if(count($modelz)>0){
			return "<a target='_blank' href=".Yii::app()->getBaseUrl(true).'/berita/'.$modelz['news_id'].'/'.$modelz['news_slug'].">{$modelz['news_title']}</a>";	
		}
		else{
			return "Berita telah dihapus";
		}
		
	}
}
