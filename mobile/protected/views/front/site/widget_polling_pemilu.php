<?php 
// munculkan banner polling
$d_banner_polling = SettingPolling::model()->find('nama = :name', array(':name'=>'polling'));

 $e_activemenu = $this->action->id;
 $controllers_ac = $this->id;
 // tampilkan jika tidak di halaman polling
?>
<?php if ( (!empty($d_banner_polling) AND $d_banner_polling->gambar != '') AND $controllers_ac != 'polling'): ?>
<!-- Polling_2 -->
<div class="block-polling mt1 mb1 customs">
	<div class="top-block-polling">
		<div class="ins_content">
			<?php if ($d_banner_polling->url == '' OR $d_banner_polling->url == '#'): ?>
			<a href="<?php echo CHtml::normalizeUrl(array('polling/index')); ?>">	
			<?php else: ?>
				<a href="<?php echo $d_banner_polling->url ?>">
			<?php endif ?>
			<?php /*<img src="<?php echo Yii::app()->baseUrl.'/../images/uploads/banner_polling/'.$d_banner_polling->gambar; ?>" alt="Banner Polling" class="img-responsive"></a>*/ ?>
			<img src="<?php echo 'http://bangsaonline.com'.'/images/uploads/banner_polling/'.$d_banner_polling->gambar; ?>" alt="Banner Polling" class="img-responsive"></a>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php endif ?>