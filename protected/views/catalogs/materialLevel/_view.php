<?php
/* @var $this MaterialLevelController */
/* @var $data MaterialLevel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_material_level')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_material_level), array('view', 'id'=>$data->pk_material_level)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_level')); ?>:</b>
	<?php echo CHtml::encode($data->fk_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_material')); ?>:</b>
	<?php echo CHtml::encode($data->fk_material); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>