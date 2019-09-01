<?php

class CariController extends Controller
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
	
	public function actionKeyword($keyword)
	{
		if(isset($keyword)){
			if(isset($_GET['title'])){
				$g_title = htmlentities(htmlentities(Yii::app()->request->getParam('title'), ENT_QUOTES),ENT_QUOTES);
				$page 	= (isset($_GET['page']) ? $_GET['page'] : 1);
				$limit 	= 5;	
				
				if($page !='0'){ $start = ($page - 1) * $limit; }else{ $start = 0; }
				
				$zxc = $g_title;
				$urln = urlencode($zxc);
				$dxd = explode("+", $urln);
				$where = "";
				foreach($dxd as $k=>$dxs){
					if($k === 0){
						$where.="WHERE news_title LIKE '%$dxs%'";
					}
					else{
						$where.=" AND news_title LIKE '%$dxs%'"; 
					}
				}
				
				$sql = "SELECT a.news_id, a.news_title, a.news_content, a.news_excerpt, a.news_date, a.news_slug, b.comment_news_id, b.cc, x.filename FROM module_news as a LEFT JOIN (SELECT comment_news_id, count(comment_news_id) AS cc FROM comments GROUP BY comment_news_id) as b ON b.comment_news_id = a.news_id LEFT JOIN (SELECT filename, object_id,  module_id FROM files WHERE module_id = 1 GROUP BY object_id) as x ON a.news_id=x.object_id $where AND a.news_status = 1 AND a.news_type = 1 ORDER BY a.news_id DESC LIMIT $start,$limit";
				$query = Yii::app()->db->createCommand($sql)->queryAll();
				
				$sqq = "SELECT count(news_id) as asx FROM module_news $where";
				$queryx = Yii::app()->db->createCommand($sqq)->queryRow();
				
				// Pagination  
				$pages = new CPagination($query);
				$pages->setPageSize($limit);
				
				$this->render('_search', array(
					'model'=>$query,
					'item_count'=>$queryx['asx'],
					'page_size' => $limit,
					'pages'		=> $pages,
					'cari'		=> $zxc
				));
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