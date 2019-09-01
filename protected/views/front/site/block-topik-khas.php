<div class="topik-khas mb1">
	<?php 
		// get topik khas
		$sqltopik 	= "SELECT judul,object_id FROM module_news_topik_khas WHERE id ='1' ";
		$datatopik	= Yii::app()->db->createCommand($sqltopik)->queryRow();

		// sql gambar 
		$sqlimg 	= "SELECT filename FROM files WHERE module_id ='3' ";
		$dataimg	= Yii::app()->db->createCommand($sqlimg)->queryRow();
		
		$slugtopik = $datatopik['object_id'];
		$link = str_replace(',', '+', $slugtopik);
	?>
	<!--<div class="title-news"><h3><a href="<?php //echo Yii::app()->createUrl("tag/".$link); ?>">TOPIK KHAS</a></h3></div> -->
	<div class="title-topik"><a href="<?php echo Yii::app()->createUrl("tag/".$link); ?>"><?php echo $datatopik['judul']; ?></a></div>
	<div class="image-news">
		<a href="<?php echo Yii::app()->createUrl("tag/".$link); ?>">
			<?php echo get_image($dataimg['filename'],'topikkhas'); ?>
		</a>
	</div>
</div>