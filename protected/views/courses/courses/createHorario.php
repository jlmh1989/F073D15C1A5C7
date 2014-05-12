<?php
/* @var $this CoursesController */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	'Create[Datos]',
        'Create[Horario]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
?>

<?php $this->renderPartial('_formHorario'); ?>