<?php
/* @var $this GroupsController */
/* @var $data Groups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_group')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_group), array('view', 'id'=>$data->pk_group)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_group')); ?>:</b>
	<?php echo CHtml::encode($data->desc_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>