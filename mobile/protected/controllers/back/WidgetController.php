<?php

class WidgetController extends RController
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
	
	public function actionAddSeparator(){
		if(Yii::app()->request->isAjaxRequest){
			if(isset($_POST['ajaxPost'])){
				$z = $_POST['ajaxPost'];
				$z = explode('-', $z);
				$z = end($z);
				$forbiddenRoot = Widget::model()->findByPk(1);
				$widget = new Widget;
				$widget->widget_name = "Pemisah";
				$widget->widget_type = "separator";
				$widget->widget_group_id = $z;
				$widget->appendTo($forbiddenRoot);
				$widget->saveNode();
				$xxx = $widget->primaryKey;
				echo json_encode(array('a'=>true, 'b'=>$xxx));
			}
			else{
				echo json_encode(false);
			}
		
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxAddItem(){
		if(Yii::app()->request->isAjaxRequest){
			//z = id
			//y = text
			//x = class
			//w = tipe
			//v = activated
			$z = $_POST['addItem'];
			foreach($z as $y){
				if( ($y['w'] == "category") || ($y['w'] == "iklan") ){
					$z = explode('-', $y['v']);
					$z = end($z);
					$forbiddenRoot = Widget::model()->findByPk(1);
					$widget = new Widget;
					$widget->widget_name = $y['y'];
					$widget->widget_type = $y['w'];
					$widget->object_id = $y['z'];
					$widget->widget_style = 1;
					$widget->widget_group_id = $z;
					$widget->appendTo($forbiddenRoot);
					$widget->saveNode();
					$xxx = $widget->primaryKey;
					echo json_encode(array('a'=>true, 'b'=>$xxx));
				}
				else{
					echo json_encode(array('a'=>false));
				}
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxRemoveItem(){
		if(Yii::app()->request->isAjaxRequest){
			//v = konten id
			//w = tipe
			//x = class
			//y = text
			//z = id
			$z = $_POST['removeItem'];
			$widget = Widget::model()->findByPk($z);
			if(count($widget) > 0){
				$widget->deleteNode();
				echo json_encode(true);
			}
			else{
				echo json_encode(false);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxHomeWidget(){
		if(Yii::app()->request->isAjaxRequest){
			$z = $_POST['ajaxPost'];
			foreach($z as $y){
				//a = konten id
				//b = class
				//c = text
				//d = active
				//e = id
				//f = type
				//g = style
				if(!isset($y['g']))
					$y['g'] = 0;
					
					if(isset($parentRootBefore)){
						if( ($y['f'] == "category") || ($y['f'] == "iklan") ){
							$widgetNow = Widget::model()->findByPk($y['a']);
							$parentRootNow = Widget::model()->findByPk($parentRootBefore);
							$widgetNow->widget_name = trim($y['c']);
							$widgetNow->widget_type = $y['f'];
							$widgetNow->object_id = $y['e'];
							$widgetNow->widget_style = $y['g'];
							$widgetNow->moveAfter($parentRootNow);
							$widgetNow->saveNode();
							$parentRootBefore = $y['a'];
						}
						elseif( $y['f'] == "separator" ){
							$widgetNow = Widget::model()->findByPk($y['a']);
							$parentRootNow = Widget::model()->findByPk($parentRootBefore);
							$widgetNow->widget_name = "Pemisah";
							$widgetNow->widget_type = "separator";
							$widgetNow->widget_style = $y['g'];
							$widgetNow->moveAfter($parentRootNow);
							$widgetNow->saveNode();
							$parentRootBefore = $y['a'];
						}
						else{
							echo json_encode(false);
						}
					}
					else{
						if( ($y['f'] == "category") || ($y['f'] == "iklan") ){
							$widgetNow = Widget::model()->findByPk($y['a']);
							$forbiddenRoot = Widget::model()->findByPk(1);
							$widgetNow->widget_name = trim($y['c']);
							$widgetNow->widget_type = $y['f'];
							$widgetNow->object_id = $y['e'];
							$widgetNow->widget_style = $y['g'];
							$widgetNow->moveAsFirst($forbiddenRoot);
							$widgetNow->saveNode();
							$parentRootBefore = $y['a'];
						}
						elseif( $y['f'] == "separator" ){
							$widgetNow = Widget::model()->findByPk($y['a']);
							$forbiddenRoot = Widget::model()->findByPk(1);
							$widgetNow->widget_name = "Pemisah";
							$widgetNow->widget_type = "separator";
							$widgetNow->widget_style = $y['g'];
							$widgetNow->moveAsFirst($forbiddenRoot);
							$widgetNow->saveNode();
							$parentRootBefore = $y['a'];
						}
						else{
							echo json_encode(false);
						}
					}
			}
			echo json_encode(true);
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/wegeta.js', CClientScript::POS_END);
		
		$this->render('index');
	}

	/**
	 * Performs the AJAX validation.
	 * @param Menu $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
