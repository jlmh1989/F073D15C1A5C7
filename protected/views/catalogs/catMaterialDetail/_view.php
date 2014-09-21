<?php
/* @var $this CatMaterialDetailController */
/* @var $data CatMaterialDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_material_detail')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_material_detail), array('view', 'id'=>$data->pk_material_detail)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_code')); ?>:</b>
	<?php echo CHtml::encode($data->material_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('availability')); ?>:</b>
	<?php echo CHtml::encode($data->availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_cat_material')); ?>:</b>
	<?php echo CHtml::encode($data->fk_cat_material); ?>
	<br />


</div>