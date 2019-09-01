<?php

class KanalController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	protected function beforeRender($action){
		if(!Yii::app()->mobileDetect->isMobile()){
			$this->redirect('http://www.bangsaonline.com');
		}
		return true;
	}
	
	public function actionDetail($slug)
	{
		if(isset($_GET['slug'])){
			
			$page 	= (isset($_GET['page']) ? $_GET['page'] : 1);
			$limit 	= 10;	
			
			if($page !='0'){ $start = ($page - 1) * $limit; }else{ $start = 0; }
			
			// cache
			$cac_slug = strtolower( trim($slug) );

			$kanal_cache =Yii::app()->cache->get('kanal_'.$cac_slug.'_'.$page);
			if($kanal_cache===false)
			{
				$sql = "SELECT c.category_id,c.category_slug,c.category_name,cr.*,b.news_id,b.news_title,b.news_content,b.news_slug,b.news_type,b.news_date,b.news_status,
					fls.caption_title,fls.caption_desc,fls.filename
				FROM `category_relationship` cr 
				INNER JOIN  `module_news` b ON(cr.post_id=b.news_id) 
				INNER JOIN `category` c ON(cr.category_id=c.category_id) 
				LEFT JOIN `files` fls ON(fls.object_id=b.news_id)
				WHERE c.category_slug= '$slug' AND b.news_status='1' AND b.news_type='1' AND fls.module_id = '1' ORDER BY b.news_id DESC LIMIT $start,$limit";			
				$dataReader	= Yii::app()->db->createCommand($sql)->queryAll();    
			Yii::app()->cache->set('kanal_'.$cac_slug.'_'.$page, $dataReader, 300);
			}else{
					$dataReader = $kanal_cache;
			}		
			
			// $count = "SELECT COUNT(c.category_id) AS postnum 
			// 		FROM `category_relationship` cr 
			// 		INNER JOIN  `module_news` b ON(cr.post_id=b.news_id) 
			// 		INNER JOIN `category` c ON(cr.category_id=c.category_id) 
			// 		LEFT JOIN `files` fls ON(fls.object_id=b.news_id)
			// 		WHERE c.category_slug= '$slug' AND b.news_status='1' AND b.news_type='1' AND fls.module_id = '1'";
			$count = "SELECT COUNT(b.category_id) AS postnum 
					FROM `view_kanal_news` b 
					WHERE b.category_slug= '$slug' AND b.news_status='1' AND b.news_type='1' AND b.module_id = '1'";
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
								'slug'	=> "/kanal/".$dataReader[0]['category_slug'],
								'feature_data' => $dataReader[0],
				));
			}else{
				throw new CHttpException(404,'Maaf, Kategori yang anda cari tidak memiliki berita');
			}
			
		}else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionWriter(){
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/delAjaxImages.js', CClientScript::POS_END);
		$model = new News();
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;
		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			$model->azmcat="ASD";
			$model->category->addTags(53)->save();
			$model->news_type = 1;
			$model->news_status = 4;
			if($model->save()){
				
				$mail = new YiiMailer();
				//$mail->clearLayout();//if layout is already set in config
				$mail->setTo('bangsaonline@gmail.com');
				//$mail->setTo(array('xxx@qq.com'=>'Scott QQ','WWSP_NOREPLY@qq.com'=>'WWSP QQ'));
				//$mail->setCC('xxx@gmail.com');
				$mail->setSubject('Kanal Teenage Journalism');
				$mail->setLayout('teenageJournalism');
				$mail->setData(array(
					'nama'=>$model->news_penulis,
					'judul'=>$model->news_title,
					'berita'=>$model->news_content
				));
				$mail->IsSMTP();
				if ($mail->send()) {} else {}
				
				$azx = $model->primaryKey;
				$user = Yii::app()->user->id;
				$sqlFile = "UPDATE files SET object_id = '$azx' WHERE module_id = 1 AND object_id = 0 AND user_id = '$user'";
				Yii::app()->db->createCommand($sqlFile)->query();
				Yii::app()->user->setFlash('success', "Terimakasih telah mengirim berita, secepatnya berita anda akan kami sunting.");
				$this->redirect(Yii::app()->createUrl('auth/thankyou'));
			}
		}
		
		$this->render('_writer', array(
			'photos'=>$photos,
			'model'=>$model
		));
	}
	
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
	
	public function actionUpload($id = 0){
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
				$model->file = CUploadedFile::getInstance( $model, 'journalismfile' );
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
							array( "error" => $model->getErrors( 'journalismfile' ),
						) ) );
						Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
							CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
						);
					}
				} else {
					throw new CHttpException( 500, "Gagal Upload File" );
				}
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