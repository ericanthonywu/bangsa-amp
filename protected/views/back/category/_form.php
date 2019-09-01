<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'page-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
	<div class="row">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4><?php if($model->isNewRecord){ echo "Tambah";}else{echo "Edit";} ?> Kategori</h4>
				</div>
				<div class="panel-body">
					<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'category_name'); ?>
						<?php echo $form->textField($model,'category_name',array('maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
					
					<div class="form-group">
						<?php echo $form->labelEx($model,'category_description'); ?>
						<?php echo $form->textArea($model,'category_description',array('maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default')); ?>
					</div>
				</div>
			</div>
		</div>
			<div class="col-md-4">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Induk Kategori</h4>
					</div>
					<div class="panel-body">
						<div class="form-group">
						<?php if( $model->isNewRecord ): ?>
								<select name="Category[root]" class="form-control">
									<option value="">Pilih Induk Kategori</option>
									<?php 
										$roots = Category::model()->roots()->findAll();
										$level = 0;
										foreach($roots as $n=>$root):
											$level=0;
											$categories = Yii::app()->db->createCommand()->select('category_id, category_name')->from('category')->where('root=:root', array(':root'=>$root->root))->order('lft')->queryAll();
												foreach($categories as $n=>$category):?>
													<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
								<?php			endforeach;
											endforeach;
								?>
								</select>
						<?php	else:?>
								<select name="Category[root]" class="form-control">
								<?php 	$root = Category::model()->findByPk($model->category_id);
										if( !($root->isRoot()) ):?>
											<option value="beroot">Jadikan Induk</option>
								<?php	else:?>
											<option value="">Pilih Induk</option>
								<?php	endif;
										$roots = Category::model()->roots()->findAll();
										$level=0;
										foreach($roots as $n=>$root):
											$level=0;
											$categories = Yii::app()->db->createCommand()->select('category_id, category_name')->from('category')->where('root=:root', array(':root'=>$root->root))->queryAll();
											foreach($categories as $n=>$category):
												$catid = Category::model()->findByPk($model->category_id);
												$descendant = Category::model()->findByPk($category['category_id']);
												if( ($category['category_id'] != $model->category_id ) && !($descendant->isDescendantOf($catid)) ):?>
													<option value="<?php echo $category['category_id']; ?>" <?php if( count($catid->parent()->find()) > 0 ){if( $catid->parent()->find()->category_id == $category['category_id'] ){echo "selected='selected'";}} ?>>
														<?php echo $category['category_name']; ?>
													</option>
								<?php			else:?>
								<?php			endif;
											endforeach;
										endforeach;
								?>
								</select>
						<?php	endif;?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Status Kategori</h4>
					</div>
					<div class="panel-body">
						<?php echo $form->dropDownList($model,'active',array('1'=>'Aktif', '0'=>'Tidak Aktif'), array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Tampilkan di Indeks Kategori</h4>
					</div>
					<div class="panel-body">
						<?php echo $form->dropDownList($model,'is_indeks',array('1'=>'Ya', '0'=>'Tidak'), array('class'=>'form-control')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>
</div><!-- container -->