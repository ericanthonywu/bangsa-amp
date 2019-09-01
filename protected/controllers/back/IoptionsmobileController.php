<?php

class IoptionsmobileController extends RController
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
		$iklan = Ioptions::model()->findAll();
		if(isset($_POST['Iklan']))
		{
			if(!isset($_POST['Iklan']['tipe-mobile-bawah-logo'])){$bawahlogo = 0;}else{$bawahlogo = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-bawah-menu'])) {$bawahmenu = 0;}else{$bawahmenu = 1;}
			
			if(!isset($_POST['Iklan']['tipe-mobile-atas-berita-utama'])) {$atasberitautama = 0;}else{$atasberitautama = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-atas-berita-utama-2'])) {$atasberitautamatwo = 0;}else{$atasberitautamatwo = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-atas-berita-utama-3'])) {$atasberitautamathree = 0;}else{$atasberitautamathree = 1;}

			if(!isset($_POST['Iklan']['tipe-mobile-atas-hot-news'])) {$atashotnews = 0;}else{$atashotnews = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-bawah-hot-news'])) {$bawahhotnews = 0;}else{$bawahhotnews = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-bawah-blok'])) {$bawahblok = 0;}else{$bawahblok = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-detail-berita-bawah'])) {$detailberitabawah = 0;}else{$detailberitabawah = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-detail-berita-bawah-berita-populer'])) {$bawahberitapopuler = 0;}else{$bawahberitapopuler = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-detail-berita-bawah-berita-populer2'])) {$bawahberitapopuler2 = 0;}else{$bawahberitapopuler2 = 1;}

			if(!isset($_POST['Iklan']['tipe-mobile-detail-berita-tengah'])) {$detailberitatengah = 0;}else{$detailberitatengah = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-detail-berita-bawah2'])) {$detailberitabawah2 = 0;}else{$detailberitabawah2 = 1;}
			
			if(!isset($_POST['Iklan']['tipe-mobile-atas-hot-news2'])) {$atashotnews2 = 0;}else{$atashotnews2 = 1;}
			if(!isset($_POST['Iklan']['tipe-mobile-atas-hot-news3'])) {$atashotnews3 = 0;}else{$atashotnews3 = 1;}
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-bawah-logo'],
				'style'=>$bawahlogo
			), 'id=:id', array(':id'=>14));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-bawah-menu'],
				'style'=>$bawahmenu
			), 'id=:id', array(':id'=>15));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-atas-berita-utama'],
				'style'=>$atasberitautama
			), 'id=:id', array(':id'=>16));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-atas-berita-utama-2'],
				'style'=>$atasberitautamatwo
			), 'id=:id', array(':id'=>31));
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-atas-berita-utama-3'],
				'style'=>$atasberitautamathree
			), 'id=:id', array(':id'=>32));
			
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-atas-hot-news'],
				'style'=>$atashotnews
			), 'id=:id', array(':id'=>17));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-bawah-hot-news'],
				'style'=>$bawahhotnews
			), 'id=:id', array(':id'=>18));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-bawah-blok'],
				'style'=>$bawahblok
			), 'id=:id', array(':id'=>19));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-detail-berita-bawah'],
				'style'=>$detailberitabawah
			), 'id=:id', array(':id'=>20));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-detail-berita-tengah'],
				'style'=>$detailberitatengah
			), 'id=:id', array(':id'=>24));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-detail-berita-bawah-berita-populer'],
				'style'=>$bawahberitapopuler
			), 'id=:id', array(':id'=>21));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-detail-berita-bawah-berita-populer2'],
				'style'=>$bawahberitapopuler2
			), 'id=:id', array(':id'=>22));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-detail-berita-bawah2'],
				'style'=>$detailberitabawah2
			), 'id=:id', array(':id'=>25));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-atas-hot-news2'],
				'style'=>$atashotnews
			), 'id=:id', array(':id'=>27));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['mobile-atas-hot-news3'],
				'style'=>$atashotnews
			), 'id=:id', array(':id'=>28));
			
			Yii::app()->user->setFlash('success', "Pengaturan Iklan berhasil diubah");
			$this->redirect(Yii::app()->createUrl('ioptionsmobile'));
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
