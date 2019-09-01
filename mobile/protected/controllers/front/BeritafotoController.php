<?php

class BeritafotoController extends Controller
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
	
	public function actionDetail($id,$slug)
	{	
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/scripts/responsiveslides.min.js',CClientScript::POS_END);
		if(isset($_GET['slug'])){
			
			// cache
			$ids_c = abs( (int) $id);
			$berita_d_cache =Yii::app()->cache->get('berita_d_'.$ids_c);
			if($berita_d_cache===false)
			{
				$connection = Yii::app()->db;		
				$sql 	= "SELECT news_id,news_title,news_content,news_status,news_slug,news_penulis,news_wartawan,news_author,news_date,news_modified,news_source FROM module_news WHERE news_id ='$id' AND news_status = 1 AND news_type = 2";						
				$command	= $connection->createCommand($sql);
				$dataReader	= $command->queryRow();    
				Yii::app()->cache->set('berita_d_'.$ids_c, $dataReader, 300);
			}else{
				$dataReader = $berita_d_cache;
			}
			
			if(!empty($dataReader)){		
				$this->render('detail', array('data' => $dataReader, 'slugid'=>$dataReader['news_id']."/".$dataReader['news_slug']));
			}else{
				throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
			}

		}else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
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