<?php
/* @var $this CatRatesController */
/* @var $model CatRates */

$this->breadcrumbs=array(
	'Cat Rates'=>array('index'),
	$model->pk_rate,
);

$this->menu=array(
	array('label'=>'List CatRates', 'url'=>array('index')),
	array('label'=>'Create CatRates', 'url'=>array('create')),
	array('label'=>'Update CatRates', 'url'=>array('update', 'id'=>$model->pk_rate)),
	array('label'=>'Delete CatRates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_rate),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatRates', 'url'=>array('admin')),
);
?>

<h1>View CatRates #<?php echo $model->pk_rate; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_rate',
		'desc_tarifa',
		'rate',
	),
)); ?>
