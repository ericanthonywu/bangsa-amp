<?php

class DefaultController extends RController
{
	
	public function filters()
	{
		return array(
			'rights'
			/*'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request*/
		);
	}
	
	private $_model;
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('/user/index',array(
            'model'=>$model,
        ));
	}
	
	public function actionLogin()
	{
		$model=new User;
		$this->render('/user/login',array(
			'model'=>$model
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
					if($model->superuser == 1){
						Yii::app()->authManager->assign('Administrator',$model->primaryKey);
					}
					elseif($model->superuser == 0){
						Yii::app()->authManager->assign('Member',$model->primaryKey);
					}
				}
				$this->redirect(array('/user/default/index'));
			} else $profile->validate();
		}

		$this->render('/user/create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		$profile=$model->profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				
				if($model->save()){
					if($model->superuser == 1){
						$sql = "DELETE FROM authassignment WHERE userid = '$model->primaryKey'";
						$query = Yii::app()->db->createCommand($sql)->query();
						Yii::app()->authManager->assign('Administrator',$model->primaryKey);
					}
					elseif($model->superuser == 0){
						$sql = "DELETE FROM authassignment WHERE userid = '$model->primaryKey'";
						$query = Yii::app()->db->createCommand($sql)->query();
						Yii::app()->authManager->assign('Member',$model->primaryKey);
					}
				}
				$profile->save();
				$this->redirect(array('/user/default/index'));
			} else $profile->validate();
		}

		$this->render('/user/update',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			$profile->delete();
			$model->delete();
			$sql3 = "SELECT user_id, filename FROM files WHERE user_id = '$model->id'";
			$qqz = Yii::app()->db->createCommand($sql3)->queryRow();
			if(count($qqz)>0){
				$sql2 = "DELETE FROM files WHERE user_id = '$model->id' AND module_id = '5'";
				Yii::app()->db->createCommand($sql2)->query();
				if(is_file(getcwd()."/images/uploads/user/".$qqz['filename'])){
					unlink(getcwd()."/images/uploads/user/".$qqz['filename']);
				}
			}
			$sql = "DELETE FROM authassignment WHERE userid = '$model->id'";
			Yii::app()->db->createCommand($sql)->query();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/default/index'));
		}
		else
			throw new CHttpException(400,'Maaf, anda tidak diperbolehkan untuk melakukan hal itu, tolong jangan di ulangi lagi.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ada.');
		}
		return $this->_model;
	}

}