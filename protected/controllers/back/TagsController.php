<?php

class TagsController extends RController
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

	public function actionDelActAjax()
	{
		if( !empty($_POST['ajaxCall']) ){
			$where = "";
			$wher = "";
			$arrs = explode(',', trim($_POST['ajaxCall'], ','));

			foreach($arrs as $k=>$id){
				// if($k==0){
				// 	$where.="WHERE object_id = '$id'";
				// 	$wher.="WHERE block_object_id = '$id'";
				// }
				// else{
				// 	$where.=" OR object_id = '$id'";
				// 	$wher.=" OR block_object_id = '$id'";
				// }

				$this->loadModel($id)->delete();
				TagRelationship::model()->deleteAll('tagId = :id', array(':id' => $id));
			}

			Yii::app()->user->setFlash('success', 'Tags berhasil di hapus');
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' epaper.
	 */
	public function actionCreate()
	{
		$model=new Tags;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tags']))
		{
			$model->attributes=$_POST['Tags'];
			if($model->save())
				$this->redirect(array('tags/index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' epaper.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tags']))
		{
			$model->attributes=$_POST['Tags'];
			if($model->save())
				$this->redirect(array('epaper/index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionView_berita($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tags']))
		{
			$model->attributes=$_POST['Tags'];
			if($model->save())
				$this->redirect(array('epaper/index'));
		}

		$this->render('view_news',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' epaper.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		TagRelationship::model()->deleteAll('tagId = :id', array(':id' => $id));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bulkactions.js');
		$model=new Tags('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Tags']))
			$model->attributes = $_GET['Tags'];
			
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tags the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tags::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Epaper $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tags-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	// public function displayDate(){
	// 	$epapersModel = Yii::app()->db->createCommand()->select('date')->from('module_epaper')->order('id ASC')->queryAll();
	// 	$z=1;
	// 	$arr=array();
	// 	foreach($epapersModel as $epaperModel){
	// 		if($z==1){
	// 			$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($epaperModel['date']));
	// 			$tanggalPrevius = Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']));
	// 			$z++;
	// 		}
	// 		elseif($z>1){
	// 			if($tanggalPrevius == Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']))){
	// 			}
	// 			else{
	// 				$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($epaperModel['date']));
	// 			}
	// 		}
	// 	}
	// 	return $arr;
	// }
}
