<?php
/* @var $this CatStatusClassController */
/* @var $data CatStatusClass */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_status_class')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_status_class), array('view', 'id'=>$data->pk_status_class)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_status_class')); ?>:</b>
	<?php echo CHtml::encode($data->desc_status_class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('long_desc')); ?>:</b>
	<?php echo CHtml::encode($data->long_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_reschedule_motive')); ?>:</b>
	<?php echo CHtml::encode($data->is_reschedule_motive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_type_class')); ?>:</b>
	<?php echo CHtml::encode($data->fk_type_class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_role_class')); ?>:</b>
	<?php echo CHtml::encode($data->fk_role_class); ?>
	<br />


</div>