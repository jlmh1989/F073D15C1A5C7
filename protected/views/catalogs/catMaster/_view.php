<?php
/* @var $this CatMasterController */
/* @var $data CatMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_cat_master')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_cat_master), array('view', 'id'=>$data->pk_cat_master)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_cat_master')); ?>:</b>
	<?php echo CHtml::encode($data->desc_cat_master); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>