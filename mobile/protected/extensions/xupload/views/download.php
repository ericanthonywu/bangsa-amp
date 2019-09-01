<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
		<td>
			<div class="row">
				<div class="row">
					{% if (file.error) { %}
						<span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}
					{% } else { %}
						<div class="col-md-12" style="margin-bottom:5px;overflow:hidden;" data-diff="{%=file.files_id%}-{%=file.module_id%}">
							<span class="col-md-3">{%=file.name%}</span>
							<span class="col-md-3">{%=o.formatFileSize(file.size)%}</span>
						</div>
						<div class="col-md-12" style="margin-bottom:5px;overflow:hidden;">
							<div class="col-md-2 preview">
							{% if (file.thumbnail_url) { %}
								<a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}" width="100px"></a>
							{% } %}
							</div>
							<span class="col-md-10 ">
								<strong>Judul Caption</strong>
								<div style="margin-bottom:5px;word-wrap:break-word;">
									<span class="caption-title" data-text="{%=file.ctitle%}">{%=file.ctitle%}</span>
								</div>
								<strong>Deskripsi Caption</strong>
								<div style="word-wrap:break-word;">
									<span class="caption-title" data-text="{%=file.cdesc%}">{%=file.cdesc%}</span>
								</div>
							</span>
						</div>
					{% } %}
					<div class="col-md-12">
						<div class="container">
							<span class="pull-right delete"> 
								<button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
									<i class="icon-trash icon-white"></i>
									<span>{%=locale.fileupload.destroy%}</span>
								</button>
								<?php if ($this->multiple) : ?><input type="checkbox" name="delete" value="1">
								<?php else: ?><input type="hidden" name="delete" value="1">
								<?php endif; ?>
							</span>
						{% } %}
						</div>
					</div>
				</div>
			</div>
		</td>
    </tr>
</script>

