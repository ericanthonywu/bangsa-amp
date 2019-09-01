<?php 
// munculkan banner polling
$d_banner_polling = SettingPolling::model()->find('nama = :name', array(':name'=>'polling'));
?>
<?php if (!empty($d_banner_polling) AND $d_banner_polling->gambar != ''): ?>
<!-- Polling_2 -->
<div class="block-polling mt1 mb1 customs">
	<div class="top-block-polling">
		<div class="ins_content">
			<?php if ($d_banner_polling->url == '' | $d_banner_polling->url == '#'): ?>
			<a href="<?php echo CHtml::normalizeUrl(array('polling/index')); ?>">	
			<?php else: ?>
				<a href="<?php echo $d_banner_polling->url ?>">
			<?php endif ?>
			
			<img src="<?php echo Yii::app()->getBaseUrl().'/images/uploads/banner_polling/'.$d_banner_polling->gambar; ?>" alt="Banner Polling" class="img-responsive"></a>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php endif ?>