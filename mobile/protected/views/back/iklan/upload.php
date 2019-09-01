<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
		<td>
			<div class="row">
				<div class="row">
					<div class="col-md-12" style="margin-bottom:5px;overflow:hidden;">
						<span class="col-md-3">{%=file.name%}</span>
						<span class="col-md-3">{%=o.formatFileSize(file.size)%}</span>
						<span class="col-md-6"><input class="form-control" type="text" name="page_caption_title" required placeholder="Judul Caption" /></span>
					</div>
					<div class="col-md-12" style="margin-bottom:5px;overflow:hidden;">
						<span class="preview col-md-2"><span class="fade"></span></span>
						<span class="col-md-10 "><textarea class="form-control" name="page_caption_description" rows="3" required placeholder="Deskripsi Caption"></textarea></span>
					</div>
					<div class="col-md-12">
						<span class="row">
							{% if (file.error) { %}
								<span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}
							{% } 
							else if (o.files.valid && !i) { %}
								<div class="col-md-8">
									<div class="progress progress-striped active">
										<div class="progress-bar progress-bar-inverse" width="0%"></div>
									</div>
								</div>
								<span class="col-md-2 start hidden"> 
									{% if (!o.options.autoUpload) { %}
										<button class="btn btn-primary uploadersx">
											<i class="icon-upload icon-white"></i>
											<span>{%=locale.fileupload.start%}</span>
										</button>
									{% } %}
								</span>
							{% } else { %}
									
							{% } %}
							<span class="col-md-2 cancel pull-right"> 
								{% if (!i) { %}
									<button class="btn btn-warning">
										<i class="icon-ban-circle icon-white"></i>
										<span>{%=locale.fileupload.cancel%}</span>
									</button>
								{% } %}
							</span>
						{% } %}
						</span>
					</div>
				</div>
			</div>
		</td>
        <input type="hidden" name="image-id" required value="<?php echo Yii::app()->getRequest()->getParam('id'); ?>" />
    </tr>
</script>
