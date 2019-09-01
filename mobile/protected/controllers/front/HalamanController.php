<?php

class HalamanController extends Controller
{
	public function actionIndex(){
	
	}
	
	public function actionDetail($slug)
	{
		if(isset($_GET['slug'])){						
			$connection = Yii::app()->db;
			$sql 		= "SELECT * FROM page WHERE page_slug ='$slug' ";
			$command	= $connection->createCommand($sql);
			$dataReader	= $command->queryRow();   
			
			// Meta Tag 
				
			if(!empty($dataReader)){		
				$this->render('detail', array('data' => $dataReader ));
			}else{
				throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
			}
			
		}else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	protected function beforeRender($action){
		// if(!Yii::app()->mobileDetect->isMobile()){
		// 	$this->redirect('http://www.bangsaonline.com'.Yii::app()->request->requestUri);
		// }
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