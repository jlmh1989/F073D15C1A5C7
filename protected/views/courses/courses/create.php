<?php
/* @var $this CoursesController */
/* @var $model Courses */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
/*
$this->menu=array(
	array('label'=>'List Courses', 'url'=>array('index')),
	array('label'=>'Manage Courses', 'url'=>array('admin')),
);
 * 
 */
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>