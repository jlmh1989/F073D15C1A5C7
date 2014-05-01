<?php
/* @var $this UnavailableDatesController */
/* @var $model UnavailableDates */

$this->breadcrumbs=array(
	'Unavailable Dates'=>array('index'),
	$model->pk_unavailable_dates,
);

$this->menu=array(
	array('label'=>'List UnavailableDates', 'url'=>array('index')),
	array('label'=>'Create UnavailableDates', 'url'=>array('create')),
	array('label'=>'Update UnavailableDates', 'url'=>array('update', 'id'=>$model->pk_unavailable_dates)),
	array('label'=>'Delete UnavailableDates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_unavailable_dates),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UnavailableDates', 'url'=>array('admin')),
);
?>

<h1>View UnavailableDates #<?php echo $model->pk_unavailable_dates; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_unavailable_dates',
		'initial_date',
		'final_date',
		'fk_course',
		'status',
		'fk_unavailability_type',
	),
)); ?>
