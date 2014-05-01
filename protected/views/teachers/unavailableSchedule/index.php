<?php
/* @var $this UnavailableScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unavailable Schedules',
);

$this->menu=array(
	array('label'=>'Create UnavailableSchedule', 'url'=>array('create')),
	array('label'=>'Manage UnavailableSchedule', 'url'=>array('admin')),
);
?>

<h1>Unavailable Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
