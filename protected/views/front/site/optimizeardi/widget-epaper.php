<!-- Start E-Paper -->
<div class="block-epaper mt1 mb1">
	<?php 
		$sqlepaper = "SELECT title,content FROM module_epaper ORDER BY id DESC LIMIT 1";
		$dataepaper	= Yii::app()->db->createCommand($sqlepaper)->queryRow();  
	?>
	<div class="top-block-epaper">
		<div class="title-block-epaper">
			<h3><a href="">E-PAPER</a></h3>
			<div class="clearfix"></div>
		</div>
		<div class="titledata-block-epaper"><h4><?php if(!empty($dataepaper)){ echo $dataepaper['title']; } ?></h4></div>
		<div class="content-block-epaper">
			<?php if(!empty($dataepaper)){ echo $dataepaper['content']; }else{ echo "Tidak ada E-Paper"; } ?>	
		</div>
		<div class="readmore-epaper"><a href="<?php echo Yii::app()->createUrl('epaper/');?>">E-Paper Yang Lain</a></div>
	</div>
</div>
<!-- End E-Paper -->