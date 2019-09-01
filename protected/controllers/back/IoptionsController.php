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
			if(!isset($_POST['Iklan']['tipe-atas'])){$atas = 0;}else{$atas = 1;}
			if(!isset($_POST['Iklan']['tipe-samping-logo'])) {$sampinglogo = 0;}else{$sampinglogo = 1;}
			if(!isset($_POST['Iklan']['tipe-samping-topik-1'])) {$sampingtopik1 = 0;}else{$sampingtopik1 = 1;}
			if(!isset($_POST['Iklan']['tipe-samping-topik-2'])) {$sampingtopik2 = 0;}else{$sampingtopik2 = 1;}
			if(!isset($_POST['Iklan']['tipe-iklan-bawah-1'])) {$bawah1 = 0;}else{$bawah1 = 1;}
			if(!isset($_POST['Iklan']['tipe-iklan-bawah-2'])) {$bawah2 = 0;}else{$bawah2 = 1;}
			if(!isset($_POST['Iklan']['tipe-iklan-halaman-kiri'])) {$halamankiri = 0;}else{$halamankiri = 1;}
			if(!isset($_POST['Iklan']['tipe-iklan-halaman-kanan'])) {$halamankanan = 0;}else{$halamankanan = 1;}
			if(!isset($_POST['Iklan']['tipe-bawah-detail-berita'])) {$bawahdetailberita = 0;}else{$bawahdetailberita = 1;}
			if(!isset($_POST['Iklan']['tipe-atas-hot-news-1'])) {$atashotnewsone = 0;}else{$atashotnewsone = 1;}
			if(!isset($_POST['Iklan']['tipe-atas-hot-news-2'])) {$atashotnewstwo = 0;}else{$atashotnewstwo = 1;}
			if(!isset($_POST['Iklan']['tipe-atas-topik-khas-1'])) {$atastopikkhasone = 0;}else{$atastopikkhasone = 1;}
			if(!isset($_POST['Iklan']['tipe-atas-topik-khas-2'])) {$atastopikkhastwo = 0;}else{$atastopikkhastwo = 1;}

			if(!isset($_POST['Iklan']['tipe-atas-topik-khas-3'])) {$atastopikkhasthree = 0;}else{$atastopikkhasthree = 1;}
			if(!isset($_POST['Iklan']['tipe-atas-topik-khas-4'])) {$atastopikkhasfour = 0;}else{$atastopikkhasfour = 1;}

			if(!isset($_POST['Iklan']['tipe-tengah-detail-berita'])) {$tengahdetailberita = 0;}else{$tengahdetailberita = 1;}
			if(!isset($_POST['Iklan']['tipe-bawah-detail-berita2'])) {$bawahdetailberita2 = 0;}else{$bawahdetailberita2 = 1;}
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas'],
				'style'=>$atas
			), 'id=:id', array(':id'=>1));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['samping-logo'],
				'style'=>$sampinglogo
			), 'id=:id', array(':id'=>2));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['samping-topik-1'],
				'style'=>$sampingtopik1
			), 'id=:id', array(':id'=>3));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['samping-topik-2'],
				'style'=>$sampingtopik2
			), 'id=:id', array(':id'=>4));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-bawah-1'],
				'style'=>$bawah1
			), 'id=:id', array(':id'=>5));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-bawah-2'],
				'style'=>$bawah2
			), 'id=:id', array(':id'=>6));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-halaman-kiri'],
				'style'=>$halamankiri
			), 'id=:id', array(':id'=>7));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['iklan-halaman-kanan'],
				'style'=>$halamankanan
			), 'id=:id', array(':id'=>8));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['bawah-detail-berita'],
				'style'=>$bawahdetailberita
			), 'id=:id', array(':id'=>9));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas-hot-news-1'],
				'style'=>$atashotnewsone
			), 'id=:id', array(':id'=>10));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas-hot-news-2'],
				'style'=>$atashotnewstwo
			), 'id=:id', array(':id'=>11));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas-topik-khas-1'],
				'style'=>$atastopikkhasone
			), 'id=:id', array(':id'=>12));
			
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas-topik-khas-2'],
				'style'=>$atastopikkhastwo
			), 'id=:id', array(':id'=>13));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas-topik-khas-3'],
				'style'=>$atastopikkhasthree
			), 'id=:id', array(':id'=>29));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['atas-topik-khas-4'],
				'style'=>$atastopikkhasfour
			), 'id=:id', array(':id'=>30));
			

			// tengah detail berita
			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['tengah-detail-berita'],
				'style'=>$tengahdetailberita
			), 'id=:id', array(':id'=>23));

			Yii::app()->db->createCommand()->update('module_iklan_options', array(
				'object_id'=>$_POST['Iklan']['bawah-detail-berita2'],
				'style'=>$bawahdetailberita2
			), 'id=:id', array(':id'=>26));
			
			Yii::app()->user->setFlash('success', "Pengaturan Iklan berhasil diubah");
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
