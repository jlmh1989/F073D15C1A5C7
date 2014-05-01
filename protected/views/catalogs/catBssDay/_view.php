<?php
/* @var $this CatBssDayController */
/* @var $data CatBssDay */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_bss_day')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_bss_day), array('view', 'id'=>$data->pk_bss_day)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_day')); ?>:</b>
	<?php echo CHtml::encode($data->desc_day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initial_hour')); ?>:</b>
	<?php echo CHtml::encode($data->initial_hour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_hour')); ?>:</b>
	<?php echo CHtml::encode($data->final_hour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('range_time')); ?>:</b>
	<?php echo CHtml::encode($data->range_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>