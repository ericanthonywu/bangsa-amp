<tr id="pollchoice-<?php echo $id ?>">
  <td class="weight">
    <?php echo CHtml::activeDropDownList($choice,"[$id]weight", $choice->weights, array('class'=>'form-control')); ?>
    <?php echo CHtml::error($choice,"[$id]weight"); ?>
  </td>
  <td class="labels">
    <?php echo CHtml::activeTextField($choice,"[$id]label",array('class'=>'form-control input-sm')); ?>
    <?php echo CHtml::error($choice,"[$id]label"); ?>
    <div class="errorMessage" style="display:none">You must enter a label.</div>
  </td>
  <td class="image">
    <?php if ($choice->image != ''): ?>
      <img src="<?php echo Yii::app()->baseUrl; ?>/images/uploads/polling/<?php echo $choice->image; ?>" alt="" style="max-width: 75px; height:auto;">
      <input type="hidden" name="Poll2Choiceimg2[][image]" value="<?php echo $choice->image ?>">
      <?php /*<input type="hidden" name="Poll2Choiceimg2[][id]" value="<?php echo $id ?>"> */ ?>
    <?php else: ?>
    <input type="file" name="Poll2Choice[][image]" required="required">
    <div class="errorMessage" style="display:none">Isilah foto kandidat polling</div>
    <?php endif; ?>
  </td>
  <td class="jumlah_rekayasa">
    <?php echo CHtml::activeTextField($choice,"[$id]jumlah_rekayasa",array('class'=>'form-control input-sm')); ?>
    <?php echo CHtml::error($choice,"[$id]jumlah_rekayasa"); ?>
    <div class="errorMessage" style="display:none">Isilah apabila ingin memanipulasi voting polling</div>
  </td>

  <td class="actions">
  <?php
    $deleteJs = 'jQuery("#pollchoice-'. $id .'").find("td").fadeOut(1000,function(){jQuery(this).parent().remove();}); return false;';

    if (isset($choice->id)) {
      // Add AJAX delete link
      echo CHtml::ajaxLink(
        'Hapus',
        array('/poll/poll2choice/delete', 'id' => $choice->id, 'ajax' => TRUE),
        array('type' => 'POST', 'success' => 'js:function(){'. $deleteJs .'}'),
        array('confirm' => 'Are you sure you want to delete this item?')
      );
    }
    else {
      // Model hasn't been created yet, so just remove the DOM element
      echo CHtml::link('Delete', '#', array('onclick' => 'js:'. $deleteJs));
    }
    // Add additional hidden fields
    echo CHtml::activeHiddenField($choice,"[$id]id");
  ?>
  </td>
</tr>
