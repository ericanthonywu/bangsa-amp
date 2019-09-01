<?php

class TagController extends Controller
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
	
	public function actionDetail($slug)
	{
		
		if(isset($_GET['slug'])){
			
			$page 	= (isset($_GET['page']) ? $_GET['page'] : 1);
			$limit 	= 10;	
			
			if($page !='0'){ $start = ($page - 1) * $limit; }else{ $start = 0; }
			
			
			$sql = "SELECT t.*,tr.*,b.news_id,b.news_title,b.news_content,b.news_slug,b.news_type,b.news_date,b.news_status FROM tag_relationship tr INNER JOIN module_news b ON(tr.post_id=b.news_id) INNER JOIN tag t ON(tr.tagId=t.id) WHERE t.tag_name= '$slug' AND b.news_status='1' AND b.news_type='1' ORDER BY b.news_id DESC LIMIT $start,$limit";			
			$dataReader	= Yii::app()->db->createCommand($sql)->queryAll();    
					
			 
			$count = "SELECT COUNT(t.id) AS postnum FROM tag_relationship tr INNER JOIN module_news b ON(tr.post_id=b.news_id) INNER JOIN tag t ON(tr.tagId=t.id) WHERE t.tag_name= '$slug' AND b.news_status='1' AND b.news_type='1'";  
			
			$datacount	= Yii::app()->db->createCommand($count)->queryRow();   
			
			// Pagination  
			$pages = new CPagination($datacount);
			$pages->setPageSize($limit);			

			if(!empty($dataReader)){		
				$this->render('detail', array(
								'data' 		=> $dataReader,
								'item_count'=> $datacount['postnum'],
								'page_size' => $limit,
								'pages'		=> $pages,
				));
			}else{
				throw new CHttpException(404,'Maaf, Kategori yang anda cari tidak memiliki berita');
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