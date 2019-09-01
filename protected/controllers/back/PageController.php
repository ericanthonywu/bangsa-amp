<?php
class PageController extends RController
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
				if(is_file(getcwd()."/images/uploads/halaman/700/".$file->filename)){
					unlink(getcwd()."/images/uploads/halaman/700/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/halaman/".$file->filename)){
					unlink(getcwd()."/images/uploads/halaman/".$file->filename);
				}
				$file->delete();
				echo json_encode(true);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionDelActAjax()
	{
		if(Yii::app()->request->isAjaxRequest){
			$arrs = explode(',', trim($_POST['ajaxCall'], ','));
			$where = "";
			foreach($arrs as $k=>$id){
				if($k==0){
					$where.="WHERE menu_url_id = '$id'";
				}
				else{
					$where.=" OR menu_url_id = '$id'";
				}
			}
			
			$sqlMenu = "SELECT menu_id FROM menu $where AND menu_type = 'page'";
			$menuModel = Yii::app()->db->createCommand($sqlMenu)->queryAll();
			$menuUrl = Yii::app()->createUrl('menu');
			
			if( (count($menuModel) > 0) ){
				Yii::app()->user->setFlash('danger', "Halaman yang akan dihapus masih digunakan pada <a href='$menuUrl'>Menu Manager</a>");
			}
			else{
				foreach($arrs as $id){
					$model = $this->loadModel($id);

					if($model->page_status != '3'){
						$model->page_status = '3';
						$model->save();
						Yii::app()->user->setFlash('success', 'Data berhasil di pindahkan ke tempat sampah');
					}
					elseif($model->page_status == '3'){
						$files = Files::model()->findAllByAttributes(array('object_id'=>$id, 'module_id'=>0));
						foreach($files as $file){
							if(is_file(getcwd()."/images/uploads/halaman/700/".$file->filename)){
								unlink(getcwd()."/images/uploads/halaman/700/".$file->filename);
							}
							if(is_file(getcwd()."/images/uploads/halaman/".$file->filename)){
								unlink(getcwd()."/images/uploads/halaman/".$file->filename);
							}
							$file->delete();
						}
						$model->delete();
						Yii::app()->user->setFlash('success', 'Data berhasil di hapus');
					}
				}
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
			
			$path = getcwd()."/images/uploads/halaman/";
			$publicPath = Yii::app( )->getBaseUrl( )."/images/uploads/halaman/";
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
							unlink( $path."700/".$_GET["file"] );
							$fileModel = Files::model()->findByAttributes(array('filename'=>$_GET["file"], 'module_id'=>0));
							$fileModel->delete();
						}
					}
					echo json_encode( true );
				}
			} else {
				$model = new XUploadForm;
				$model->file = CUploadedFile::getInstance( $model, 'file' );
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
						//Instead of temporary dir, we moved it to exact dir
						$model->file->saveAs( $path.$filename );
						$images = Yii::app()->image->load($path.$filename);
						$images->resize(700, 700, Image::WIDTH)->quality(80)->save($path."700/".$filename);
						$img = new Files;
						$img->type = $model->mime_type;
						$img->name = $model->name;
						$img->filename = $filename;
						$img->caption_title = Yii::app()->request->getPost('page_caption_title', '');
						$img->caption_desc = Yii::app()->request->getPost('page_caption_description', '');
						$img->module_id = 0;
						$img->object_id = $id;
						$img->user_id = Yii::app()->user->id;
						$img->save();
						$agz = $img->primaryKey;
						chmod( $path.$filename, 0777 );
						chmod( $path."700/".$filename, 0777 );
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
								"module_id" => "0",
								"file_uid" => $filename,
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
							array( "error" => $model->getErrors( 'file' ),
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
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Page;
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			if($model->save()){
				$user = Yii::app()->user->id;
				$azx = $model->primaryKey;
				$sqlFile = "UPDATE files SET object_id = '$azx' WHERE module_id = 0 AND object_id = 0 AND user_id = '$user'";
				$fileModel = Yii::app()->db->createCommand($sqlFile)->query();
			
				Yii::app()->user->setFlash('success', "Halaman statis berhasil ditambahkan");
				$this->redirect(array('page/index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'photos'=>$photos,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			$model->page_template=CUploadedFile::getInstance($model, 'page_template');
			if($model->save()){
				Yii::app()->user->setFlash('success', "Berhasil memperbarui Halaman Statis");
				$this->redirect(array('page/index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'photos'=>$photos,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$status = Page::model()->findByAttributes(array('page_id'=>$id));
		if(Yii::app()->request->isPostRequest){
		
			$sqlMenu = "SELECT menu_id FROM menu WHERE menu_url_id = '$id' AND menu_type = 'page'";
			$menuModel = Yii::app()->db->createCommand($sqlMenu)->queryAll();
			$menuUrl = Yii::app()->createUrl('menu');
			
			if( (count($menuModel) > 0) ){
				Yii::app()->user->setFlash('danger', "Halaman yang akan dihapus masih digunakan pada <a href='$menuUrl'>Menu Manager</a>");
			}
			else{
				if($status->page_status != '3'){
					$model->page_status = '3';
					$model->save();
					Yii::app()->user->setFlash('success', 'Data berhasil di pindahkan ke sampah');
				}
				elseif($status->page_status == '3'){
						$files = Files::model()->findAllByAttributes(array('object_id'=>$id, 'module_id'=>0));
						foreach($files as $file){
							if(is_file(getcwd()."/images/uploads/halaman/700/".$file->filename)){
								unlink(getcwd()."/images/uploads/halaman/700/".$file->filename);
							}
							if(is_file(getcwd()."/images/uploads/halaman/".$file->filename)){
								unlink(getcwd()."/images/uploads/halaman/".$file->filename);
							}
							$file->delete();
						}
						$model->delete();
						Yii::app()->user->setFlash('success', 'Data berhasil di hapus');
				}
				Yii::app()->user->setFlash('danger', "Halaman berhasil dihapus");
			}
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
		$model = new Page('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Page']))
			$model->attributes = $_GET['Page'];
			
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Page the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Page::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Halaman tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Page $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function displayDate(){
		$pagesModel = Yii::app()->db->createCommand()->select('page_date')->from('page')->order('page_id ASC')->queryAll();
		$z=1;
		$arr=array();
		foreach($pagesModel as $pageModel){
			if($z==1){
				$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($pageModel['page_date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($pageModel['page_date']));
				$tanggalPrevius = Yii::app()->dateFormatter->format("yyyy-MM",strtotime($pageModel['page_date']));
				$z++;
			}
			elseif($z>1){
				if($tanggalPrevius == Yii::app()->dateFormatter->format("yyyy-MM",strtotime($pageModel['page_date']))){
				}
				else{
					$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($pageModel['page_date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($pageModel['page_date']));
				}
			}
		}
		return $arr;
	}
}
