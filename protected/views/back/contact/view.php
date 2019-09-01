<?php
/* @var $this ContactController */
/* @var $model Contact */
$this->breadcrumbs=array(
			'Pesan'=>array('index'),
			$model->subject,
		);
?>

<?php if( $model->users_id == Yii::app()->user->id || $model->users_id != 1):?>	
	<h1>#<?php echo $model->subject; ?></h1>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-indigo">
					<div class="panel-body">
					<form action="" class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Pengirim</label>
							<div class="col-sm-6">
								<div class="well well-sm" style="word-wrap:break-word;">
									<?php echo $model->name; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email Pengirim</label>
							<div class="col-sm-6">
								<div class="well well-sm" style="word-wrap:break-word;">
									<?php echo $model->email; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Website Pengirim</label>
							<div class="col-sm-6">
								<div class="well well-sm" style="word-wrap:break-word;">
									<?php echo $model->website; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Subjek</label>
							<div class="col-sm-6">
								<div class="well well-sm" style="word-wrap:break-word;">
									<?php echo $model->subject; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Isi Pesan</label>
							<div class="col-sm-6">
								<div class="well well-sm" style="word-wrap:break-word;">
									<?php echo $model->message; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<div class="pull-sright">
									<a href="<?php echo Yii::app()->createUrl('contact/create/', array('id'=>$model->id)); ?>" class="btn btn-default">Kirim Email Balasan</a>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: 
		throw new CHttpException(404,'Maaf, halaman yang anda cari tidak ditemukan.');
?>
<?php endif; ?>