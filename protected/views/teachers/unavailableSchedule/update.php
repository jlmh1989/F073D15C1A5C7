<?php
/* @var $this UnavailableScheduleController */
/* @var $model UnavailableSchedule */

$this->breadcrumbs=array(
	'Unavailable Schedules'=>array('index'),
	$model->pk_unavailable_schedule=>array('view','id'=>$model->pk_unavailable_schedule),
	'Update',
);

$this->menu=array(
	array('label'=>'List UnavailableSchedule', 'url'=>array('index')),
	array('label'=>'Create UnavailableSchedule', 'url'=>array('create')),
	array('label'=>'View UnavailableSchedule', 'url'=>array('view', 'id'=>$model->pk_unavailable_schedule)),
	array('label'=>'Manage UnavailableSchedule', 'url'=>array('admin')),
);
?>

<h1>Update UnavailableSchedule <?php echo $model->pk_unavailable_schedule; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>