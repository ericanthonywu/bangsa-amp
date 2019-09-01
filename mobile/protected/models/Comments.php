<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $comment_id
 * @property integer $comment_news_id
 * @property string $comment_name
 * @property string $comment_email
 * @property string $comment_url
 * @property string $comment_content
 * @property string $comment_date
 * @property integer $comment_status
 */
class Comments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_news_id, comment_name, comment_email, comment_url, comment_content, comment_date, comment_status', 'default'),
			array('comment_news_id, comment_status', 'numerical', 'integerOnly'=>true),
			array('comment_name', 'length', 'max'=>100),
			array('comment_email, comment_url', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('comment_id, comment_news_id, comment_name, comment_email, comment_url, comment_content, comment_date, comment_status', 'safe', 'on'=>'search'),
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
			'comment_id' => 'Comment',
			'comment_news_id' => 'Comment News',
			'comment_name' => 'Comment Name',
			'comment_email' => 'Comment Email',
			'comment_url' => 'Comment Url',
			'comment_content' => 'comment Content',
			'comment_date' => 'Comment Date',
			'comment_status' => 'Comment Status',
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

		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('comment_news_id',$this->comment_news_id);
		$criteria->compare('comment_name',$this->comment_name,true);
		$criteria->compare('comment_email',$this->comment_email,true);
		$criteria->compare('comment_url',$this->comment_url,true);
		$criteria->compare('comment_content',$this->comment_content,true);
		$criteria->compare('comment_date',$this->comment_date,true);
		$criteria->compare('comment_status',$this->comment_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'comment_id DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
	
	static function approveThis( $data, $datax ){
		$text = "";
		$text2 = "";
		if($data == 1){
			$text = "Tidak Setuju";
			$text2 = "Sudah Disetujui";
		}
		elseif($data == 0){
			$text = "Setuju";
			$text2 = "Belum Disetujui";
		}
		
		return "<a class='doComments' href='javascript:;' data-id='$datax' data-sts='$data'>$text ($text2)</a>";
	}
}
