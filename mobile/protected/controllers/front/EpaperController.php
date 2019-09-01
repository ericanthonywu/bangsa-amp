<?php

class EpaperController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	protected function beforeRender($action){
		if(!Yii::app()->mobileDetect->isMobile()){
			$this->redirect('http://bangsaonline.com');
		}
		return true;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}