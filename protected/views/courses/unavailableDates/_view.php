<?php
/* @var $this UnavailableDatesController */
/* @var $data UnavailableDates */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_unavailable_dates')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_unavailable_dates), array('view', 'id'=>$data->pk_unavailable_dates)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initial_date')); ?>:</b>
	<?php echo CHtml::encode($data->initial_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_date')); ?>:</b>
	<?php echo CHtml::encode($data->final_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_course')); ?>:</b>
	<?php echo CHtml::encode($data->fk_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_unavailability_type')); ?>:</b>
	<?php echo CHtml::encode($data->fk_unavailability_type); ?>
	<br />


</div>