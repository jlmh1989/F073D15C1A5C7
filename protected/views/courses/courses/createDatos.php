<?php
/* @var $this CoursesController */
/* @var $model CursoDatos */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	'Create[Datos]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
?>

<?php $this->renderPartial('_formDatos', array('model'=>$model)); ?>