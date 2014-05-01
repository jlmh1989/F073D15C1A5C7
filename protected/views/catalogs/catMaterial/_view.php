<?php
/* @var $this CatMaterialController */
/* @var $data CatMaterial */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_material')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_material), array('view', 'id'=>$data->pk_material)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_material')); ?>:</b>
	<?php echo CHtml::encode($data->desc_material); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_type_material')); ?>:</b>
	<?php echo CHtml::encode($data->fk_type_material); ?>
	<br />


</div>