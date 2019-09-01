<div class="row">
	<div class="col-md-3">
		<div class="panel panel-primary panel-green">
			<div class="panel-heading"><h4>Custom Links</h4></div>
			<div class="panel-body">
		<?php	$form=$this->beginWidget('CActiveForm', array(
					'id'=>'formAjaxPostCustomLinks',
					'enableAjaxValidation'=>false,
					));?>
				<div>
					Judul: 
					<input type="text" class="form-control input-sm" id="customLinksTitle" name="customLinksTitle"/>
				</div>
				<div style="margin-top:10px;">
					Url: 
					<input type="text" class="form-control input-sm" id="customLinksUrl" value="http://" name="customLinksUrl"/>
				</div>
				<div style="margin-top:10px;">
					<img style="display:none;" id="ajaxLoadingCustomLinks" class="pull-right" src="<?php echo Yii::app()->baseUrl; ?>img/ajax-loader.gif" width="120" height="19" />
					<a href="javascript:;" id="ajaxPostCustomLinks" class="btn btn-default" >Tambah</a>
				</div>
		<?php 	$this->endWidget();?>
			</div>
		</div>
		<div class="panel panel-primary panel-green">
			<div class="panel-heading"><h4>Halaman</h4></div>
			<div class="panel-body">
		<?php 	$form=$this->beginWidget('CActiveForm', array(
						'id'=>'formAjaxPostHalaman',
						'enableAjaxValidation'=>false,
						));?>
				<div style="overflow:auto;max-height:200px">
		<?php 			$pages = Yii::app()->db->createCommand()->select('page_id, page_title')->from('page')->where('page_status=1')->queryAll();
						foreach($pages as $page):?>
							<div class="checkbox" style="overflow:hidden;">
								<label><?php echo $page['page_title']; ?>
									<input type="checkbox" id="nhalaman-<?php echo $page['page_id']; ?>" name="ajaxHalaman[]" value="<?php echo $page['page_id']; ?>" />
								</label>
							</div>
		<?php			endforeach;?>
				</div>
				<div style="margin-top:10px;">
					<img style="display:none;" id="ajaxLoadingHalaman" class="pull-right" src="<?php Yii::app()->baseUrl; ?>img/ajax-loader.gif" width="120" height="19" />
					<a href="javascript:;" id="ajaxPostHalaman" class="btn btn-default">Tambah</a>
				</div>
		<?php 	$this->endWidget();?>
			</div>
		</div>
		<div class="panel panel-primary panel-green">
			<div class="panel-heading"><h4>Kategori</h4></div>
			<div class="panel-body">
		<?php 	$form=$this->beginWidget('CActiveForm', array(
					'id'=>'formAjaxPostKategori',
					'enableAjaxValidation'=>false,
				));?>
				<div style="overflow:auto;max-height:200px">
		<?php 		$categories = Yii::app()->db->createCommand()->select('category_name, category_id')->from('category')->where('active=1')->queryAll();
					foreach($categories as $category):?>
						<div class="checkbox" style="overflow:hidden;">
							<label><?php echo $category['category_name']; ?>
								<input type="checkbox" id="nkategori-<?php echo $category['category_id']; ?>" name="ajaxKategori[]" value="<?php echo $category['category_id']; ?>"/>
							</label>
						</div>
		<?php		endforeach;?>
				</div>
				<div style="margin-top:10px;">
					<img style="display:none;" id="ajaxLoadingKategori" class="pull-right" src="<?php Yii::app()->baseUrl; ?>img/ajax-loader.gif" width="120" height="19" />
					<a href="javascript:;" id="ajaxPostKategori" class="btn btn-default">Tambah</a>
				</div>
		<?php 	$this->endWidget(); ?>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-primary panel-green">
			<div class="panel-heading">
				<h4>Navigasi</h4>
				<div class="options">
					<ul class="nav nav-tabs">
					<?php 	$grpMenus = Yii::app()->db->createCommand()->select('id, group_title, group_name')->from('menu_group')->order('id ASC')->queryAll();
							foreach($grpMenus as $grpMenu):?>
							<li <?php if($grpMenu['id'] == 1)echo "class='active'"; ?> data-id="<?php echo $grpMenu['group_name']."-".$grpMenu['id']; ?>">
								<a href="#<?php echo $grpMenu['group_name']."-".$grpMenu['id']; ?>" data-toggle="tab"><?php echo $grpMenu['group_title']; ?></a>
							</li>
					<?php	endforeach;?>
					</ul>
				</div>
			</div>
			<div class="panel-body">
			<?php echo CHtml::beginForm('', 'post', array('id'=>'ajaxmenu')); ?>
				<div class="tab-content">
					<?php	foreach($grpMenus as $grpMenu):?>
						<div class="tab-pane  <?php if($grpMenu['id'] == 1)echo "active"; ?>" id="<?php echo $grpMenu['group_name']."-".$grpMenu['id']; ?>" data-id="<?php echo $grpMenu['group_name']."-".$grpMenu['id']; ?>">
							<ol class="sortable">
									<?php 
										//$criteria=new CDbCriteria;
										//$criteria->order='t.lft'; // or 't.root, t.lft' for multiple trees
										//$criteria->compare('group_id',$grpMenu['id']);
										//$menus=Menu::model()->findAll($criteria);
										$menus = Yii::app()->db->createCommand()->select('menu_id, root, lft, rgt, level, menu_title, menu_slug, menu_description, menu_title_attribute, menu_url_id, menu_url, menu_type, category_id, group_id')->from('menu')->where('group_id=:grps', array(':grps'=>$grpMenu['id']))->order('lft ASC')->queryAll();
										$level=0;
										$ullevel=0;

										foreach($menus as $n=>$menu):
											if($menu['level']==$level)
												echo CHtml::closeTag('li')."\n";
											else if($menu['level']>$level){
												if($ullevel==0){
													$ullevel++;
												}
												else
													echo CHtml::openTag('ol')."\n";
											}
											else
											{
												echo CHtml::closeTag('li')."\n";

												for($i=$level-$menu['level'];$i;$i--)
												{
													if($ullevel==0){
														$ullevel++;
													}
													else{
														echo CHtml::closeTag('ol')."\n";
													}
													echo CHtml::closeTag('li')."\n";
												}
											}
										if($menu['menu_id'] != 1):?>
										<li id="list_<?php echo $menu['menu_id']; ?>">
										<div class="panel panel-green">
											<div class="panel-heading rounded-bottom" data-id="<?php echo $menu['menu_id']; ?>">
												<div class="options">
													<a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
													<a><?php echo ucfirst($menu['menu_type']); ?></a>
												</div>
												<?php echo $menu['menu_title']; ?>
											</div>
											<div class="panel-body collapse">
												<div class="row">
													<div class="col-md-12" style="margin:0 0 5px 0;<?php if($menu['menu_type'] != 'custom') echo "display:none;" ?>">
														Url
														<input class="form-control menu_url" type="text" value="<?php echo $menu['menu_url'];?>" />
													</div>
													<div class="col-md-6">
														Judul Menu
														<input class="form-control menu_title" type="text" value="<?php echo $menu['menu_title'];?>" />
													</div>
													<div class="col-md-6">
														Menu Title Atribut
														<input class="form-control menu_title_attribute" type="text" value="<?php echo $menu['menu_title_attribute'];?>" />
													</div>
												</div>
												<a href="javascript:;" data-id="<?php echo $menu['menu_id']; ?>" id="ajaxMenuDel" class="btn btn-default" style="margin-top:5px;">Hapus</a>
											</div>
										</div>
										<?php endif;
										$level=$menu['level'];?>
									<?php endforeach;

										for($i=$level;$i;$i--)
										{
											echo CHtml::closeTag('li')."\n";
											echo CHtml::closeTag('ol')."\n";
										}
									?>
						</ol>
					</div>
					<?php	endforeach;?>
				</div>
			</div>
			<div class="panel-footer">
				<a href="javascript:;" id="ajaxMenuPost" class="btn btn-default">Simpan Posisi</a>
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>
		<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<div class="modal-title modal-title-text">Modal title</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</div>