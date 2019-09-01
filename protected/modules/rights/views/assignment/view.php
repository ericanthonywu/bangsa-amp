<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Assignments'),
); ?>
<?php 
//$this->widget('ext.gaCounter.ExtGoogleAnalyticsCounter', array(
			//'strTotalVisits' => 'Total Pengunjung',
			//'strDayVisits' => 'Pengunjung Hari Ini',
		//));?>
	<h4>Level Admin</h4>
	<!--<h4>Here you can view which permissions has been assigned to each user.</h4>-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<h4>Assignments</h4>
				</div>
				<div class="panel-body">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'dataProvider'=>$dataProvider,
						'template'=>"{items}\n{pager}",
						'emptyText'=>Rights::t('core', 'No users found.'),
						'htmlOptions'=>array('class'=>''),
						'itemsCssClass'=>'table table-condensed table-striped table-bordered table-hover',
						'columns'=>array(
							array(
								'name'=>'name',
								'header'=>'Username',
								'type'=>'raw',
								'htmlOptions'=>array('class'=>'name-column'),
								'value'=>'$data->getAssignmentNameLink()',
							),
							array(
								'name'=>'assignments',
								'header'=>'Level',
								'type'=>'raw',
								'htmlOptions'=>array('class'=>'role-column'),
								'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
							),
							array(
								'name'=>'assignments',
								'header'=>Rights::t('core', 'Tasks'),
								'type'=>'raw',
								'htmlOptions'=>array('class'=>'task-column'),
								'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
							),
							array(
								'name'=>'assignments',
								'header'=>Rights::t('core', 'Operations'),
								'type'=>'raw',
								'htmlOptions'=>array('class'=>'operation-column'),
								'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
							),
						)
					)); ?>
				</div>
			</div>
		</div>
	</div>