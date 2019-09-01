<?php

class AuthController extends Controller
{	
	
	protected function beforeRender($action){
		// if(!Yii::app()->mobileDetect->isMobile()){
		// 	$this->redirect('http://bangsaonline.com');
		// }
		return true;
	}
	
	public function actionForgot(){
		if(Yii::app()->user->isGuest){
			$model = new Users;
			$model->scenario = 'forgot';
			
			if(isset($_POST['Users'])){
				$model->attributes = $_POST['Users'];
				
				if($model->validate()){
					$userN = Users::model()->findByAttributes(array('email'=>$model->email));
					if($userN){
						$password = md5("azzamedia".$userN->password.microtime().$userN->username."azzamedia");
						$userN->password = md5($password);
						$userN->save();
						
						$mail = new YiiMailer();
						//$mail->clearLayout();//if layout is already set in config
						$mail->setTo($userN->email);
						//$mail->setTo(array('xxx@qq.com'=>'Scott QQ','WWSP_NOREPLY@qq.com'=>'WWSP QQ'));
						//$mail->setCC('xxx@gmail.com');
						$mail->setSubject('Lupa Password Bangsa Online');
						$mail->setBody("Halo {$userN->username}<br />Password baru mu adalah $password");
						//$mail->setAttachment(array('something.pdf'=>'Some file','something_else.pdf'=>'Another file'));
						$mail->IsSMTP();
						if ($mail->send()) {} else {}
						
						Yii::app()->user->setFlash('success', "Terimakasih, silakan cek email anda untuk keterangan lebih lanjut");
						$this->redirect(Yii::app()->createUrl('auth/thankyou'));
					}
					else{
						Yii::app()->user->setFlash('success', "Tidak ada email yang cocok");
						$this->redirect(Yii::app()->createUrl('auth/forgot'));
					}
				}
			}
			
			$this->render('forgot', array(
				'model'=>$model
			));
		}
		else{
			$this->redirect(Yii::app()->getBaseUrl(true));
		}
	}

