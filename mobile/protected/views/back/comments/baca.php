<?php
/* @var $this CommentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Komentar',
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/commentsDo.js', CClientScript::POS_END);
?>

<div class="form-group" style="overflow:hidden;">
	<h1>Baca Komentar Lengkap</h1>
</div>
	<?php
		$messages = Yii::app()->user->getFlashes();
		foreach($messages as $key => $message):?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
		</div>
	<?php endforeach; ?>
<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Komentar #<?php echo $_GET['id']; ?></h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal row-border">
						<div class="form-group">
							<label class="col-md-3 control-label">Username</label>
							<div class="col-md-8 well well-sm" style="word-wrap:break-word;"><?php echo $modelx['username'];?></div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Isi Komentar</label>
							<div class="col-md-8 well well-sm" style="word-wrap:break-word;"><?php echo $modelx['comment_content'];?></div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Tanggal Komentar</label>
							<div class="col-md-8 well well-sm" style="word-wrap:break-word;"><?php echo get_time($modelx['comment_date'], "", "yes");?></div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Komentar Kepada</label>
							<div class="col-md-8 well well-sm" style="word-wrap:break-word;"><?php echo Comments::whomever($modelx['comment_news_id']);?></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>