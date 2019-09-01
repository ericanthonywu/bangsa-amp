<?php

class ModulController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	protected function beforeRender(){
		$this->redirect('http://bangsaonline.com/kelola.php');
		return true;
	}
}