<?php

class IoptionsController extends RController
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$iklan = Ioptions::model()->findAll();
		if(isset($_POST['Iklan']))
		{
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas']
			), 'id=:id', array(':id'=>1));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['samping-logo']
			), 'id=:id', array(':id'=>2));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['samping-topik-1']
			), 'id=:id', array(':id'=>3));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['samping-topik-2']
			), 'id=:id', array(':id'=>4));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-bawah-1']
			), 'id=:id', array(':id'=>5));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-bawah-2']
			), 'id=:id', array(':id'=>6));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-halaman-kiri']
			), 'id=:id', array(':id'=>7));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-halaman-kanan']
			), 'id=:id', array(':id'=>8));
			
			$this->redirect(Yii::app()->createUrl('ioptions'));
		}
		
		$this->render('index');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NewsOptions the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ioptions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NewsOptions $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-options-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
