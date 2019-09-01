<?php

class IndeksController extends Controller
{
	
	protected function beforeRender($action){
		if(Yii::app()->mobileDetect->isMobile()){
			if(Yii::app()->request->getQuery('browsefrom') == "mobile"){
				return true;
			}
			else{
				$this->redirect('http://m.bangsaonline.com'.Yii::app()->request->requestUri);
			}
		}
		else{
			return true;
		}
	}
	
	public function actionIndex()
	{
		// $sql = "SELECT category_name, category_id, category_slug FROM category WHERE is_indeks=1 AND active=1 ORDER BY category_id ASC";
		$sql = "SELECT * FROM `categorys_indeks`";
		$dataindeks	= Yii::app()->db->createCommand($sql)->queryAll();	
		$tgl = date("d");
		$bulan=date("m");
		$tahun=date("Y");
		$kanal="%";
		if(isset($_POST['Filter'])){
			if(isset($_POST['Filter']['Tgl'])){
				$tgl = $_POST['Filter']['Tgl'];
				if(strlen($tgl) < 2){
					$tgl = "0".$tgl;
				}
			}
				
			if(isset($_POST['Filter']['Bulan']))
				$bulan = $_POST['Filter']['Bulan'];
				
			if(isset($_POST['Filter']['Tahun']))
				$tahun = $_POST['Filter']['Tahun'];
				
			if(isset($_POST['Filter']['Kanal'])){
				$kanal=$_POST['Filter']['Kanal'];
				if($kanal == ""){
					$kanal = "%";
				}
			}
		}
		// var_dump($dataindeks); exit;
		$this->render('index', array(
			'allCat'=>$dataindeks,
			'tanggal'=>$tgl,
			'bulan'=>$bulan,
			'tahun'=>$tahun,
			'kanal'=>$kanal
		));
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