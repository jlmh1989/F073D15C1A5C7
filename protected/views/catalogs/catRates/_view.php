<?php
/* @var $this CatRatesController */
/* @var $data CatRates */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_rate')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pk_rate), array('view', 'id'=>$data->pk_rate)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_tarifa')); ?>:</b>
	<?php echo CHtml::encode($data->desc_tarifa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />


</div>