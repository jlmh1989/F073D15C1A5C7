<?php
/* @var $this CatLevelsController */
/* @var $data CatLevels */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_level')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_level), array('view', 'id'=>$data->pk_level)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_level')); ?>:</b>
	<?php echo CHtml::encode($data->desc_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_associated_book')); ?>:</b>
	<?php echo CHtml::encode($data->fk_associated_book); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_hours')); ?>:</b>
	<?php echo CHtml::encode($data->total_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>