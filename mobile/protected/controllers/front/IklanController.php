<?php

class IklanController extends Controller
{
	public function actionIndex()
	{
		$page 	= (isset($_GET['page']) ? $_GET['page'] : 1);
		$limit 	= 5;
		if($page !='0'){ $start = ($page - 1) * $limit; }else{ $start = 0; }
		
		$sql 		= "SELECT * FROM module_iklan ORDER BY id DESC LIMIT $start,$limit";			
		$dataReader	= Yii::app()->db->createCommand($sql)->queryAll();
		
		$count 		= "SELECT COUNT(id) AS iklannum FROM module_iklan WHERE is_external = '0'";  
		$datacount	= Yii::app()->db->createCommand($count)->queryRow();   
		
		// Pagination  
		$pages = new CPagination($datacount);
		$pages->setPageSize($limit);
		
		if(!empty($dataReader)){		
				$this->render('index', array(
								'data' 		=> $dataReader,
								'item_count'=> $datacount['iklannum'],
								'page_size' => $limit,
								'pages'		=> $pages,
				));
		}else{
			throw new CHttpException(404,'Maaf, Kategori yang anda cari tidak memiliki berita');
		}
	}
	
	protected function beforeRender($action){
		// if(!Yii::app()->mobileDetect->isMobile()){
		// 	$this->redirect('http://bangsaonline.com');
		// }
		return true;
	}
	
	public function actionDetail($id)
	{
		$sql 		= "SELECT * FROM module_iklan WHERE id ='$id' ORDER BY id ";			
		$dataReader	= Yii::app()->db->createCommand($sql)->queryRow();
		
		$this->render('detail', array('data' => $dataReader) );
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