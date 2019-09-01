<?php

class IklanController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights'
			/*'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request*/
		);
	}
	
	protected function beforeRender(){
		$this->redirect('http://bangsaonline.com/kelola.php');
		return true;
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 *
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	*/
	
	public function actionDelActAjax()
	{
		if(Yii::app()->request->isAjaxRequest){
			$where = "";
			$wher = "";
			$arrs = explode(',', trim($_POST['ajaxCall'], ','));
			foreach($arrs as $k=>$id){
				if($k==0){
					$where.="WHERE object_id = '$id'";
					$wher.="WHERE block_object_id = '$id'";
				}
				else{
					$where.=" OR object_id = '$id'";
					$wher.=" OR block_object_id = '$id'";
				}
			}
			
			$sqlWgt = "SELECT widget_id FROM widget $where AND widget_type = 'iklan'";
			$sqlBlk = "SELECT id FROM block $wher AND block_type = 'iklan'";
			$widgetModel = Yii::app()->db->createCommand($sqlWgt)->queryAll();
			$blockModel = Yii::app()->db->createCommand($sqlBlk)->queryAll();
			$wgtUrl = Yii::app()->createUrl('widget');
			$contentUrl = Yii::app()->createUrl('contentmanager');
			
			if( (count($blockModel) > 0) OR (count($widgetModel) > 0) ){
				Yii::app()->user->setFlash('danger', "Iklan yang akan dihapus masih digunakan pada <a href='$wgtUrl'>widget</a> atau <a href='$contentUrl'>content manager</a>");
			}
			else{
				foreach($arrs as $id){
					$model = $this->loadModel($id);
					$files = Files::model()->findAllByAttributes(array('object_id'=>$id, 'module_id'=>2));
					foreach($files as $file){
						if(is_file(getcwd()."/images/uploads/iklan/".$file->filename)){
							unlink(getcwd()."/images/uploads/iklan/".$file->filename);
						}
						$file->delete();
					}
					$model->delete();
				}
				Yii::app()->user->setFlash('success', 'Iklan berhasil di hapus');
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxEditCaption(){
		if(Yii::app()->request->isAjaxRequest){
			if(isset($_POST['editCaption'])){
				$z = $_POST['editCaption'];
				$y = $_POST['editCaptions'];
				$x = $_POST['editCaptionss'];
				$file = Files::model()->findByPk($z);
				$file->caption_title = $y;
				$file->caption_desc = $x;
				$file->save();
				echo json_encode(array('a'=>true));
			}
			elseif(isset($_POST['deleteAjax'])){
				$z = $_POST['deleteAjax'];
				$dxd = explode("-", $z);
				$file = Files::model()->findByPk($dxd[0]);
				if(is_file(getcwd()."/images/uploads/iklan/".$file->filename)){
					unlink(getcwd()."/images/uploads/iklan/".$file->filename);
				}
				$file->delete();
				echo json_encode(true);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionUpload($id = "") {
		if(Yii::app()->request->isPostRequest){
			Yii::import( "xupload.models.XUploadForm" );
			//Here we define the paths where the files will be stored temporarily
			
			$path = getcwd()."/images/uploads/iklan/";
			$publicPath = Yii::app( )->getBaseUrl( )."/images/uploads/iklan/";
			if(!is_dir($path)){
				mkdir($path);
				chmod($path, 0777);
			}
		 
			//This is for IE which doens't handle 'Content-type: application/json' correctly
			header( 'Vary: Accept' );
			if( isset( $_SERVER['HTTP_ACCEPT'] ) 
				&& (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
				header( 'Content-type: application/json' );
			} else {
				header( 'Content-type: text/plain' );
			}
		 
			//Here we check if we are deleting and uploaded file
			if( isset( $_GET["_method"] ) ) {
				if( $_GET["_method"] == "delete" ) {
					if( $_GET["file"][0] !== '.' ) {
						$file = $path.$_GET["file"];
						if( is_file( $file ) ) {
							unlink( $file );
							$fileModel = Files::model()->findByAttributes(array('filename'=>$_GET["file"], 'module_id'=>2));
							$fileModel->delete();
						}
					}
					echo json_encode( true );
				}
			} else {
				$model = new XUploadForm;
				$model->file = CUploadedFile::getInstance( $model, 'iklanfile' );
				//We check that the file was successfully uploaded
				if( $model->file !== null ) {
					//Grab some data
					$model->mime_type = $model->file->getType( );
					$model->size = $model->file->getSize( );
					$model->name = $model->file->getName( );
					//(optional) Generate a random name for our file
					$filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
					$filename .= ".".$model->file->getExtensionName( );
					if( $model->validate() ) {
						//Move our file to our temporary dir
						$model->file->saveAs( $path.$filename );
						$img = new Files;
						$img->type = $model->mime_type;
						$img->name = $model->name;
						$img->filename = $filename;
						$img->caption_title = Yii::app()->request->getPost('page_caption_title', '');
						$img->caption_desc = Yii::app()->request->getPost('page_caption_description', '');
						$img->module_id = 2;
						$img->object_id = $id;
						$img->user_id = Yii::app()->user->id;
						$img->save();
						$agz = $img->primaryKey;
						chmod( $path.$filename, 0777 );
						//here you can also generate the image versions you need 
						//using something like PHPThumb
		 
						//Now we need to tell our widget that the upload was succesfull
						//We do so, using the json structure defined in
						// https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
						echo json_encode( array( array(
								"name" => $model->name,
								"type" => $model->mime_type,
								"size" => $model->size,
								"url" => $publicPath.$filename,
								"thumbnail_url" => $publicPath."$filename",
								"ctitle"   => Yii::app()->request->getPost('page_caption_title', ''),
								"cdesc"   => Yii::app()->request->getPost('page_caption_description', ''),
								"files_id"	=> $agz,
								"module_id" => "2",
								"delete_url" => $this->createUrl( "upload", array(
									"_method" => "delete",
									"file" => $filename,
									"id"	=> $id,
								) ),
								"delete_type" => "POST"
							) ) );
					} else {
						//If the upload failed for some reason we log some data and let the widget know
						echo json_encode( array( 
							array( "error" => $model->getErrors( 'iklanfile' ),
						) ) );
						Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
							CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
						);
					}
				} else {
					throw new CHttpException( 500, "Gagal Upload File" );
				}
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' iklan.
	 */
	public function actionCreate()
	{
		$model=new Iklan;
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Iklan']))
		{
			$model->attributes=$_POST['Iklan'];
			$model->position=$_POST['Iklan']['position'];
			if($model->save()){
				$user = Yii::app()->user->id;
				$azx = $model->primaryKey;
				$sqlFile = "UPDATE files SET object_id = '$azx' WHERE module_id = 2 AND object_id = 0 AND user_id = '$user'";
				$fileModel = Yii::app()->db->createCommand($sqlFile)->query();
				Yii::app()->user->setFlash('success', "Iklan berhasil ditambahkan");
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'photos'=>$photos
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' iklan.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Iklan']))
		{
			$model->attributes=$_POST['Iklan'];
			$model->position=$_POST['Iklan']['position'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
			'photos'=>$photos
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' iklan.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){
			$sqlWgt = "SELECT widget_id FROM widget WHERE object_id = '$id' AND widget_type = 'iklan'";
			$sqlBlk = "SELECT id FROM block WHERE block_object_id = '$id' AND block_type = 'iklan'";
			$widgetModel = Yii::app()->db->createCommand($sqlWgt)->queryAll();
			$blockModel = Yii::app()->db->createCommand($sqlBlk)->queryAll();
			$wgtUrl = Yii::app()->createUrl('widget');
			$contentUrl = Yii::app()->createUrl('contentmanager');
			if( (count($blockModel) > 0) OR (count($widgetModel) > 0) ){
				Yii::app()->user->setFlash('danger', "Iklan yang akan dihapus masih digunakan pada <a href='$wgtUrl'>widget</a> atau <a href='$contentUrl'>content manager</a>");
			}
			else{
				$files = Files::model()->findAllByAttributes(array('object_id'=>$id, 'module_id'=>2));
				foreach($files as $file){
					if(is_file(getcwd()."/images/uploads/iklan/".$file->filename)){
						unlink(getcwd()."/images/uploads/iklan/".$file->filename);
					}
					$file->delete();
				}
				$this->loadModel($id)->delete();
				Yii::app()->user->setFlash('success', "Iklan berhasil dihapus");
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bulkactions.js');
		$model=new Iklan('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Iklan']))
			$model->attributes = $_GET['Iklan'];
			
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Iklan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Iklan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Iklan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='iklan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
