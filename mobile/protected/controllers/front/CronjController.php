<?php

class CronjController extends Controller
{
	public function actionIndex()
	{
		exit;
	}
	
	protected function beforeRender($action){
		if(!Yii::app()->mobileDetect->isMobile()){
			$this->redirect('http://www.bangsaonline.com'.Yii::app()->request->requestUri);
		}
		return true;
	}

	public function actionReset()
	{
		Yii::app()->cache->flush();

		exit;
	}

}