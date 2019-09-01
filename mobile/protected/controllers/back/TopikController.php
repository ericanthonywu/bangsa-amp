<?php

class TopikController extends RController
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
	
	public function actionAjaxEditCaption(){
		if(Yii::app()->request->isAjaxRequest){
			if(isset($_POST['editCaption'])){
				$z = $_POST['editCaption'];
				$y = $_POST['editCaptions'];
				$x = $_POST['editCaptionss'];
				$dxd = explode("-", $z);
				$file = Files::model()->findByPk($dxd[0]);
				$file->caption_title = $y;
				$file->caption_desc = $x;
				$file->save();
				echo json_encode(array('a'=>true));
			}
			elseif(isset($_POST['deleteAjax'])){
				$z = $_POST['deleteAjax'];
				$dxd = explode("-", $z);
				$file = Files::model()->findByPk($dxd[0]);
				if(is_file(getcwd()."/images/uploads/topikkhas/".$file->filename)){
					unlink(getcwd()."/images/uploads/topikkhas/".$file->filename);
				}
				$file->delete();
				echo json_encode(true);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionUpload() {
		if(Yii::app()->request->isPostRequest){
			Yii::import( "xupload.models.XUploadForm" );
			//Here we define the paths where the files will be stored temporarily
			
			$path = getcwd()."/images/uploads/topikkhas/";
			$publicPath = Yii::app( )->getBaseUrl( )."/images/uploads/topikkhas/";
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
							unlink( $path.$_GET["file"] );
							$fileModel = Files::model()->findByAttributes(array('filename'=>$_GET["file"], 'module_id'=>3));
							$fileModel->delete();
							if(Yii::app()->user->hasState('pageImages')){
								$dxd = Yii::app()->user->getState('pageImages');
								foreach($dxd as $k=>$dx){
									if($dx['filename'] == $_GET["file"]){
										unset($dxd[$k]);
									}
								}
								Yii::app()->user->setState('pageImages', $dxd);
							}
						}
					}
					echo json_encode( true );
				}
			} else {
				$model = new XUploadForm;
				$model->file = CUploadedFile::getInstance( $model, 'TKFile' );
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
						$img = new Files;
						$img->type = $model->mime_type;
						$img->name = $model->name;
						$img->filename = $filename;
						$img->caption_title = Yii::app()->request->getPost('page_caption_title', '');
						$img->caption_desc = Yii::app()->request->getPost('page_caption_description', '');
						$img->module_id = 3;
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
								"module_id" => "0",
								"file_uid" => $filename,
								"delete_url" => $this->createUrl( "upload", array(
									"_method" => "delete",
									"file" => $filename,
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
	 * Lists all models.
	 */
	public function actionIndex()
	{	
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/select2/select2.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/select2/select2.min.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/formcomponents.js', CClientScript::POS_END);
		$model = $this->loadModel(1);
		$modelN = new News;
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;
		
		if(isset($_POST['Topik'])){
		
			$model->attributes = $_POST['Topik'];
			if(isset($model->object_id)){
				$auh = $this->sanitizeThis($model->object_id);
				$zx = Yii::app()->db->createCommand("SELECT tag_name FROM tag WHERE tag_name = '$auh'")->queryRow();
				if(!$zx){
					Yii::app()->db->createCommand("INSERT INTO tag(tag_name, tag_title) VALUES('$auh', '$model->object_id')")->query();
				}
				$model->object_id = $auh;
			}
			
			if($model->save())
				$this->redirect(Yii::app()->createUrl('topik'));
		}
		
		$this->render('index',array(
			'model'=>$model,
			'photos'=>$photos
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TopikKhas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Topik::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TopikKhas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='topik-khas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	private function sanitizeThis($title){
        $title = strip_tags($title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
		$title = str_replace(array("'", "’", "’", "‘", "“","”", "„", ), "", $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
        $title = strtolower($title);
        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);
        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');
		return $title;
	}
}
