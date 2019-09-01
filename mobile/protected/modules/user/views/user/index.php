<?php
$this->breadcrumbs=array(
	'Manajemen User'
);
?>
<div class="form-group" style="overflow:hidden;">
	<h1>Manajemen User</h1>
	<div class="pull-right">
		<?php $this->renderPartial('/user/_search',array(
			'model'=>$model,
		)); ?>
	</div>
</div>
<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Manajemen User</h4>
				</div>
				<div class="panel-body">
						<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'user-grid',
							'pager' => array('htmlOptions'=>array('class'=>'pagination pagination-sm')),
							'itemsCssClass' => 'table table-condensed table-striped table-bordered table-hover',
							'dataProvider'=>$model->search(),
							'columns'=>array(
								array(
									'header'=>'Username',
									'name' => 'username',
									'type'=>'raw',
									'value' => 'UHtml::markSearch($data,"username")',
								),
								array(
									'header'=>'Email',
									'name'=>'email',
									'type'=>'raw',
									'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
								),
								array(
									'header'=>'Dibuat Pada',
									'name'=>'create_at',
									'value'=>'$data->create_at'
								),
								array(
									'header'=>'Terakhir Login',
									'name'=>'lastvisit_at',
									'value'=>'User::itemAliases("Notvisit", $data->lastvisit_at)'
								),
								array(
									'header'=>'Level User',
									'name'=>'superuser',
									'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
									//'filter'=>User::itemAlias("AdminStatus"),
								),
								array(
									'header'=>'Status',
									'name'=>'status',
									'value'=>'User::itemAlias("UserStatus",$data->status)',
									//'filter' => User::itemAlias("UserStatus"),
								),
								array(
									
									'class'=>'CButtonColumn',
									'template'=>'{update}',
									'updateButtonImageUrl'=>false,
									'updateButtonLabel' => 'Edit',
								),
								array(
									'class'=>'CButtonColumn',
									'template'=>'{delete}',
									'deleteButtonImageUrl'=>false,
									'deleteButtonLabel' => 'Hapus',
									'deleteConfirmation' => 'Apakah anda yakin?',
								),
							),
						)); ?>
				</div>
				<div class="panel-footer">
					<a href="<?php echo Yii::app()->createUrl('user/default/create'); ?>" class="btn btn-default">Tambah User</a>
					<?php 
						$loggedUser = User::model()->findByAttributes(array('id'=>1));
						if( Yii::app()->user->id == $loggedUser->id ):?>
							<a href="<?php echo Yii::app()->createUrl('user/profileField/admin'); ?>" class="btn btn-default">Profile Fields</a>
				<?php 	endif;?>
				</div>
			</div>
		</div>
	</div>