<?php $this->render('results', array('model' => $model)); ?>

<?php if ($userVote->id): ?>
  <p id="pollvote-<?php echo $userVote->id ?>">
    Anda memilih: <strong><?php echo $userChoice->label ?></strong>.<br />
  </p>
<?php else: ?>
  <p><?php echo CHtml::link('Vote', array('/poll/poll/vote', 'id' => $model->id)); ?></p>
<?php endif; ?>
