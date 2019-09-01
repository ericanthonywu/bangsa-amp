<?php

class ContactController extends RController
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		Yii::app()->db->createCommand()
			->update('contact', 
				array('is_read'=>1),
				'id=:id',
				array(':id'=>$id)
			);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCreate($id)
	{
			$model=new Contact;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Contact']))
			{
				$model->attributes=$_POST['Contact'];
				if($model->save())
					$this->redirect(array('contact/sent'));
			}
			
			$this->render('create',array(
				'model'=>$model,
				'parameter'=>$this->loadModel($id),
			));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	public function actionSent()
	{
		$model=new Contact('search');
		$model->dbCriteria->order='id DESC';
		$model->dbCriteria->compare('type','send');
		$model->unsetAttributes();  // clear any default values
		$this->render('index',array(
			'dataProvider'=>$model,
			'type'=>'send'
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Contact('search');
		$model->dbCriteria->order='id DESC';
		$model->dbCriteria->compare('type','receive');
		$model->unsetAttributes();  // clear any default values
		$this->render('index',array(
			'dataProvider'=>$model,
			'type'=>'receive'
		));
	}
	
	/**
	 *Encode Decode bagian email
	 *
	private function decode_encode(){
		$myVarIWantToEncodeAndDecode = 'Bklha!';
		$encoded = strtr(base64_encode($variable), '+/', '-_');
		echo $encoded.'<br>';
		$decoded = base64_decode(strtr($encoded, '-_', '+/'));
		echo $decoded;
	}**/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
