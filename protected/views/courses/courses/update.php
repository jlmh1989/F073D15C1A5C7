<?php
/* @var $this CoursesController */
/* @var $model Courses */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->pk_course=>array('view','id'=>$model->pk_course),
	'Update',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
        array('label'=>'Ver Progreso', 'url'=>array('progreso')),
);
/*
$this->menu=array(
	array('label'=>'List Courses', 'url'=>array('index')),
	array('label'=>'Create Courses', 'url'=>array('create')),
	array('label'=>'View Courses', 'url'=>array('view', 'id'=>$model->pk_course)),
	array('label'=>'Manage Courses', 'url'=>array('admin')),
);
 * 
 */
?>

<h3>Actualizar Datos del Curso</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>