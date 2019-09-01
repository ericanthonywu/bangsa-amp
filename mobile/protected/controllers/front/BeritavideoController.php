<?php

class BeritavideoController extends Controller
{
	
	protected function beforeRender($action){
		// if(!Yii::app()->mobileDetect->isMobile()){
		// 	$this->redirect('http://bangsaonline.com');
		// }
		return true;
	}
	
	public function actionIndex()
	{
		$page 	= (isset($_GET['page']) ? $_GET['page'] : 1);
		$limit 	= 5;	
			
		if($page !='0'){ $start = ($page - 1) * $limit; }else{ $start = 0; }
		
		// first 
		$sqlfirst = "SELECT * FROM view_latest_news WHERE news_type='3' AND news_status='1' ORDER BY news_id DESC LIMIT 1";			
		$dataReaderFirst	= Yii::app()->db->createCommand($sqlfirst)->queryRow();  
		$idfirst = $dataReaderFirst['news_id'];
		
		// all
		if(!empty($idfirst)){
			$sql = "SELECT * FROM view_latest_news WHERE news_id NOT IN($idfirst) AND news_type='3' AND news_status='1' ORDER BY news_id DESC LIMIT $start,$limit";				 
		}else{
			$sql = "SELECT * FROM view_latest_news WHERE news_type='3' AND news_status='1' ORDER BY news_id DESC LIMIT $start,$limit";	
		}
		$dataReader	= Yii::app()->db->createCommand($sql)->queryAll();   
				
		
		$count = "SELECT COUNT(news_id) AS postnum FROM view_latest_news WHERE news_type='3' AND news_status='1' ";  
		$datacount	= Yii::app()->db->createCommand($count)->queryRow();   
		
		// Pagination  
		$pages = new CPagination($datacount);
		$pages->setPageSize($limit);			

		if(!empty($dataReader)){		
			$this->render('index', array(
							'data' 		=> $dataReader,
							'datafirst' 		=> $dataReaderFirst,
							'item_count'=> $datacount['postnum'],
							'page_size' => $limit,
							'pages'		=> $pages,
			));
		}else{
			throw new CHttpException(404,'Maaf, Kategori yang anda cari tidak memiliki berita');
		}
	}
	
	public function actionDetail($id,$slug)
	{
		if(isset($_GET['slug'])){
			$id = intval($id);
			$connection = Yii::app()->db;		
			$sql 	= "SELECT news_id,news_title,news_content,news_status,news_slug,news_penulis,news_wartawan,news_author,news_date,news_modified,news_source,embed FROM view_latest_news WHERE news_id ='$id'";	
		
			$command	= $connection->createCommand($sql);
			$dataReader	= $command->queryRow();    

			if(!empty($dataReader)){		
				$this->render('detail', array('data' => $dataReader));
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