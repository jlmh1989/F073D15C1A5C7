<?php
/* @var $this AssistanceRecordController */
/* @var $model AssistanceRecord */

$this->breadcrumbs=array(
	'Assistance Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AssistanceRecord', 'url'=>array('index')),
	array('label'=>'Manage AssistanceRecord', 'url'=>array('admin')),
);
?>

<h1>Create AssistanceRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>