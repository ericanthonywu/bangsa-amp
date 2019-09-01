<?php 
	$urlID = Yii::app()->request->getParam('id');
	$sql = "SELECT comment_email, comment_content, comment_status, comment_date, username, lastname, firstname FROM comments as a INNER JOIN users as b ON a.comment_user_id=b.id INNER JOIN profiles as c ON a.comment_user_id=c.user_id WHERE comment_news_id = :urlid AND comment_status = 1 LIMIT 5";
	$querySqls = Yii::app()->db->createCommand($sql);
	$querySqls->bindParam(":urlid", $urlID, PDO::PARAM_STR);
	$querySql = $querySqls->queryAll();
?>
<div class="comment-berita">
	<div class="title-comment">
		<?php if(!Yii::app()->user->isGuest):?>
		<span class="">Kirimkan Komentarmu</span>
		<?php endif; ?>
		<span class="total_comment">Ada <strong><?php echo count($querySql); ?></strong> komentar untuk berita ini</span>
		<div class="clearfix"></div>
	</div>
	<?php if(!Yii::app()->user->isGuest):?>
	<div class="post-comment">
		<?php 
			$messages = Yii::app()->user->getFlashes();
			foreach($messages as $key => $message):?>
			<div class="alert alert-dismissable alert-<?php echo $key; ?> errorMessage">
				<?php echo $message; ?>
			</div>
		<?php endforeach; ?>
		<?php 
			$user = Yii::app()->user->id;
			$sqlx = "SELECT filename FROM files WHERE module_id = 5 AND user_id = '$user'";
			$zxzc = Yii::app()->db->createCommand($sqlx)->queryRow();
		?>
		<form action="<?php echo Yii::app()->createUrl('komentar/komentar', array('id'=>$urlID)); ?>" method="POST">
			<div class="photo-current-user">
			<?php	if($zxzc['filename']):?>
						<img src="<?php echo Yii::app()->request->baseUrl."/images/uploads/user/".$zxzc['filename']; ?>" />
			<?php	else: ?>
						<img src="<?php echo Yii::app()->request->baseUrl."/images/uploads/user/default-user.jpg"; ?>" />
			<?php	endif; ?>
			</div>
			<div class="textarea-post-comment">
				<textarea name="Komentar[text]"></textarea>
				<input type="submit" value="KIRIM KOMENTAR">
			</div>
		</form>
		<div class="clearfix"></div>
	</div>
	<?php endif; ?>
	<?php if(Yii::app()->user->isGuest){ ?>
	<div class="kirim-komnetar" style="font-weight:bold;margin:5px 0 0 0;">
		Anda belum Login, untuk mengomentari berita ini anda harus login terlebih dahulu . Login <a style="color:#01806F" href="<?php echo Yii::app()->createUrl('user/login/'); ?>">disini</a>
	</div>
	<?php } ?>
	<div class="list-comment">
		<ul class="comment-ok-loaded">
				<?php 
					$newsid = $_GET['id'];
					$sqllqlql = "SELECT c.*,u.*,p.`firstname`, p.`lastname` FROM comments c INNER JOIN users u ON (c.`comment_user_id`=u.`id`) INNER JOIN profiles p ON c.`comment_user_id`=p.`user_id` WHERE c.`comment_news_id` = '$newsid' AND comment_status = 1";
					$chkImg = Yii::app()->db->createCommand($sqllqlql)->queryAll(); ?>
			<?php foreach($chkImg as $querys): ?>
			<li>
				<div class="photo-user">
				<?php 	$userID = $querys['comment_user_id'];
						$img = Yii::app()->db->createCommand("SELECT filename FROM files WHERE user_id = '$userID' AND module_id = 5")->queryRow();
						if($img['filename']): ?>
							<img src="<?php echo Yii::app()->request->baseUrl."/images/uploads/user/".$img['filename']; ?>" />
				<?php 	else:?>
						<img src="<?php echo Yii::app()->request->baseUrl."/images/uploads/user/default-user.jpg"; ?>" />
				<?php 	endif;?>
				</div>
				<div class="right-comment-user">
					<div class="name-comment-user"><?php echo $querys['firstname']." ".$querys['lastname']; ?></div>
					<div class="date-comment-user"><?php echo get_time($querys['comment_date'],"dd MMMM yyyy | HH:MM","yes"); ?></div>
					<div class="content-comment-user">
						<?php echo $querys['comment_content']; ?>
					</div>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php if(count($querySql) > 5): ?>
		<div class="load-more-comment">
			<a class="loadmorecomment" data-id="11" href="javascript:;">Tampilkan Komentar Lainnya ..</a>
		</div>
		<?php endif;?>
	</div>
</div>