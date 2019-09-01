<?php

class ContentController extends RController
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
	
	public function actionAddSeparator(){
		if(Yii::app()->request->isAjaxRequest){
			$forbiddenRoot = Block::model()->findByPk(1);
			$block = new Block;
			$block->block_title = "Pemisah";
			$block->block_type = "separator";
			$block->appendTo($forbiddenRoot);
			$block->saveNode();
			$xxx = $block->primaryKey;
			$block->block_object_id = $xxx;
			$block->saveNode();
			echo json_encode(array('a'=>true, 'b'=>$xxx));
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxAddItem(){
		if(Yii::app()->request->isAjaxRequest){
			//t = fallback data-id
			//u = fallback googlechrome, cek apakah ini return "class", kalau iya, tipe yang dipakai adalah v, bukan w
			//v = tipe = google chrome
			//w = tipe = mozilla
			//x = class
			//y = text
			//z = data-id
			$z = $_POST['addItem'];
			foreach($z as $y){
				if($y['u'] == 'class'){ 
					$tipe_data = $y['v']; 
					$data_id = $y['t'];
				}
				else{
					$tipe_data = $y['w'];
					$data_id = $y['z'];
				}
				
				if( ($tipe_data == "category") || ($tipe_data == "iklan") ){
					$forbiddenRoot = Block::model()->findByPk(1);
					$block = new Block;
					$block->block_title = $y['y'];
					$block->block_type = $tipe_data;
					$block->block_object_id = $data_id;
					$block->block_style = 1;
					$block->appendTo($forbiddenRoot);
					$block->saveNode();
					$xxx = $block->primaryKey;
					echo json_encode(array('a'=>true, 'b'=>$xxx, 'c'=>$data_id, 'd'=>$tipe_data));
				}
				else{
					echo json_encode(array('a'=>false));
				}
				//a = berhasil atau gagal insert
				//b = new id
				//c = block data_id
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxRemoveItem(){
		if(Yii::app()->request->isAjaxRequest){
			//v = konten id
			//w = tipe
			//x = class
			//y = text
			//z = id
			$z = $_POST['removeItem'];
			$block = Block::model()->findByPk($z);
			if(count($block) > 0){
				$block->deleteNode();
				echo json_encode(true);
			}
			else{
				echo json_encode(false);
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxHomeBlock(){
		if(Yii::app()->request->isAjaxRequest){
			$z = $_POST['ajaxPost'];
			foreach($z as $y){
				//a = id
				//b = konten id
				//c = class
				//d = style
				//e = text
				//f = type
				if(!isset($y['d']))
					$y['d'] = 0;
					
					if(isset($parentRootBefore)){
						if( ($y['f'] == "category") || ($y['f'] == "iklan") ){
							$blockNow = Block::model()->findByPk($y['b']);
							$parentRootNow = Block::model()->findByPk($parentRootBefore);
							$blockNow->block_title = trim($y['e']);
							$blockNow->block_type = $y['f'];
							$blockNow->block_style = $y['d'];
							$blockNow->block_object_id = $y['a'];
							$blockNow->moveAfter($parentRootNow);
							$blockNow->saveNode();
							$parentRootBefore = $y['b'];
						}
						elseif( $y['f'] == "separator" ){
							$blockNow = Block::model()->findByPk($y['b']);
							$parentRootNow = Block::model()->findByPk($parentRootBefore);
							$blockNow->block_title = "Pemisah";
							$blockNow->block_type = "separator";
							$blockNow->moveAfter($parentRootNow);
							$blockNow->saveNode();
							$parentRootBefore = $y['b'];
						}
						else{
							echo json_encode(false);
						}
					}
					else{
						if( ($y['f'] == "category") || ($y['f'] == "iklan") ){
							$blockNow = Block::model()->findByPk($y['b']);
							$forbiddenRoot = Block::model()->findByPk(1);
							$blockNow->block_title = trim($y['e']);
							$blockNow->block_type = $y['f'];
							$blockNow->block_style = $y['d'];
							$blockNow->block_object_id = $y['a'];
							$blockNow->moveAsFirst($forbiddenRoot);
							$blockNow->saveNode();
							$parentRootBefore = $y['b'];
						}
						elseif( $y['f'] == "separator" ){
							$blockNow = Block::model()->findByPk($y['b']);
							$forbiddenRoot = Block::model()->findByPk(1);
							$blockNow->block_title = "Pemisah";
							$blockNow->block_type = "separator";
							$blockNow->moveAsFirst($forbiddenRoot);
							$blockNow->saveNode();
							$parentRootBefore = $y['b'];
						}
						else{
							echo json_encode(false);
						}
					}
			}
			echo json_encode(true);
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
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/gktgnr.js', CClientScript::POS_END);
		$this->render('index');
	}
	
}
