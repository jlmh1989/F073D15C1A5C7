<?php
/* @var $this CoursesController */
/* @var $model Courses */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	'Create[Datos]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
        array('label'=>'Ver Progreso', 'url'=>array('progreso')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>