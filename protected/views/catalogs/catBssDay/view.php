<?php
/* @var $this CatBssDayController */
/* @var $model CatBssDay */

$this->breadcrumbs=array(
	'Cat Bss Days'=>array('index'),
	$model->pk_bss_day,
);

$this->menu=array(
	array('label'=>'List CatBssDay', 'url'=>array('index')),
	array('label'=>'Create CatBssDay', 'url'=>array('create')),
	array('label'=>'Update CatBssDay', 'url'=>array('update', 'id'=>$model->pk_bss_day)),
	array('label'=>'Delete CatBssDay', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_bss_day),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatBssDay', 'url'=>array('admin')),
);
?>

<h1>View CatBssDay #<?php echo $model->pk_bss_day; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_bss_day',
		'desc_day',
		'initial_hour',
		'final_hour',
		'range_time',
		'status',
	),
)); ?>
