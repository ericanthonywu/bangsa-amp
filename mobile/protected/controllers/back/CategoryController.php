<?php

class CategoryController extends RController
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
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			if(isset($_POST['Category']))
		{
			$category=new Category;
			if($_POST['Category']['root'] != ''){
				$category->category_name=$_POST['Category']['category_name'];
				$category->category_description=$_POST['Category']['category_description'];
				$category->active=$_POST['Category']['active'];
				$category->is_indeks=$_POST['Category']['is_indeks'];
				//$category->module_id=$_POST['Category']['module_id'];
				$root=Category::model()->findByPk($_POST['Category']['root']);
				$category->appendTo($root);
					Yii::app()->user->setFlash('success', "Kategori berhasil ditambahkan");
			}
			else{
				$category->category_name=$_POST['Category']['category_name'];
				$category->category_description=$_POST['Category']['category_description'];
				$category->active=$_POST['Category']['active'];
				$category->is_indeks=$_POST['Category']['is_indeks'];
				//$root->module_id=$_POST['Category']['module_id'];
				$category->saveNode();
					Yii::app()->user->setFlash('success', "Kategori berhasil ditambahkan");
			}
			$this->redirect(array('category/index'));
		}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$category=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Category']))
		{	
			if($_POST['Category']['root'] == ''){
				$category->category_name=$_POST['Category']['category_name'];
				$category->category_description=$_POST['Category']['category_description'];
				$category->active=$_POST['Category']['active'];
				$category->is_indeks=$_POST['Category']['is_indeks'];
				$category->saveNode();
				$this->callEdit($id, $_POST['Category']['category_name']);
			}
			elseif($_POST['Category']['root'] == 'beroot'){
				$category->category_name=$_POST['Category']['category_name'];
				$category->category_description=$_POST['Category']['category_description'];
				$category->active=$_POST['Category']['active'];
				$category->is_indeks=$_POST['Category']['is_indeks'];
				$category->saveNode();
				$category->moveAsRoot();
				$this->callEdit($id, $_POST['Category']['category_name']);
			}
			else{
				$root = Category::model()->findByPk($_POST['Category']['root']);
				$rootdescendant = Category::model()->findByPk($category->category_id);
				$category->category_name=$_POST['Category']['category_name'];
				$category->category_description=$_POST['Category']['category_description'];
				$category->active=$_POST['Category']['active'];
				$category->is_indeks=$_POST['Category']['is_indeks'];
				$category->saveNode();
				$category->moveAsLast($root);
				$this->callEdit($id, $_POST['Category']['category_name']);
				$category_descendants = $category->descendants()->findAll();
				foreach($category_descendants as $category_descendant ){
					$catdescendant = Category::model()->findByPk($category_descendant->category_id);
					$catancestor = $catdescendant->parent()->find();
					if( count($catancestor) > 0 ){
						$catdescendant->moveAsLast($catancestor);
					}
					else{
						$catdescendant->moveAsLast($rootdescendants);
					}
				}
			}
			Yii::app()->user->setFlash('success', "Kategori berhasil diperbarui");
			$this->redirect(array('category/index'));
		}

		$this->render('update',array(
			'model'=>$category,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{	
		$sqlWgt = "SELECT widget_id FROM widget WHERE object_id = '$id' AND widget_type = 'category'";
		$sqlBlk = "SELECT id FROM block WHERE block_object_id = '$id' AND block_type = 'category'";
		$sqlMenu = "SELECT menu_id FROM menu WHERE menu_url_id = '$id' AND menu_type = 'category'";
		$widgetModel = Yii::app()->db->createCommand($sqlWgt)->queryAll();
		$blockModel = Yii::app()->db->createCommand($sqlBlk)->queryAll();
		$menuModel = Yii::app()->db->createCommand($sqlMenu)->queryAll();
		$wgtUrl = Yii::app()->createUrl('widget');
		$contentUrl = Yii::app()->createUrl('contentmanager');
		$menuUrl = Yii::app()->createUrl('menu');
		$deletedid = Category::model()->findByPk($id);
		$descendants = $deletedid->children()->findAll(); 
		$catsy = News::model()->category->taggedWith($deletedid->category_id)->count();
		if( count($descendants) > 0 ){
			Yii::app()->user->setFlash('danger', "Anda tidak boleh menghapus induk kategori");
		}
		elseif( $catsy > 0 ){
			Yii::app()->user->setFlash('danger', "Anda tidak boleh menghapus kategori yang masih terpakai");
		}
		elseif( $id === 58 || $id === 53){
			Yii::app()->user->setFlash('danger', "Kategori ini tidak boleh di hapus");
		}
		else{
			if( (count($blockModel) > 0) OR (count($widgetModel) > 0) OR (count($menuModel) > 0) ){
				Yii::app()->user->setFlash('danger', "Kategori yang akan dihapus masih digunakan pada <a href='$wgtUrl'>Midget</a> atau <a href='$contentUrl'>Content Manager</a> atau <a href='$menuUrl'>Menu Manager</a>");
			}
			else{
				$deletedid->deleteNode();
				Yii::app()->user->setFlash('success', "Kategori berhasil dihapus");
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('category/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	private static function callEdit($id, $b){
		if($b != ""){
			$widget = Widget::model()->findAllByAttributes(array('widget_type'=>'category','object_id'=>$id));
			foreach($widget as $widgetz){
				$widgetz->widget_name = $b;
				$widgetz->saveNode();
			}
			
			$block = Block::model()->findAllByAttributes(array('block_type'=>'category','block_object_id'=>$id));
			foreach($block as $blockz){
				$blockz->block_title = $b;
				$blockz->saveNode();
			}
			
			$menu = Menu::model()->findAllByAttributes(array('menu_type'=>'category', 'menu_url_id'=>$id));
			foreach($menu as $menuz){
				$menuz->menu_title = $b;
				$menuz->menu_title_attribute = $b;
				$menuz->saveNode();
			}
		}
	}
}
