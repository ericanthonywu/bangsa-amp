<?php

class OptionsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights'
			/*'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request*/
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 *
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	*/
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$option_id = array(1,2,3,4,5);
		$criteria = new CDbCriteria();
		$criteria->addInCondition('option_id',$option_id,true);
		$options = Options::model()->findAll($criteria);
		
		if(isset($_POST['Options']))
		{
			$valid = true;
			foreach($options as $i=>$option){
				if(isset($_POST['Options'][$i]))
					$option->attributes=$_POST['Options'][$i];
					$option->save();
					
				$valid=$option->validate() && $valid;
			}
			if($valid){
				Yii::app()->user->setFlash('success', "Berhasil diubah");
				$this->redirect(array('options/index'));
			}
		}
		
		$this->render('index',array(
			'options'=>$options
		));
	}
	
	public function actionStickyhotnews()
	{
		$option_id = array(6,7,8,9,10,11);
		$criteria = new CDbCriteria();
		$criteria->addInCondition('option_id',$option_id,true);
		$options = Options::model()->findAll($criteria);
		
		$newsArr = array();
		$newsArr[''] = 'Pilih Sticky News';
		$news	= Yii::app()->db->createCommand("SELECT news_id, news_title FROM module_news WHERE news_status = '1' AND news_type='1' ORDER BY news_id DESC LIMIT 100")->queryAll(); 
		foreach($news as $newsingle){
			$idnews = $newsingle['news_id'];
			$newsArr[$idnews] = strip_tags($newsingle['news_title']);
		}
		
		if(isset($_POST['Options']))
		{
			$valid = true;
			foreach($options as $i=>$option){
				if(isset($_POST['Options'][$i]))
					$option->attributes=$_POST['Options'][$i];
					$option->save();
					
				$valid=$option->validate() && $valid;
			}
			if($valid){
				Yii::app()->user->setFlash('success', "Berhasil diubah");
				$this->redirect(array('options/stickyhotnews'));
			}
		}
		
		$this->render('stickyhotnews',array(
			'options'=>$options,
			'newsArr'=>$newsArr
		));
	}
	
}
