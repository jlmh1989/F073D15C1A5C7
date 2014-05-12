<?php
/* @var $this CoursesController */
/* @var $model ClassroomAddress */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	'Create[Datos]',
        'Create[Horario]',
        'Create[Maestro]',
        'Create[Direccion]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
?>

<?php $this->renderPartial('_formDireccion',array('model'=>$model)); ?>