<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->name=>array('view','id'=>$model->pk_student),
	'Update',
);

$this->menu=array(
	array('label'=>'Estudiantes', 'url'=>array('index')),
	array('label'=>'Alta estudiante', 'url'=>array('create')),
);
?>

<h3>Actualizar datos del Estudiante</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'modelUser'=>$modelUser,)); ?>