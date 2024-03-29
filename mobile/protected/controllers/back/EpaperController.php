<?php

class EpaperController extends RController
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
	
	protected function beforeRender(){
		$this->redirect('http://bangsaonline.com/kelola.php');
		return true;
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' epaper.
	 */
	public function actionCreate()
	{
		$model=new Epaper;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Epaper']))
		{
			$model->attributes=$_POST['Epaper'];
			if($model->save())
				$this->redirect(array('epaper/index'));
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

		if(isset($_POST['Epaper']))
		{
			$model->attributes=$_POST['Epaper'];
			if($model->save())
				$this->redirect(array('epaper/index'));
		}

		$this->render('update',array(
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Epaper('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Epaper']))
			$model->attributes=$_GET['Epaper'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Epaper the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Epaper::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='epaper-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function displayDate(){
		$epapersModel = Yii::app()->db->createCommand()->select('date')->from('module_epaper')->order('id ASC')->queryAll();
		$z=1;
		$arr=array();
		foreach($epapersModel as $epaperModel){
			if($z==1){
				$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($epaperModel['date']));
				$tanggalPrevius = Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']));
				$z++;
			}
			elseif($z>1){
				if($tanggalPrevius == Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']))){
				}
				else{
					$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($epaperModel['date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($epaperModel['date']));
				}
			}
		}
		return $arr;
	}
}
