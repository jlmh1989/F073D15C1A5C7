<?php
/* @var $this UnavailableDatesController */
/* @var $model UnavailableDates */

$this->breadcrumbs=array(
	'Unavailable Dates'=>array('index'),
	$model->pk_unavailable_dates=>array('view','id'=>$model->pk_unavailable_dates),
	'Update',
);

$this->menu=array(
	array('label'=>'List UnavailableDates', 'url'=>array('index')),
	array('label'=>'Create UnavailableDates', 'url'=>array('create')),
	array('label'=>'View UnavailableDates', 'url'=>array('view', 'id'=>$model->pk_unavailable_dates)),
	array('label'=>'Manage UnavailableDates', 'url'=>array('admin')),
);
?>

<h1>Update UnavailableDates <?php echo $model->pk_unavailable_dates; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>