<?php

/**
 * This is the model class for table "module_news".
 *
 * The followings are the available columns in table 'module_news':
 * @property integer $news_id
 * @property string $news_title
 * @property string $news_content
 * @property string $news_excerpt
 * @property string $news_penulis
 * @property string $news_wartawan
 * @property string $news_image
 * @property string $news_slug
 * @property integer $news_author
 * @property integer $news_type
 * @property string $news_date
 * @property string $news_modified
 * @property string $news_status
 * @property string $youtube_links
 * @property string $news_meta_title
 * @property string $news_meta_keyword
 * @property string $news_meta_desc
 * @property string $news_source
 * @property string $embed
 * @property string $is_headline
 * @property string $oleh
 * @property string $ayat
 */
class News extends CActiveRecord
{
	public $azmcat;
	public $validacion;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_title, news_content, news_type', 'required'),
			array('news_title, news_content, news_penulis', 'safe'),
			array('news_penulis, news_wartawan, news_image, news_slug, news_meta_title, news_meta_keyword, news_meta_desc, news_status, youtube_links, news_source, news_excerpt, embed, is_headline, oleh,ayat', 'default'),
			array('news_date, news_modified','default',
				  'value'=>new CDbExpression('NOW()'),
				  'setOnEmpty'=>false,'on'=>'insert'),
			array('news_author', 'default',
					'value'=>Yii::app()->user->id,
					'setOnEmpty'=>false, 'on'=>'insert'),
			array('news_type, news_author, news_status', 'numerical', 'integerOnly'=>true),
			array('news_title, news_image, news_slug, news_meta_title', 'length', 'max'=>100),
			array('news_source', 'length', 'max'=>150),
			array('news_penulis, news_wartawan, news_meta_keyword', 'length', 'max'=>50),
			array('news_meta_desc', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('news_id, news_title, news_content, news_penulis, news_wartawan, news_image, news_slug, news_author, news_type, news_date, news_modified, news_meta_title, news_meta_keyword, news_meta_desc, news_status, youtube_links', 'safe', 'on'=>'search'),
			array('news_title, news_status', 'safe', 'on'=>'teenage'),
			array('azmcat', 'required', 'message' => 'Kategori tidak boleh kosong'),
			array('validacion', 
               'application.extensions.recaptcha.EReCaptchaValidator', 
               'privateKey'=>'6Lck7O8SAAAAAFHl35J1QIune6kNNLNYdMM7Pvlb',
			   'on'=>'registerwcaptcha'
			),
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
	
	function behaviors() {
		return array(
			'tags' => array(
				'class' => 'ext.taggable.ETaggableBehavior',
				// Table where tags are stored
				'tagTable' => 'tag',
				// Cross-table that stores tag-model connections.
				// By default it's your_model_tableTag
				'tagBindingTable' => 'tag_relationship',
				// Foreign key in cross-table.
				// By default it's your_model_tableId
				'modelTableFk' => 'post_id',
				// Tag table PK field
				'tagTablePk' => 'id',
				// Tag name field
				'tagTableName' => 'tag_name',
				// Tag counter field
				// if null (default) does not write tag counts to DB
				// Tag binding table tag ID
				'tagBindingTableTagId' => 'tagId',
				// Caching component ID. If false don't use cache.
				// Defaults to false.
				'cacheID' => 'cache',
	 
				// Save nonexisting tags.
				// When false, throws exception when saving nonexisting tag.
				'createTagsAutomatically' => true,
	 
				// Default tag selection criteria
				'scope' => array(
				),
	 
				// Values to insert to tag table on adding tag
				'insertValues' => array(
				),
			),
			'running' => array(
				'class' => 'ext.taggable.ETaggableBehavior',
				// Table where tags are stored
				'tagTable' => 'running_news',
				// Cross-table that stores tag-model connections.
				// By default it's your_model_tableTag
				'tagBindingTable' => 'running_news_relationship',
				// Foreign key in cross-table.
				// By default it's your_model_tableId
				'modelTableFk' => 'post_id',
				// Tag table PK field
				'tagTablePk' => 'id',
				// Tag name field
				'tagTableName' => 'running_name',
				// Tag counter field
				// if null (default) does not write tag counts to DB
				// Tag binding table tag ID
				'tagBindingTableTagId' => 'running_id',
				// Caching component ID. If false don't use cache.
				// Defaults to false.
				'cacheID' => 'cache',
	 
				// Save nonexisting tags.
				// When false, throws exception when saving nonexisting tag.
				'createTagsAutomatically' => true,
	 
				// Default tag selection criteria
				'scope' => array(
				),
	 
				// Values to insert to tag table on adding tag
				'insertValues' => array(
				),
			),
			'category' => array(
				'class' => 'ext.taggable.ETaggableBehavior',
				// Table where tags are stored
				'tagTable' => 'category',
				// Cross-table that stores tag-model connections.
				// By default it's your_model_tableTag
				'tagBindingTable' => 'category_relationship',
				// Foreign key in cross-table.
				// By default it's your_model_tableId
				'modelTableFk' => 'post_id',
				// Tag table PK field
				'tagTablePk' => 'category_id',
				// Tag name field
				'tagTableName' => 'category_id',
				// Tag counter field
				// if null (default) does not write tag counts to DB
				// Tag binding table tag ID
				'tagBindingTableTagId' => 'category_id',
				// Caching component ID. If false don't use cache.
				// Defaults to false.
				'cacheID' => 'cache',
	 
				// Save nonexisting tags.
				// When false, throws exception when saving nonexisting tag.
				'createTagsAutomatically' => true,
	 
				// Default tag selection criteria
				'scope' => array(
				),
	 
				// Values to insert to tag table on adding tag
				'insertValues' => array(
				),
			),
			'SlugBehavior' => array(
				'class' => 'application.models.behaviors.SlugBehavior',
				'slug_col' => 'news_slug',
				'title_col' => 'news_title',
				'max_slug_chars' => 100,
				'overwrite' => true
			)
		);
	}

	
	public static function itemAlias($type,$code=NULL)
	{
		if( $type == 'Author' ){
			$author = User::model()->findByAttributes(array('id'=>$code));
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
			return count(Yii::app()->db->createCommand()->select('news_title')->from('module_news')->where('news_status=1')->queryAll());
		}
		elseif($code == 2){
			return count(Yii::app()->db->createCommand()->select('news_title')->from('module_news')->where('news_status=2')->queryAll());
		}
		elseif($code == 3){
			return count(Yii::app()->db->createCommand()->select('news_title')->from('module_news')->where('news_status=3')->queryAll());
		}
	}
	
	public static function category($model){
		$categories = Yii::app()->db->createCommand()->select('category_name')->from('category a')->join('category_relationship b','a.category_id=b.category_id')->where('b.post_id='.$model->news_id)->queryAll();
		foreach($categories as $category){
			if(end($categories) == $category) 
				echo $category['category_name'];
			else 
				echo $category['category_name'].", ";	
		}
	}

	public static function LinkUpdate($model)
	{
		$page_n = isset($_GET['News_page']) ? ((int) $_GET['News_page']): '';
		$params['id'] = $model->news_id;
		if ( isset($_GET['News_page']) ) {
			$params['News_page'] = $page_n;
		}

		$retrn = Yii::app()->createUrl('/news/update/', $params);
		return $retrn;
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'news_id' => 'News',
			'news_title' => 'Judul Berita',
			'news_content' => 'Konten Berita',
			'news_penulis' => 'Penulis Berita',
			'news_wartawan' => 'Wartawan Berita',
			'news_image' => 'News Image',
			'news_slug' => 'News Slug',
			'news_author' => 'News Author',
			'news_type' => 'Jenis Berita',
			'news_date' => 'News Date',
			'news_modified' => 'News Modified',
			'news_status' => 'Status Berita',
			'news_meta_title' => 'News Meta Title',
			'news_meta_keyword' => 'News Meta Keyword',
			'news_meta_desc' => 'News Meta Desc',
			'news_source' => 'Sumber Berita',
			'news_excerpt' => 'Cuplikan Berita',
			'embed' => 'Embed Youtube Video',
			'is_headline' => 'Ditampilkan di slide',
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

		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('news_author',$this->news_author);
		$criteria->compare('news_type',$this->news_type);
		$criteria->compare('news_modified',$this->news_modified,true);
		$criteria->compare('news_date',$this->news_date, true);
		
		$status = $this->news_status;
		
		if(isset($status) && $status== 3){ // If Trash
			$criteria->compare('news_status',3,true);
		}
		elseif(isset($status) && $status== 2){ // If Draft
			$criteria->compare('news_status',2,true);
		}
		else{ // if default & publish
			$criteria->compare('news_status',1,true);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'news_date DESC',
			),
		));
	}
	
	public function teenage()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('news_author',$this->news_author);
		$criteria->compare('news_type',$this->news_type);
		$criteria->compare('news_modified',$this->news_modified,true);
		$criteria->compare('news_status',4, true);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'news_date DESC',
			),
		));
	}
	
	/*public static function markSearch($model,$field,$prefix='<strong>',$sufix='</strong>') {
		$className = get_class($model);
		if (isset($_GET[$className][$field])&&$_GET[$className][$field])
			return str_replace($_GET[$className][$field],$prefix.$_GET[$className][$field].$sufix,$model->getAttribute($field));
		else 
			return $model->getAttribute($field);
	}*/

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
