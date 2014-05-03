<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->name=>array('view','id'=>$model->pk_student),
	'Update',
);

$this->menu=array(
	array('label'=>'List Students', 'url'=>array('index')),
	array('label'=>'Create Students', 'url'=>array('create')),
	array('label'=>'View Students', 'url'=>array('view', 'id'=>$model->pk_student)),
	array('label'=>'Manage Students', 'url'=>array('admin')),
);
?>

<h3>Actualizar datos del Estudiante</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'modelUser'=>$modelUser,)); ?>