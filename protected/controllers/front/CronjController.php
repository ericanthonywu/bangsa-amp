<?php

class CronjController extends Controller
{
	// check fucntion mobile page
	// protected function beforeRender($action){
	// 		if(Yii::app()->mobileDetect->isMobile()){
	// 			if(Yii::app()->request->getQuery('browsefrom') == "mobile"){
	// 				return true;
	// 			}
	// 			else{
	// 				$this->redirect('http://m.bangsaonline.com'.Yii::app()->request->requestUri);
	// 			}
	// 		}
	// 		else{
	// 			return true;
	// 		}
	// 	}

	public function actionReset()
	{
		Yii::app()->cache->flush();

		exit;
	}

	public function actionIndex()
	{
		$this->layout='//front/layouts/_blank';
		// script cronjob
		// Query check yang sudah ada nama
		$tanggal_sistem = date("Y-m-d");

		$criteria = new CDbCriteria;
		$criteria->condition = '`status` = 1';
		$data2s = Poll2::model()->findAll($criteria);

		if (count($data2s) > 0){

			foreach ($data2s as $key => $value) {
				// proses lock
				$tanggal_end = date('Y-m-d', strtotime($value->date_end));

				// calculate 1 -> warna merah lock 2 hari
				$tg_sistem = explode('-', $tanggal_sistem);
			    $till = explode('-', $tanggal_end);
			    
			    $tg_sistem = gregoriantojd($tg_sistem[1], $tg_sistem[2], $tg_sistem[0]);
			    $till = gregoriantojd($till[1], $till[2], $till[0]);

		    	$days = ($till - $tg_sistem);
		    	// jika hasil 0 / -1 -> lock 0
		    	if ($days <= 0) {
			    	$updateLockStatus = Poll2::model()->findByPk($value->id);
			    	$updateLockStatus->status = 0;
			    	$updateLockStatus->save(false);
		    	}
			    // end proses lock status
			}		
		}

		exit;
	}


}