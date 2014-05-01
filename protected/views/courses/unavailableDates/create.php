<?php
/* @var $this UnavailableDatesController */
/* @var $model UnavailableDates */

$this->breadcrumbs=array(
	'Unavailable Dates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UnavailableDates', 'url'=>array('index')),
	array('label'=>'Manage UnavailableDates', 'url'=>array('admin')),
);
?>

<h1>Create UnavailableDates</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>