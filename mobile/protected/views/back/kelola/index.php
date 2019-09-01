<?php
// $idU = Yii::app()->user->id;
// $sqlcg = "SELECT itemname FROM authassignment WHERE userid = '$idU'";
// $zx = Yii::app()->db->createCommand($sqlcg)->queryRow();
// if($zx['itemname'] == 'Member'){
	// Yii::app()->user->logout();
	// $this->redirect(Yii::app()->getBaseUrl(true));
// }
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;

?>
<div id="page-heading">
	<h1>Dashboard</h1>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>User Daftar Terakhir</h4>
					<div class="options">
						<a href="javascript:;"><i class="fa fa-cog"></i></a>
						<a href="javascript:;"><i class="fa fa-wrench"></i></a> 
						<a class="panel-collapse" href="javascript:;"><i class="fa fa-chevron-down"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table style="margin-bottom: 0px;" class="table">
							<thead>
								<tr>
									<th class="col-xs-9 col-sm-3">User ID</th>
									<th class="col-sm-6 hidden-xs">Email Address</th>
									<th class="col-xs-2 col-sm-2">Status</th>
								</tr>
							</thead>
							<tbody class="selects">
								<?php 
									$sql = "SELECT username, email, lastvisit_at, status FROM users WHERE id != 1 ORDER BY id DESC LIMIT 10";
									$model = Yii::app()->db->createCommand($sql)->queryAll();
									if(count($model)>0):
									foreach($model as $mod):?>
									<tr>
										<td><?php echo $mod['username']; ?></td>
										<td class="hidden-xs"><?php echo $mod['email']; ?></td>
										<td><?php 
												if($mod['status'] == 1){
													$app = "success";$aps = "Approved";
												}
												else{
													$app = "warning";$aps = "Unapproved";
												}?>
											<span class="label label-<?php echo $app; ?>"><?php echo $aps; ?></span>
										</td>
									</tr>
							<?php	endforeach;
									else:?>
										<tr>
											<td>Tidak ada USER</td>
										</tr>
							<?php 	endif;?>
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Komentar Terakhir</h4>
					<div class="options">
						<a href="javascript:;"><i class="fa fa-cog"></i></a>
						<a href="javascript:;"><i class="fa fa-wrench"></i></a> 
						<a class="panel-collapse" href="javascript:;"><i class="fa fa-chevron-down"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table style="margin-bottom: 0px;" class="table">
							<thead>
								<tr>
									<th class="col-xs-9 col-sm-3">User ID</th>
									<th class="col-sm-6 hidden-xs">Email Address</th>
									<th class="col-xs-2 col-sm-2">Status</th>
								</tr>
							</thead>
							<tbody class="selects">
								<?php 
									$sql = "SELECT username, email, comment_status FROM comments INNER JOIN users ON comment_user_id=id ORDER BY comment_id DESC LIMIT 10";
									$model = Yii::app()->db->createCommand($sql)->queryAll();
									if(count($model)>0):
									foreach($model as $mod):?>
									<tr>
										<td><?php echo $mod['username']; ?></td>
										<td class="hidden-xs"><?php echo $mod['email']; ?></td>
										<td><?php 
												if($mod['comment_status'] == 1){
													$app = "success";$aps = "Approved";
												}
												else{
													$app = "warning";$aps = "Unapproved";
												}?>
											<span class="label label-<?php echo $app; ?>"><?php echo $aps; ?></span>
										</td>
									</tr>
							<?php	endforeach;
									else:?>
									<tr>
										<td>
											Belum ada komentar
										</td>
									</tr>
							<?php 	endif;?>
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>