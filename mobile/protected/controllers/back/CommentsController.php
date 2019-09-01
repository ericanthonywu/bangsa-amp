<?php

class CommentsController extends RController
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
	
	public function actionDelActAjax()
	{
		if(Yii::app()->request->isAjaxRequest){
			$arrs = explode(',', trim($_POST['ajaxCall'], ','));
			foreach($arrs as $id){
				$model = $this->loadModel($id);
				$model->delete();
			}
			Yii::app()->user->setFlash('success', 'Data berhasil di hapus');
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxApproveThis()
	{
		if(Yii::app()->request->isAjaxRequest){
			$adhesive = $_POST['approve'];
			$adhesives = $_POST['thisthat'];
			$adh = "";
			if($adhesives == 1){
				$adh = 0;
			}
			elseif($adhesives == 0){
				$adh = 1;
			}
			$sql = "UPDATE comments SET comment_status = :adhesive WHERE comment_id = :addictive";
			$model = Yii::app()->db->createCommand($sql);
			$model->bindParam(":adhesive", $adh, PDO::PARAM_STR);
			$model->bindParam(":addictive", $adhesive, PDO::PARAM_STR);
			$model->query();
			echo json_encode( array( 'a'=>true, 'b'=>$adh ) );
			
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bulkactions.js');
		$model=new Comments('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Comments']))
			$model->attributes = $_GET['Comments'];
			
		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdate($id){
		$sql = "SELECT comment_content, comment_date, username, comment_news_id FROM comments LEFT JOIN users ON comment_user_id=id WHERE comment_id = '$id'";
		$model = Yii::app()->db->createCommand($sql)->queryRow();
	
		$this->render('baca',array(
			'modelx'=>$model,
		));
	} 

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comments the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comments $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function displayDate(){
		$commentsModel = Yii::app()->db->createCommand()->select('comment_date')->from('comments')->order('comment_id ASC')->queryAll();
		$z=1;
		$arr=array();
		foreach($commentsModel as $commentModel){
			if($z==1){
				$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($commentModel['comment_date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($commentModel['comment_date']));
				$tanggalPrevius = Yii::app()->dateFormatter->format("yyyy-MM",strtotime($commentModel['comment_date']));
				$z++;
			}
			elseif($z>1){
				if($tanggalPrevius == Yii::app()->dateFormatter->format("yyyy-MM",strtotime($commentModel['comment_date']))){
				}
				else{
					$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($commentModel['comment_date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($commentModel['comment_date']));
				}
			}
		}
		return $arr;
	}
	
}
