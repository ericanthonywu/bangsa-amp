<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/delAjaxImage.js', CClientScript::POS_END);
?>

<div class="container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'news-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
		)); ?>
	<div class="row">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Berita</h4>
				</div>
				<div class="panel-body">
					<?php echo $form->errorSummary($model, null,null,array('class' => 'alert alert-danger')); ?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'news_title'); ?>
						<?php echo $form->textField($model,'news_title',array('class'=>'form-control')); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'news_excerpt'); ?>
						<?php echo $form->textArea($model,'news_excerpt',array('class'=>'form-control', 'id'=>'yii-redactors')); ?>
					</div>
						<?php
							Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
							$this->widget('ImperaviRedactorWidget', array(
								'selector' => '#yii-redactors',
								'options' => array(
									'lang' => 'id',
									'minHeight'=>200
								),
								'plugins' => array(
									'fullscreen' => array(
										'js' => array('fullscreen.js',),
									),
								),
							));
						?>
					<div class="form-group">
						<?php echo $form->labelEx($model,'news_content'); ?>
						<?php echo $form->textArea($model,'news_content',array('class'=>'form-control', 'id'=>'yii-redactor')); ?>
					</div>
						<?php
							Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
							$this->widget('ImperaviRedactorWidget', array(
								'selector' => '#yii-redactor',
								'options' => array(
									'lang' => 'id',
									'minHeight'=>200
								),
								'plugins' => array(
									'fullscreen' => array(
										'js' => array('fullscreen.js',),
									),
								),
							));
						?>
					<!--
					<div class="form-group">
						<?php //echo $form->labelEx($model,'youtube_links'); ?>
						<?php //echo $form->textField($model,'youtube_links',array('class'=>'form-control', 'placeholder'=>'Link Video Youtube')); ?>
					</div>
					-->
					<div class="form-group">
						<?php echo $form->labelEx($model,'embed'); ?>
						<?php echo $form->textArea($model,'embed',array('class'=>'form-control', 'placeholder'=>'Embed Youtube Video')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'news_wartawan'); ?>
						<?php echo $form->textField($model,'news_wartawan',array('class'=>'form-control', 'placeholder'=>'Wartawan Berita')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'news_penulis'); ?>
						<?php echo $form->textField($model,'news_penulis',array('class'=>'form-control', 'placeholder'=>'Penulis Berita')); ?>
					</div>
					<div class="form-group">
						<?php echo $form->labelEx($model,'news_source'); ?>
						<?php echo $form->textField($model,'news_source',array('class'=>'form-control', 'placeholder'=>'Sumber Berita')); ?>
					</div>
					<div class="form-group">
						<div class="container">
								<?php
									if($model->isNewRecord)
										$url = Yii::app()->createUrl("news/upload");
									else
										$url = Yii::app()->createUrl("news/upload&id=".Yii::app()->request->getParam('id'));
									
									$this->widget('xupload.XUpload', array(
															'url' => $url,
															'model' => $photos,
															'attribute' => 'newsfile',
															'multiple' => true,
															'htmlOptions' => array('id'=>'news-form'),
															'options' => array(
																'maxFileSize' => 2000000,
																'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
																'submit' => "js:function (e, data) {
																	var inputs = data.context.find(':input');
																	data.formData = inputs.serializeArray();
																	return true;
																}",
															),
									));
								?>
						</div>
					</div>
					<div>
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan', array('class'=>'btn btn-default', 'id'=>'news-upload-button')); ?>
					</div>
				</div>
			</div>
			<div class="panel panel-green">
				<div class="panel-heading rounded-bottom">
					<h4>Keterangan Tambahan</h4>
					<div class="options">
						<a class="panel-collapse" href="javascript:;"><i class="icon-chevron-down"></i></a>
					</div>
				</div>
				<div class="panel-body collapse">
					<div class="form-group">
						Narasumber
						<?php echo $form->textField($model,'oleh',array('class'=>'form-control', 'placeholder'=>'Narasumber (Tafsir Al Quran atau Opini) ')); ?>
					</div>
					<div class="form-group">
						Surat dan Ayat (Untuk Tafsir Al Quran Aktual)
						<?php echo $form->textField($model,'ayat',array('class'=>'form-control', 'placeholder'=>'Surat dan Ayat (Tafsir Al Quran Aktual)')); ?>
					</div>
				</div>
			</div>
			<div class="panel panel-green">
				<div class="panel-heading rounded-bottom">
					<h4>SEO Meta Attribute</h4>
					<div class="options">
						<a class="panel-collapse" href="javascript:;"><i class="icon-chevron-down"></i></a>
					</div>
				</div>
				<div class="panel-body collapse">
					<div class="form-group">
						SEO Meta Title
						<?php echo $form->textField($model,'news_meta_title',array('class'=>'form-control', 'placeholder'=>'Biarkan kosong jika tidak mengerti')); ?>
					</div>
					<div class="form-group">
						SEO Meta Description
						<?php echo $form->textArea($model,'news_meta_desc',array('class'=>'form-control', 'placeholder'=>'Biarkan kosong jika tidak mengerti')); ?>
					</div>
					<div class="form-group">
						SEO Meta Keywords
						<?php echo $form->textArea($model,'news_meta_keyword',array('class'=>'form-control', 'placeholder'=>'Biarkan kosong jika tidak mengerti')); ?>
					</div>
				</div>
			</div>
		</div>
			<div class="col-md-4">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Jenis Berita</h4>
					</div>
					<div class="panel-body">
							<?php echo $form->labelEx($model,'news_type'); ?><br />
							<label><input type="radio" id="News_news_status_1" name="News[news_type]" value="1" <?php if(!$model->isNewRecord){if($model->news_type == 1){echo "checked=checked";}}else{echo "checked='checked'"; }?> /><strong>Berita Biasa</strong></label><br />
							<label><input type="radio" id="News_news_status_2" name="News[news_type]" value="2" <?php if(!$model->isNewRecord){if($model->news_type == 2){echo "checked=checked";}}?> /> <strong>Berita Foto</strong></label><br />
							<label><input type="radio" id="News_news_status_3" name="News[news_type]" value="3" <?php if(!$model->isNewRecord){if($model->news_type == 3){echo "checked=checked";}}?> /> <strong>Berita Video</strong></label><br />
					</div>
				</div>
				
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Status Berita</h4>
					</div>
					<div class="panel-body">
							<?php echo $form->labelEx($model,'news_status'); ?>
							<?php echo $form->dropDownList($model,'news_status', array('1'=>'Publish', '2'=>'Draft', '3'=>'Trash'), array('class'=>'form-control')); ?>
					</div>
				</div>
				
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Berita Slide</h4>
					</div>
					<div class="panel-body">
							<?php echo $form->labelEx($model,'is_headline'); ?>
							<?php echo $form->dropDownList($model,'is_headline', array('0'=>'Tidak', '1'=>'Ya'), array('class'=>'form-control')); ?>
					</div>
				</div>
				
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Kategori</h4>
					</div>
					<div class="panel-body">
						<div style="overflow:auto;max-height:200px;">
							<?php
								$roots = Category::model()->roots()->findAll();
								if(count($roots) > 0):
									foreach($roots as $root):
										$descendants = Yii::app()->db->createCommand()->select('category_id, root, lft, rgt, level, category_name, category_description, category_slug')->from('category')->where('root=:root AND active = 1', array(':root'=>$root->root))->order('lft')->queryAll();
										foreach($descendants as $descendant):?>
											<div class="checkbox">
												<label>
													<?php for($i=1;$i<$descendant['level'];$i++){echo "&#8212";} echo " ".$descendant['category_name']; ?>
													<input type="checkbox" value="<?php echo $descendant['category_id']; ?>" name="Category[]"<?php 
															if(!($model->isNewRecord)){
																$categories = Yii::app()->db->createCommand()->select('category_id')->from('category a')->naturalJoin('category_relationship b','a.category_id=b.category_id')->where('b.post_id=:id',array(':id'=>$model['news_id']))->queryAll();
																foreach($categories as $category){
																	if($descendant['category_id'] == $category['category_id'])
																		echo "checked='checked'";
																}
															}
														?>
													/>
												<label>
											</div>
						<?php
										endforeach;
									endforeach;
								else:?>
								Kategori Tidak Ada
						<?php	endif;
						?>
						</div>
					</div>
				</div>
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Tag / Topik</h4>
					</div>
					<div class="panel-body">
						<input type="hidden" id="azm12" style="width:100%" name="Tag" value="<?php 
							$tags = Yii::app()->db->createCommand()->select('tag_title')->from('tag a')->join('tag_relationship b', 'b.tagID=a.id')->where('post_id=:gs', array(':gs'=>$model->news_id))->queryAll();
							foreach($tags as $tag){
								if(end($tags) == $tag)
									echo $tag['tag_title']; 
								else 
									echo $tag['tag_title'].",";	
							}
						?>"
						/>
					</div>
				</div>
				
				<div class="panel panel-green">
					<div class="panel-heading">
						<h4>Running Berita / Sub Judul</h4>
					</div>
					<div class="panel-body">
						<input type="hidden" id="azm1" style="width:100%" name="Running" value="<?php 
							$tags = Yii::app()->db->createCommand()->select('running_title')->from('running_news_relationship a')->join('running_news b', 'a.running_id=b.id')->where('post_id=:gs', array(':gs'=>$model->news_id))->queryAll();
							foreach($tags as $tag){
								if(end($tags) == $tag)
									echo $tag['running_title']; 
								else 
									echo $tag['running_title'].",";	
							}
						?>"
						/>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>
							<div class="modal fade" id="newsForm" tabindex="-1" role="dialog" aria-labelledby="newsForm" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Edit </h4>
										</div>
										<div class="modal-body">
											<div>
												<div id="judul-caption">
													Judul Caption
												</div>
												<div>
													<input class="form-control caption-title" name="news_caption_title" />
												</div>
												<div id="deskripsi-caption" style="margin-top:5px;">
													Deskripsi Caption
												</div>
												<div>
													<textarea class="form-control caption-desc" name="news_caption_desc" ></textarea>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary save-caption" data-modul="news">Simpan Caption</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
</div><!-- container -->