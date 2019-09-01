<?php

class KomentarController extends Controller
{
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
	
	public function actionLoadMoreComment()
	{
		if(Yii::app()->request->isAjaxRequest){
			$inds = $_POST['loadmore'];
			$sql = "SELECT comment_email, comment_content, comment_status, comment_date, username, lastname, firstname FROM comments as a INNER JOIN users as b ON a.comment_user_id=b.id INNER JOIN profiles as c ON a.comment_user_id=c.user_id WHERE comment_news_id = :bgt AND comment_status = 1 LIMIT 5";
			$querySql = Yii::app()->db->createCommand($sql);
			$querySql->bindValue(":bgt",$inds,PDO::PARAM_STR);
			$cons = $querySql->queryAll();
			$arr = array();
			foreach($cons as $k=>$con){
				$arr[$k]['fname']=$con['firstname'];
				$arr[$k]['lname']=$con['lastname'];
				$arr[$k]['date']=$con['comment_date'];
				$arr[$k]['comment']=get_time($con['comment_content'],"dd MMMM yyyy | HH:MM","yes");
			}
			echo json_encode(array('a'=>$arr));
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionKomentar($id){
		if(Yii::app()->request->isPostRequest){
			$sql = "SELECT news_id, news_slug FROM module_news WHERE news_id=:agile";
			$newsSql = Yii::app()->db->createCommand($sql);
			$newsSql->bindValue(":agile", $id, PDO::PARAM_STR);
			$const = $newsSql->queryRow();
			$slug = $const['news_slug'];
			if(count($const) > 0){
				$user = Yii::app()->user->id;
				$komentar = $_POST['Komentar']['text'];
				if($komentar != ""){
					$newsSql = "INSERT INTO comments(comment_news_id, comment_content, comment_date, comment_status, comment_user_id) VALUES (:agitated, :agate, NOW(), 0, '$user')";
					$newsModel = Yii::app()->db->createCommand($newsSql);
					$newsModel->bindParam(":agitated", $id, PDO::PARAM_STR);
					$newsModel->bindParam(":agate", $komentar, PDO::PARAM_STR);
					$const = $newsModel->query();
					
					Yii::app()->user->setFlash('success', 'Komentar anda berhasil dikirim, silakan menunggu moderasi.');
					$this->redirect(array('berita/'.$id.'/'.$slug));
				}
				else{
					Yii::app()->user->setFlash('success', 'Kolom komentar harus diisi');
					$this->redirect(array('berita/'.$id.'/'.$slug));
				}
			}
			else{
				throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');	
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
}