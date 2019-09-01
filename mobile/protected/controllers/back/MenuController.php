<?php

class MenuController extends RController
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
	
	
	//Ajax Desc.
	//a=Menu Title(bisa juga array)
	//b=Menu Url (Jika Ada)
	//c=ID dari data yang baru saja di masuk kan(bisa juga array)
	//d=jumlah data yang di masukkan
	//z=define ajax gagal atau berhasil
	public function actionAjaxMenuDelete(){
		if(Yii::app()->request->isAjaxRequest){
			$delMenu = Menu::model()->findByPk($_POST['ajaxDelMenu']);
			$delMenuChild = $delMenu->descendants()->findAll();
			if(count($delMenuChild) > 0){
				//Wait, you still have a child, we will set the message for you later
				echo json_encode(array('z'=>false));
			}
			else{
				//Ok, you can go delete the records
				echo json_encode(array('z'=>true));
				$delMenu->deleteNode();
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxPostCustomLinks(){
		if(Yii::app()->request->isAjaxRequest){
			if(isset($_POST['ajaxPostCustomLinks']) && isset($_POST['ajaxPostCompareable'])){
				if($_POST['ajaxPostCompareable'][0] != $_POST['ajaxPostCompareable'][1]){
					echo json_encode(array('z'=>false));
				}
				else{
					$xs = explode('-', $_POST['ajaxPostCompareable'][0]);
					$xp = explode('&', $_POST['ajaxPostCustomLinks']);
					$xss = explode('=', $xp[0]);
					$xps = explode('=', $xp[1]);
					
					$forbiddenRoot=Menu::model()->findByPk(1);
					$customLinks = new Menu;
					$customLinks->root = 1;
					$customLinks->menu_title = urldecode($xss[1]);
					$customLinks->menu_url = urldecode($xps[1]);
					$customLinks->menu_title_attribute = $xss[1];
					$customLinks->menu_type = "custom";
					$customLinks->group_id = $xs[1];
					$customLinks->appendTo($forbiddenRoot);
					echo json_encode(array('a'=>urldecode($xss[1]), 'b'=>urldecode($xps[1]), 'c'=>$customLinks->primaryKey, 'z'=>true));
				}
			}
			else{
				echo json_encode(array('z'=>false));
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxPostHalaman(){
		if(Yii::app()->request->isAjaxRequest){
			if(isset($_POST['ajaxPostHalaman']) && isset($_POST['ajaxPostCompareable'])){
				if($_POST['ajaxPostCompareable'][0] != $_POST['ajaxPostCompareable'][1]){
					echo json_encode(array('z'=>false));
				}
				else{
					$forbiddenRoot=Menu::model()->findByPk(1);
					$xs = explode('-', $_POST['ajaxPostCompareable'][0]);
					$xp = explode('&', $_POST['ajaxPostHalaman']);
					$tick=0;
					foreach($xp as $xps){
						$xpsd = explode('=', $xps);
							$ajaxHalaman = Page::model()->findByPk($xpsd[1]);
							$menuHalaman = new Menu;
							$menuHalaman->root = 1;
							$menuHalaman->menu_title = $ajaxHalaman->page_title;
							$menuHalaman->menu_url_id = $ajaxHalaman->page_id;
							$menuHalaman->menu_title_attribute = $ajaxHalaman->page_title;
							$menuHalaman->menu_type = "page";
							$menuHalaman->group_id = $xs[1];
							$menuHalaman->appendTo($forbiddenRoot);
							$arr[$tick] = $menuHalaman->primaryKey;
							$ars[$tick] = $ajaxHalaman->page_title;
							$tick++;
						
					}
					echo json_encode(array('a'=>$ars, 'b'=>'', 'c'=>$arr, 'd'=>count($xp), 'z'=>true));
				}
			}
			else{
				echo json_encode(array('z'=>false));
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxPostKategori(){
		if(Yii::app()->request->isAjaxRequest){
			if(isset($_POST['ajaxPostKategori']) && isset($_POST['ajaxPostCompareable'])){
				if($_POST['ajaxPostCompareable'][0] != $_POST['ajaxPostCompareable'][1]){
					echo json_encode(array('z'=>false));
				}
				else{
					$forbiddenRoot=Menu::model()->findByPk(1);
					$xs = explode('-', $_POST['ajaxPostCompareable'][0]);
					$xp = explode('&', $_POST['ajaxPostKategori']);
					$tick=0;
					foreach($xp as $xps){
						$xpsd = explode('=', $xps);
							$ajaxKategori = Category::model()->findByPk($xpsd[1]);
							$menuKategori = new Menu;
							$menuKategori->root = 1;
							$menuKategori->menu_title = $ajaxKategori->category_name;
							$menuKategori->menu_url_id = $ajaxKategori->category_id;
							$menuKategori->menu_title_attribute = $ajaxKategori->category_name;
							$menuKategori->menu_type = "category";
							$menuKategori->group_id = $xs[1];
							$menuKategori->appendTo($forbiddenRoot);
							$arr[$tick] = $menuKategori->primaryKey;
							$ars[$tick] = $ajaxKategori->category_name;
							$tick++;
					}
					echo json_encode(array('a'=>$ars, 'b'=>'', 'c'=>$arr, 'd'=>count($xp), 'z'=>true));
				}
			}
			else{
				echo json_encode(array('z'=>false));
			}
		}
		else{
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		}
	}
	
	public function actionAjaxMenuUpdate(){
		if(Yii::app()->request->isAjaxRequest){
			foreach($_POST['ajaxPostMenu'] as $menu){
				if($menu['parent_id'] == ''){
					$menu_id = (int)$menu['item_id'];
					$menuNow = Menu::model()->findByPk($menu_id);
					if(isset($parentRootBefore)){
						if(!isset($menu['url']))
							$menu['url'] = "";
								
						if(!isset($menu['value']))
							$menu['value'] = "";
								
						if(!isset($menu['title_attr']))
							$menu['title_attr'] = "";
							
						$parentRootNow = Menu::model()->findByPk($parentRootBefore);
						$menuNow->menu_title = $menu['value'];
						$menuNow->menu_title_attribute = $menu['title_attr'];
						$menuNow->menu_url = $menu['url'];
						$menuNow->moveAfter($parentRootNow);
						$menuNow->saveNode();
						$past_parent_id = 0;
						$past_child_id = 0;
						$parentRootBefore = $menu_id;
					}
					else{
						if(!isset($menu['url']))
							$menu['url'] = "";
								
						if(!isset($menu['value']))
							$menu['value'] = "";
								
						if(!isset($menu['title_attr']))
							$menu['title_attr'] = "";
							
						$forbiddenRoot = Menu::model()->findByPk(1);
						$menuNow->menu_title = $menu['value'];
						$menuNow->menu_title_attribute = $menu['title_attr'];
						$menuNow->menu_url = $menu['url'];
						$menuNow->moveAsFirst($forbiddenRoot);
						$menuNow->saveNode();
						$past_parent_id = 0;
						$past_child_id = 0;
						$parentRootBefore = $menu_id;
					}
				}
				elseif($menu['parent_id'] !='' && $menu['parent_id'] !='none'){
					$child_id = (int)$menu['item_id'];
					$parent_id = (int)$menu['parent_id'];
					$child_Now = Menu::model()->findByPk($child_id);
					$parent_Now = Menu::model()->findByPk($parent_id);
					if($past_parent_id != 0){
						if($past_parent_id == $parent_id){
						if(!isset($menu['url']))
							$menu['url'] = "";
								
						if(!isset($menu['title_attr']))
							$menu['title_attr'] = "";
								
						if(!isset($menu['value']))
							$menu['value'] = "";
								
							$childRootNow = Menu::model()->findByPk($past_child_id);
							$child_Now->menu_title = $menu['value'];
							$child_Now->menu_title_attribute = $menu['title_attr'];
							$child_Now->menu_url = $menu['url'];
							$child_Now->moveAfter($childRootNow);
							$child_Now->saveNode();
							$past_parent_id = $parent_id;
							$past_child_id = $child_id;
						}
						else{
							if(!isset($menu['url']))
								$menu['url'] = "";
								
							if(!isset($menu['value']))
								$menu['value'] = "";
								
							if(!isset($menu['title_attr']))
								$menu['title_attr'] = "";
								
							$childRootNow = Menu::model()->findByPk($parent_id);
							$child_Now->menu_title = $menu['value'];
							$child_Now->menu_title_attribute = $menu['title_attr'];
							$child_Now->menu_url = $menu['url'];
							$child_Now->moveAsLast($childRootNow);
							$child_Now->saveNode();
							$past_parent_id = $parent_id;
							$past_child_id = $child_id;
						}
					}
					else{
						if(!isset($menu['url']))
							$menu['url'] = "";
							if(!isset($menu['value']))
								$menu['value'] = "";
								
							if(!isset($menu['title_attr']))
								$menu['title_attr'] = "";
							
						$child_Now->menu_title = $menu['value'];
						$child_Now->menu_title_attribute = $menu['title_attr'];
						$child_Now->menu_url = $menu['url'];
						$child_Now->moveAsFirst($parent_Now);
						$child_Now->saveNode();
						$past_parent_id = $parent_id;
						$past_child_id = $child_id;
					}
				}
			}
			echo json_encode(array('z'=>true));
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
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jquery.nestable.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/form-nestable/nestedSortable.js', CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/amejanux.js', CClientScript::POS_END);
		
		$this->render('index');
	}

	/**
	 * Performs the AJAX validation.
	 * @param Menu $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
