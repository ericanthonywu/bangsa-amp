<div class="container">
	<div class="row">
		<div class="panel panel-green">
			<div class="panel-body">
				<div class="poll-results">
				<?php
				  foreach ($model->choices as $choice) {
					$this->renderPartial('/poll2choice/_resultsChoice', array(
					  'choice' => $choice,
					  'percent' => $model->totalVotes > 0 ? 100 * round($choice->votes / $model->totalVotes, 3) : 0,
					  'voteCount' => $choice->votes,
					));
				  }
				?>
				</div>
			</div>
		</div>
	</div><!-- row -->
</div><!-- container -->
