<?php
/* @var $this OptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Options',
);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Options</h4>
				</div>
				<div class="panel-body">
					<table class="table table-condensed table-bordered table-hover">
						<?php echo CHtml::beginForm(); ?>
						<thead>
							<tr>
								<th colspan="2">Nama Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($options as $i=>$option): ?>
							<tr>
								<td>
									<label class="col-md-2 control-label" for="<?php echo $option->option_name .'-'. $option->option_id; ?>">
										<?php echo $option->option_name; ?>
									</label>
									<span class="col-md-10">
										<?php echo CHtml::activeTextField($option,"[$i]option_value",array('class'=>'form-control','id'=>$option->option_name .'-'. $option->option_id)); ?>
									</span>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<input type="submit" class="btn btn-default" value="Simpan" />
				</div>
				<?php echo CHtml::endForm(); ?>
			</div>
		</div>
	</div>
</div>
