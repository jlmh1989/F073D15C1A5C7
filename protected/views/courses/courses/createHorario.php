<?php
/* @var $this CoursesController */
$msj = 'Crear';
if($_SESSION['curso']['curso']['operacion'] === 'update'){
    $msj = 'Modificar';
}
$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$msj.'[Datos]',
        $msj.'[Horario]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
?>

<?php $this->renderPartial('_formHorario'); ?>