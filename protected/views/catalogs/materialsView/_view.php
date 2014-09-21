<?php
/* @var $this MaterialsViewController */
/* @var $data MaterialsView */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_cat_detail_es')); ?>:</b>
	<?php echo CHtml::encode($data->desc_cat_detail_es); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_stock')); ?>:</b>
	<?php echo CHtml::encode($data->total_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actual_stock')); ?>:</b>
	<?php echo CHtml::encode($data->actual_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_level')); ?>:</b>
	<?php echo CHtml::encode($data->desc_level); ?>
	<br />


</div>