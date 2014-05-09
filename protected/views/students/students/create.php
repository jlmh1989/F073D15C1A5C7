<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Estudiantes', 'url'=>array('index')),
	array('label'=>'Alta estudiante', 'url'=>array('create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modelUser'=>$modelUser)); ?>