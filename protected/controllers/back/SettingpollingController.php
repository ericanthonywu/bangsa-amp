<?php

class SettingpollingController extends RController
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
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    $model = new SettingPolling;
    //$this->performAjaxValidation($model);

    if (isset($_POST['SettingPolling'])) {
      $model->attributes = $_POST['SettingPolling'];

      if ($model->save()) {
        $this->redirect(array('index'));
      }
    }

    $this->render('create', array(
      'model' => $model,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id)
  {
    $model = $this->loadModel($id);
    //$this->performAjaxValidation($model);

    if (isset($_POST['SettingPolling'])) {
      $gambar = $model->gambar;//mengamankan nama file
      $model->attributes = $_POST['SettingPolling'];
      $model->gambar = $gambar;//mengembalikan nama file

      $gambar = CUploadedFile::getInstance($model,'gambar');//mengaktifkan upload file
      if(isset($gambar) AND $gambar->name !='' ){ //jika di edit
        $model->gambar = substr(md5(time()),0,5).'-'.$gambar->name;
        $gambar->saveAs(getcwd().'/images/uploads/banner_polling/'.$model->gambar);//upload file
      }

      if ($model->save()) {
        $this->redirect(array('index'));
      }
    }

    $this->render('update',array(
      'model'=>$model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id)
  {
    if(Yii::app()->request->isPostRequest)
    {
      // we only allow deletion via POST request
      $data_ban = $this->loadModel($id);
      @unlink(getcwd()."/images/uploads/banner_polling/".$data_ban->gambar);
      $data_ban->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if(!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }
    else
		throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex()
  {
    $model=new SettingPolling('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['SettingPolling']))
      $model->attributes=$_GET['SettingPolling'];
    
    $this->render('index',array(
      'model'=>$model,
    ));
  }

  /**
   * Export the results of a Poll.
   *
  public function actionExport($id)
  {
    $model = $this->loadModel($id);
    $exportForm = new PollExportForm($model);
    $cform = $exportForm->cform();

    if ($cform->submitted('submit') && $cform->validate()) {
      $exportForm->export(); 
    }

    $this->render('export', array(
      'model' => $model,
      'exportForm' => $exportForm, 
      'cform' => $cform,
    ));
  }*/

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id)
  {
    $model=SettingPolling::model()->findByPk($id);
    if($model===null)
		throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model)
  {
    if(isset($_POST['ajax']) && $_POST['ajax']==='settingpolling-form')
    {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}
