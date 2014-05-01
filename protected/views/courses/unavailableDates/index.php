<?php
/* @var $this UnavailableDatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unavailable Dates',
);

$this->menu=array(
	array('label'=>'Create UnavailableDates', 'url'=>array('create')),
	array('label'=>'Manage UnavailableDates', 'url'=>array('admin')),
);
?>

<h1>Unavailable Dates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
