<?php
/* @var $this CatDetailController */
/* @var $data CatDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_cat_detail')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_cat_detail), array('view', 'id'=>$data->pk_cat_detail)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_cat_detail_es')); ?>:</b>
	<?php echo CHtml::encode($data->desc_cat_detail_es); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_cat_detail_en')); ?>:</b>
	<?php echo CHtml::encode($data->desc_cat_detail_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_cat_master')); ?>:</b>
	<?php echo CHtml::encode($data->fk_cat_master); ?>
	<br />


</div>