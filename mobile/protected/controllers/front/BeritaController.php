<?php

class BeritaController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	protected function beforeRender($action){
		if(!Yii::app()->mobileDetect->isMobile()){
			$this->redirect('http://www.bangsaonline.com'.Yii::app()->request->requestUri);
		}
		return true;
	}
	
	public function actionDetail($id,$slug)
	{	
		if(isset($_GET['slug'])){
			
			// cache
			$ids_c = abs( (int) $id);
			$berita_d_cache =Yii::app()->cache->get('berita_d_'.$ids_c);
			if($berita_d_cache===false)
			{
				$connection = Yii::app()->db;
				//$sql = "SELECT b.news_id,b.news_title,b.news_content,b.news_status,b.news_slug,b.news_author,b.news_date,b.news_modified,f.object_id,f.module_id,f.filename,f.caption_title,f.caption_desc FROM module_news b INNER JOIN `files` f ON(b.news_id=f.object_id) WHERE b.news_slug ='$slug' AND f.module_id='1'";			
				$sql 	= "SELECT * FROM module_news WHERE news_id ='$id' AND news_status = 1 AND news_type = 1";						
				$command	= $connection->createCommand($sql);
				$dataReader	= $command->queryRow();    

				Yii::app()->cache->set('berita_d_'.$ids_c, $dataReader, 1800);
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