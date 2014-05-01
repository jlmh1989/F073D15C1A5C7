<?php
/* @var $this CatBssHoursController */
/* @var $model CatBssHours */

$this->breadcrumbs=array(
	'Cat Bss Hours'=>array('index'),
	$model->pk_bss_hour,
);

$this->menu=array(
	array('label'=>'List CatBssHours', 'url'=>array('index')),
	array('label'=>'Create CatBssHours', 'url'=>array('create')),
	array('label'=>'Update CatBssHours', 'url'=>array('update', 'id'=>$model->pk_bss_hour)),
	array('label'=>'Delete CatBssHours', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_bss_hour),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatBssHours', 'url'=>array('admin')),
);
?>

<h1>View CatBssHours #<?php echo $model->pk_bss_hour; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_bss_hour',
		'initial_hour',
		'final_hour',
		'range_time',
		'status',
	),
)); ?>
