<div class="block-polling mt1 mb1">
	<div class="top-block-polling" id="widgetPolling">
		<div class="title-block-polling">
			<h3><a href="">ONLINE VISITOR</a></h3>
			<div class="clearfix"></div>
		</div>
		<?php 
		$this->widget('ext.gaCounter.ExtGoogleAnalyticsCounter', array(
			'strTotalVisits' => 'Total Pengunjung',
			'strDayVisits' => 'Pengunjung Hari Ini',
		));?>
	</div>
</div>

