<?php
class NewsController extends RController
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
				if(is_file(getcwd()."/images/uploads/berita/700/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/700/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/berita/135x75/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/135x75/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/berita/100x100/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/100x100/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/berita/150x150/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/150x150/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/berita/340x170/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/340x170/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/berita/700x350/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/700x350/".$file->filename);
				}
				if(is_file(getcwd()."/images/uploads/berita/".$file->filename)){
					unlink(getcwd()."/images/uploads/berita/".$file->filename);
				}
				$file->delete();
				echo json_encode(true);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionTagAjax()
	{
		if(Yii::app()->request->isAjaxRequest){
			$z = $_POST['q'];
			$tagForms = Yii::app()->db->createCommand()->select('id, tag_name, tag_title')->from('tag u')->where("tag_name LIKE '%$z%'")->limit('10')->queryAll();
			if(count($tagForms)>0){
				foreach($tagForms as $tagForm){
					$arr[] = array("id"=>$tagForm['tag_name'], "text"=>$tagForm['tag_title']);
				}
				echo json_encode($arr);
			}
			else{
				$arr[] = array("id"=>'', "text"=>'');
				echo json_encode($arr);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionRunningAjax()
	{
		if(Yii::app()->request->isAjaxRequest){
			$z = $_POST['q'];
			$tagForms = Yii::app()->db->createCommand()->select('id, running_name')->from('running_news u')->where("running_name LIKE '%$z%'")->limit('10')->queryAll();
			if(count($tagForms)>0){
				foreach($tagForms as $tagForm){
					$arr[] = array("id"=>$tagForm['running_name'], "text"=>$tagForm['running_name']);
				}
				echo json_encode($arr);
			}
			else{
				$arr[] = array("id"=>'', "text"=>'');
				echo json_encode($arr);
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
			foreach($arrs as $id){
				$model = $this->loadModel($id);

				if($model->news_status != '3'){
					$model->news_status = '3';
					$model->azmcat="ASD";
					$model->save();
					Yii::app()->user->setFlash('success', 'Data berhasil di pindahkan ke sampah');
				}
				elseif($model->news_status == '3'){
					$files = Files::model()->findAllByAttributes(array('object_id'=>$id, 'module_id'=>1));
					foreach($files as $file){
						if(is_file(getcwd()."/images/uploads/berita/700/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/700/".$file->filename);
						}
						if(is_file(getcwd()."/images/uploads/berita/135x75/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/135x75/".$file->filename);
						}
						if(is_file(getcwd()."/images/uploads/berita/100x100/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/100x100/".$file->filename);
						}
						if(is_file(getcwd()."/images/uploads/berita/150x150/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/150x150/".$file->filename);
						}
						if(is_file(getcwd()."/images/uploads/berita/340x170/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/340x170/".$file->filename);
						}
						if(is_file(getcwd()."/images/uploads/berita/700x350/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/700x350/".$file->filename);
						}
						if(is_file(getcwd()."/images/uploads/berita/".$file->filename)){
							unlink(getcwd()."/images/uploads/berita/".$file->filename);
						}
						$file->delete();
					}
					$model->delete();
					Yii::app()->user->setFlash('success', 'Data berhasil di hapus');
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
			
			$path = getcwd()."/images/uploads/berita/";
			$publicPath = Yii::app( )->getBaseUrl( )."/images/uploads/berita/";
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
							if(is_file( $path."700/".$_GET["file"] )){
								unlink( $path."700/".$_GET["file"] );
							}
							if(is_file( $path."135x75/".$_GET["file"] )){
								unlink( $path."135x75/".$_GET["file"] );
							}
							if(is_file( $path."100x100/".$_GET["file"] )){
								unlink( $path."100x100/".$_GET["file"] );
							}
							if(is_file( $path."150x150/".$_GET["file"] )){
								unlink( $path."150x150/".$_GET["file"] );
							}
							if(is_file( $path."340x170/".$_GET["file"] )){
								unlink( $path."340x170/".$_GET["file"] );
							}
							if(is_file( $path."700x350/".$_GET["file"] )){
								unlink( $path."700x350/".$_GET["file"] );
							}
							if(is_file( $file )){
								unlink( $file );
							}
							$fileModel = Files::model()->findByAttributes(array('filename'=>$_GET["file"], 'module_id'=>1));
							$fileModel->delete();
						}
					}
					echo json_encode( true );
				}
			} else {
				$model = new XUploadForm;
				$model->file = CUploadedFile::getInstance( $model, 'newsfile' );
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
					
						Yii::import("ext.EPhpThumb.EPhpThumb");
						$thumb=new EPhpThumb();
						$thumb->init(); //this is needed
						
						//Move our file to our temporary dir
						//Instead of temporary dir, we moved it to exact dir
						$model->file->saveAs( $path.$filename );
						$images = Yii::app()->image->load($path.$filename);
						if(!is_dir($path."700")){
							mkdir($path."700");
							chmod( $path."700", 0644 );
						}
						
						if(!is_dir($path."150x150")){
							mkdir($path."150x150");
							chmod( $path."150x150", 0644 );
						}
						
						if(!is_dir($path."100x100")){
							mkdir($path."100x100");
							chmod( $path."100x100", 0644 );
						}
						
						if(!is_dir($path."340x170")){
							mkdir($path."340x170");
							chmod( $path."340x170", 0644 );
						}
						
						if(!is_dir($path."135x75")){
							mkdir($path."135x75");
							chmod( $path."135x75", 0644 );
						}
						
						if(!is_dir($path."700x350")){
							mkdir($path."700x350");
							chmod( $path."700x350", 0644 );
						}
						$images->resize(700, 350, Image::WIDTH)->quality(80)->save($path."700/".$filename);
						$images->resize(700, 350, Image::WIDTH)->quality(80)->save($path."700x350/".$filename);
						$images->resize(135, 350, Image::WIDTH)->quality(80)->save($path."135x75/".$filename);
						$images->resize(340, 350, Image::WIDTH)->quality(80)->save($path."340x170/".$filename);
						$thumb->create($path."700x350/".$filename)->adaptiveResize(700,350)->save($path."700x350/".$filename);
						$thumb->create($path.$filename)->adaptiveResize(100,100)->save($path."100x100/".$filename);
						$thumb->create($path.$filename)->adaptiveResize(150,150)->save($path."150x150/".$filename);
						$thumb->create($path."135x75/".$filename)->adaptiveResize(135,75)->save($path."135x75/".$filename);
						$thumb->create($path."340x170/".$filename)->adaptiveResize(340,170)->save($path."340x170/".$filename);
						$img = new Files;
						$img->type = $model->mime_type;
						$img->name = $model->name;
						$img->filename = $filename;
						$img->caption_title = Yii::app()->request->getPost('page_caption_title', '');
						$img->caption_desc = Yii::app()->request->getPost('page_caption_description', '');
						$img->module_id = 1;
						$img->object_id = $id;
						$img->user_id = Yii::app()->user->id;
						$img->save();
						$agz = $img->primaryKey;
						chmod( $path.$filename, 0777 );
						chmod( $path."100x100/".$filename, 0777 );
						chmod( $path."135x75/".$filename, 0777 );
						chmod( $path."340x170/".$filename, 0777 );
						chmod( $path."150x150/".$filename, 0777 );
						chmod( $path."700x350/".$filename, 0777 );
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
								"module_id" => "1",
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
							array( "error" => $model->getErrors( 'newsfile' ),
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
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/select2/select2.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/select2/select2.min.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/formcomponents.js', CClientScript::POS_END);
		$model=new News;
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			if(isset($_POST['Tag'])){
				$tagArr = array();
				$tagAsx = explode(',', $_POST['Tag']);
				foreach($tagAsx as $tag){
					$tag = $this->sanitizeThis($tag);
					array_push($tagArr, $tag);
				}
				$tagArrs = implode(',', $tagArr);
				$model->tags->addTags($tagArrs)->save();
			}			
			
			if(isset($_POST['Running'])){
				$runArr = array();
				$runAsx = explode(',', $_POST['Running']);
				foreach($runAsx as $tag){
					$run = $this->sanitizeThis($tag);
					array_push($runArr, $run);
				}
				$runArrs = implode(',', $runArr);
				$model->running->setTags($runArrs)->save();
			}
			
			if(isset($_POST['Category'])){
				$model->azmcat="ASD";
				$model->category->addTags(implode(',', $_POST['Category']))->save();
			}
			
			$model->attributes=$_POST['News'];
			if($model->save()){
				foreach($tagAsx as $tag){
					$tagged = $this->sanitizeThis($tag);
					Yii::app()->db->createCommand("UPDATE tag SET tag_title = '$tag' WHERE tag_name = '$tagged'")->query();
				}
				
				foreach($runAsx as $run){
					$runned = $this->sanitizeThis($run);
					Yii::app()->db->createCommand("UPDATE running_news SET running_title = '$run' WHERE running_name = '$runned'")->query();
				}
				$user = Yii::app()->user->id;
				$azx = $model->primaryKey;
				$sqlFile = "UPDATE files SET object_id = '$azx' WHERE module_id = 1 AND object_id = 0 AND user_id = '$user'";
				$fileModel = Yii::app()->db->createCommand($sqlFile)->query();
				Yii::app()->user->setFlash('success', "Berita berhasil ditambahkan");
				$this->redirect(Yii::app()->createUrl('news'));
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
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/select2/select2.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/select2/select2.min.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/formcomponents.js', CClientScript::POS_END);
		$model=$this->loadModel($id);
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['News']))
		{
			if(isset($_POST['Tag'])){
				$tagArr = array();
				$tagAsx = explode(',', $_POST['Tag']);
				foreach($tagAsx as $tag){
					$tag = $this->sanitizeThis($tag);
					array_push($tagArr, $tag);
				}
				$tagArrs = implode(',', $tagArr);
				$model->tags->setTags($tagArrs)->save();
			}		
			
			if(isset($_POST['Running'])){
				$runArr = array();
				$runAsx = explode(',', $_POST['Running']);
				foreach($runAsx as $tag){
					$run = $this->sanitizeThis($tag);
					array_push($runArr, $run);
				}
				$runArrs = implode(',', $runArr);
				$model->running->setTags($runArrs)->save();
			}
			
			if(isset($_POST['Category'])){
				$model->azmcat="ASD";
				$model->category->setTags(implode(',', $_POST['Category']))->save();
			}
				
			$model->attributes=$_POST['News'];
			$model->news_modified = new CDbExpression('NOW()');
			if($model->save()){
				foreach($tagAsx as $tag){
					$tagged = $this->sanitizeThis($tag);
					Yii::app()->db->createCommand("UPDATE tag SET tag_title = '$tag' WHERE tag_name = '$tagged'")->query();
				}
				
				foreach($runAsx as $run){
					$runned = $this->sanitizeThis($run);
					Yii::app()->db->createCommand("UPDATE running_news SET running_title = '$run' WHERE running_name = '$runned'")->query();
				}
				
				Yii::app()->user->setFlash('success', "Berhasil memperbarui berita");
				$this->redirect(Yii::app()->createUrl('news'));
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
		
		if(Yii::app()->request->isPostRequest){
		
			if($model->news_status != '3'){
				$model->news_status = '3';
				$model->azmcat="ASD";
				$model->save();
				Yii::app()->user->setFlash('success', 'Data berhasil di pindahkan ke sampah');
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
			elseif($model->news_status == '3'){
				$files = Files::model()->findAllByAttributes(array('object_id'=>$id, 'module_id'=>1));
				foreach($files as $file){
					if(is_file(getcwd()."/images/uploads/berita/700/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/700/".$file->filename);
					}
					if(is_file(getcwd()."/images/uploads/berita/135x75/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/135x75/".$file->filename);
					}
					if(is_file(getcwd()."/images/uploads/berita/100x100/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/100x100/".$file->filename);
					}
					if(is_file(getcwd()."/images/uploads/berita/150x150/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/150x150/".$file->filename);
					}
					if(is_file(getcwd()."/images/uploads/berita/340x170/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/340x170/".$file->filename);
					}
					if(is_file(getcwd()."/images/uploads/berita/700x350/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/700x350/".$file->filename);
					}
					if(is_file(getcwd()."/images/uploads/berita/".$file->filename)){
						unlink(getcwd()."/images/uploads/berita/".$file->filename);
					}
					$file->delete();
				}
				Yii::app()->user->setFlash('success', 'Data berhasil di hapus');
				$model->delete();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bulkactions.js');
		$model=new News('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['News']))
			$model->attributes = $_GET['News'];
			
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionTeenageFilter()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bulkactions.js');
		$model=new News('teenage');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['News']))
			$model->attributes = $_GET['News'];
			
		$this->render('_teenage',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function displayDate(){
		$sql = "SELECT news_date FROM module_news ORDER BY news_id ASC";
		$newsModel = Yii::app()->db->createCommand($sql)->queryAll();
		$z=1;
		$arr=array();
		foreach($newsModel as $newModel){
			if($z==1){
				$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($newModel['news_date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($newModel['news_date']));
				$tanggalPrevius = Yii::app()->dateFormatter->format("yyyy-MM",strtotime($newModel['news_date']));
				$z++;
			}
			elseif($z>1){
				if($tanggalPrevius == Yii::app()->dateFormatter->format("yyyy-MM",strtotime($newModel['news_date']))){
				}
				else{
					$arr[Yii::app()->dateFormatter->format("yyyy-MM",strtotime($newModel['news_date']))] = Yii::app()->dateFormatter->format("yyyy MMMM",strtotime($newModel['news_date']));
				}
			}
		}
		return $arr;
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
