<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Lupa Password';
$this->breadcrumbs=array(
	'Lupa Password',
);
?>
<?php 

	//print_r($query);
?>
<div class="row bo-main">
	<!-- KONTEN -->
	<div class="span8 mb1 mt1"> 
		<div class="breadcrumb">
			<?php 
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			?>
		</div>
		
		<div class="separator-block-2 mt2 mb2"></div> <!-- Spearator -->
		<!-- Start List Berita -->
		<div class="list-search-berita">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'forgot-form',
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
				<table style="border-collapse: separate;border-spacing: 10px 5px;">
					<tr>
						<td>Email</td>
						<td></td>
						<td><?php echo $form->textField($model,'email', array('class'=>'form-control','id'=>'email','placeholder'=>'Email')); ?></td>
					</tr>
					<?php echo "<tr><td colspan='3'>".$form->error($model,'email')."</td></tr>"; ?>
				</table>
				<div>
					<div><input type="submit" value="Re-Send Password"/></div>
				</div>
			</div>
		<?php $this->endWidget(); ?>
		<?php 
			$messages = Yii::app()->user->getFlashes();
			foreach($messages as $key => $message):?>
			<div class="alert alert-dismissable alert-<?php echo $key; ?> errorMessage">
				<?php echo $message; ?>
			</div>
		<?php endforeach; ?>
	</div>
	
	<!-- SIDEBAR -->
	<div class="span4 mb1 mt1">
		<?php $this->renderPartial('//site/sidebar'); ?>
	</div>
</div>
