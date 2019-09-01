<?php

class PollingController extends Controller
{
	// check fucntion mobile page
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
		$criteria = new CDbCriteria;
		$criteria->with = array('choices');
		// $criteria->addCondition('active = "1"');
		// $criteria->addCondition('description.language_id = :language_id');
		// $criteria->params[':language_id'] = $this->languageID;
		$criteria->order = 't.id DESC';
		
		$dataPolling = new CActiveDataProvider('Poll2', array(
			'criteria'=>$criteria,
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));

		$jumlah_data = $dataPolling->getTotalItemCount();

		$this->render('index', array(
			'data'=>$dataPolling,
			'jum_data' => $jumlah_data,
		));
	}
	
	
	public function actionDetail($id,$slug)
	{	
		$id = abs((int) $id);

		if (isset($_POST['Poll2Vote'])) {
			
			$errorMessage = array();

			if (!isset($_POST['g-recaptcha-response'])) {
	            $errorMessage[] = '<b>Warning</b> Please Check Captcha for sending polling form!';
	        }
	        
	        $secret_key = "6Ld5HhYUAAAAAI6br07inNdbHsFeMjk6o8OETkUy";
	        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);

	        $response = json_decode($response);
	        if($response->success==false)
	        {
	            $errorMessage[] = '<b>Warning</b> Please Check Captcha for sending polling form!';
	        }else{
	        	// checking if he has voting same time
	        	$ip_cli = $_SERVER['REMOTE_ADDR'];
	        	$check_ipd = Poll2Vote::model()->find('ip_address=:ip_address AND poll_id=:poll_id', array(':ip_address'=>$ip_cli, ':poll_id'=>$id));
	        	if ( ($ip_cli == $check_ipd->ip_address) AND ($check_ipd->poll_id == $id)) {
	        		$errorMessage[] = '<b>Warning</b> Anda telah memberikan voting sebelumnya!';
	        	}else{
	        		// checking if he has voting same time
		        	$ip_cli = $_SERVER['REMOTE_ADDR'];
		        	$check_ipd = Poll2Vote::model()->find('ip_address=:ip_address AND poll_id=:poll_id', array(':ip_address'=>$ip_cli, ':poll_id'=>$id));
		        	if ( ($ip_cli == $check_ipd->ip_address) AND ($check_ipd->poll_id == $id)) {
		        		$errorMessage[] = '<b>Warning</b> Anda telah memberikan voting sebelumnya!';
		        	}else{
		        		// Save voting
			        	$errorMessage[] = '<b>Success</b> Thanks for sent polling form!';

						$vote = new Poll2Vote;
						$vote->attributes = $_POST['Poll2Vote'];
				      	$vote->poll_id = $id;

				      	$vote->save(false);
		        	}
	        	}
	        }
		}

		if(isset($_GET['slug'])){
			

			$slug = $_GET['slug'];

			$criteria = new CDbCriteria;
			$criteria->with = array('choices');
			$criteria->addCondition('t.id = '. $id);
			// $criteria->addSearchCondition('t.title', $slug, TRUE, "AND","LIKE");
			$dataPolling = Poll2::model()->find($criteria);
			$criteria->order = '`choices`.`id` DESC';

			$nilaiPolling = array();
			$total_votes = 0;
			$nilai_diambil = 0;

			foreach ($dataPolling->choices as $ky => $val) {
				$total_votes = $val->votes + $total_votes;
			}

			foreach ($dataPolling->choices as $ky => $val) {

					if ($dataPolling->rekayasa == 1) {
						$nilai_diambil = $val->jumlah_rekayasa;
						$suaran =  $val->jumlah_rekayasa;
					} else {
						$nilai_diambil = $val->votes;
						$suaran =  $val->votes;
					}

					if ($nilai_diambil != 0 OR $total_votes != 0) {
						$nilai_diambil = ($nilai_diambil / $total_votes) * 100;
						$nilai_diambil = number_format($nilai_diambil, 2);
					}else{
						$nilai_diambil = 0;
					}

					$nilaiPolling[] = array(
						'title_s' => $val->label,
						'image' =>  $val->image,
						'nilai' => $nilai_diambil,
						'bar_persentase' => $nilai_diambil,
						'suara'=> $suaran,
						);

					$nilai_diambil = 0;
			}

			$data = array(
				'judul' => $dataPolling->title,
				'tanggal_1' => $dataPolling->date_input,
				'tanggal_2' => $dataPolling->date_end,
				'status' => $dataPolling->status,
				'list_pil' => $dataPolling->choices,
				'nilai_polling' => $nilaiPolling,
				);

			if( !empty($data) ) {
				$this->render('detail', array(
					'data' => $data,
					'errorMessage' => isset($errorMessage)? $errorMessage:'',
					));
			}else{
				throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
			}
		}else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}

		// $this->render('detail');
	}



}