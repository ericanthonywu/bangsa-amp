<?php $this->beginContent(Rights::module()->appLayout); ?>


	<div id="content">


		<?php $this->renderPartial('/_flash'); ?>

		<?php echo $content; ?>
		
		<?php if( $this->id!=='install' ): ?>

			<div id="form-group">

				<?php $this->renderPartial('/_menu'); ?>

			</div>

		<?php endif; ?>

	</div><!-- content -->


<?php $this->endContent(); ?>