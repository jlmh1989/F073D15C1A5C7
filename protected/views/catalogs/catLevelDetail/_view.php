<?php
/* @var $this CatLevelDetailController */
/* @var $data CatLevelDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_level_detail')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_level_detail), array('view', 'id'=>$data->pk_level_detail)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_level')); ?>:</b>
	<?php echo CHtml::encode($data->fk_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('topics')); ?>:</b>
	<?php echo CHtml::encode($data->topics); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages')); ?>:</b>
	<?php echo CHtml::encode($data->pages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_exam')); ?>:</b>
	<?php echo CHtml::encode($data->is_exam); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>