	public function actionSettings()
	{	
		if(!Yii::app()->user->isGuest){
			$idU = Yii::app()->user->id;
			$sql = "SELECT username, firstname, lastname, email, password FROM users INNER JOIN profiles ON users.id=profiles.user_id WHERE users.id='$idU'";
			$sqlU = "SELECT filename FROM files WHERE user_id = '$idU' AND module_id = 5";
			$model = Yii::app()->db->createCommand($sql)->queryRow();
			$modelU = Yii::app()->db->createCommand($sqlU)->queryRow();
			if(isset($_POST['Auth'])){
			
				if($_POST['Auth']['password'] == ""){
					$pwd = $model['password'];
				}
				else{
					$pwd = $_POST['Auth']['password'];
					$pwd = md5($pwd);
				}
				
				if($_POST['Auth']['firstname'] == ""){
					$finame = $model['firstname'];
				}
				else{
					$finame = $_POST['Auth']['firstname'];
				}
				
				if($_POST['Auth']['lastname'] == ""){
					$lname = $model['lastname'];
				}
				else{
					$lname = $_POST['Auth']['lastname'];
				}
				
				if($_POST['Auth']['email'] == ""){
					$email = $model['email'];
				}
				else{
					$email = $_POST['Auth']['email'];
					if($_POST['Auth']['password'] != $_POST['Auth']['repassword']){
						Yii::app()->user->setFlash('warning', 'Password tidak cocok');
						$this->redirect(Yii::app()->getBaseUrl(true)."/auth/settings");
					}
					elseif($model['email'] != $_POST['Auth']['email']){
						$sql = "SELECT email FROM users WHERE email = :emil";
						$dor = Yii::app()->db->createCommand($sql);
						$dor->bindParam(":emil", $email, PDO::PARAM_STR);
						$doors = $dor->execute();
						if($doors > 0){
							Yii::app()->user->setFlash('warning', 'Email sudah digunakan');
							$this->redirect(Yii::app()->getBaseUrl(true)."/auth/settings");
						}
					}
					elseif(!$this->check_email_address($email)){
						Yii::app()->user->setFlash('warning', 'Email tidak valid');
						$this->redirect(Yii::app()->getBaseUrl(true)."/auth/settings");
					}
				}
				
				$fname = CUploadedFile::getInstanceByName('Auth[filename]');
				if($fname == null){
					$fname = $modelU['filename'];
				}
				else{
					if($fname->getSize() < 2000000){
						if($fname->getExtensionName() == 'jpg' || $fname->getExtensionName() == 'jpeg' || $fname->getExtensionName() == 'png'){
							$path = getcwd()."/images/uploads/user/";
							if(!is_dir($path)){
								mkdir($path);
								chmod($path, 0777);
							}
							if(is_file($path.$modelU['filename'])){
								unlink($path.$modelU['filename']);
								$sqlaw = "DELETE FROM files WHERE filename = '{$modelU['filename']}'";
								Yii::app()->db->createCommand($sqlaw)->query();
							}
							$fename = $fname->getName();
							$filename = md5( "azzm".$idU.microtime().$fename);
							$filename .= ".".$fname->getExtensionName();
							$type = $fname->getType();
							$fname->saveAs($path.$filename);
							$images = Yii::app()->image->load($path.$filename);
							$images->resize(150, 150)->quality(80)->save($path.$filename);
							$sqlew = "INSERT INTO files(module_id, user_id, name, filename, type, upload_date) VALUES('5', '$idU', '$fename', '$filename', '$type', NOW())";
							Yii::app()->db->createCommand($sqlew)->query();
						}
						else{
							Yii::app()->user->setFlash('warning', 'File yang diupload bukan gambar');
							$this->redirect(Yii::app()->getBaseUrl(true)."/auth/settings");
						}
					}
					else{
						Yii::app()->user->setFlash('warning', 'File gambar yang diupload terlalu besar');
						$this->redirect(Yii::app()->getBaseUrl(true)."/auth/settings");
					}
					
				}
				$sql = "UPDATE users SET email = :email, password = :pwd WHERE id='$idU'";
				$sql2 = "UPDATE profiles SET firstname = :finame, lastname=:lname WHERE user_id='$idU'";
				$query = Yii::app()->db->createCommand($sql);
				$query->bindParam(":email", $email, PDO::PARAM_STR);
				$query->bindParam(":pwd", $pwd, PDO::PARAM_STR);
				$query->query();
				$query2 = Yii::app()->db->createCommand($sql2);
				$query2->bindParam(":finame", $finame, PDO::PARAM_STR);
				$query2->bindParam(":lname", $lname, PDO::PARAM_STR);
				$query2->query();
				Yii::app()->user->setFlash('success', 'Data berhasil diperbarui');
				$this->redirect(Yii::app()->getBaseUrl(true)."/auth/settings");
			}
			$this->render('_settings', array(
				'aw'=>$model,
				'au'=>$modelU
			));
		}
		else{
			$this->redirect(Yii::app()->getBaseUrl(true));
		}
	}
	
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->getBaseUrl(true));
	}
	
	public function actionActivation($keygen){
		if(isset($keygen)){
			$tic = explode("-", $keygen);
			$sql = "SELECT username, email, lastname, firstname FROM users INNER JOIN profiles ON id = user_id WHERE activkey = :au AND id = :uh";
			$model = Yii::app()->db->createCommand($sql);
			$model->bindParam(":au", $tic[0], PDO::PARAM_STR);
			$model->bindParam(":uh", $tic[1], PDO::PARAM_STR);
			$zxzc = $model->queryAll();
			if(count($zxzc) > 0){
				$sqlr = "SELECT userid FROM authassignment WHERE userid = :auo";
				$modelz = Yii::app()->db->createCommand($sqlr);
				$modelz->bindParam(":auo", $tic[1], PDO::PARAM_STR);
				$zxzcz = $modelz->queryAll();
					if(count($zxzcz) <= 0){
						$sqlt = "INSERT INTO authassignment(itemname, userid) VALUES('Member', :uh)";
						$modelt = Yii::app()->db->createCommand($sqlt);
						$modelt->bindParam(":uh", $tic[1], PDO::PARAM_STR);
						$modelt->query();
					}
				$sqls = "UPDATE users SET status = 1 WHERE activkey = :auto AND id = :ih";
				$modelx = Yii::app()->db->createCommand($sqls);
				$modelx->bindParam(":auto", $tic[0], PDO::PARAM_STR);
				$modelx->bindParam(":ih", $tic[1], PDO::PARAM_STR);
				$zxzcx = $modelx->query();
				$this->render('_activation', array(
					'model'=>$zxzc
				));
			}
			else{
				throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
			}
		}else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionThankyou(){
		$this->render('thankyou');
	}
	
	private function check_email_address($email) {
		if(preg_match("^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})^", $email))
			return true;
		else
			false;
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