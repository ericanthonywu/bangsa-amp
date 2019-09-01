<?php
/* @var $this ContactController */
/* @var $data Contact */
?>
	<?php if( $data->users_id == Yii::app()->user->id ):?>
		<tr class="<?php if( $data->is_read == 0) echo "active"; ?>">
			<td><?php echo CHtml::encode($data->name); ?></td>
			<td><?php echo CHtml::encode($data->email); ?></td>
			<td><?php echo CHtml::encode($data->subject); ?></td>
			<td><?php echo CHtml::encode($data->quiry_date); ?></td>
			<td align="center"><a href="<?php echo Yii::app()->createUrl('contact/view/'.$data->id);?>">Baca</a></td>
		</tr>
	<?php endif; ?>