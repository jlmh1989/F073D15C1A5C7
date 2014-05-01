<?php
/* @var $this UnavailableScheduleController */
/* @var $model UnavailableSchedule */

$this->breadcrumbs=array(
	'Unavailable Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UnavailableSchedule', 'url'=>array('index')),
	array('label'=>'Manage UnavailableSchedule', 'url'=>array('admin')),
);
?>

<h1>Create UnavailableSchedule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>