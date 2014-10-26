<?php
/* @var $this CoursesController */
/* @var $model CursoMaestro */
$msj = 'Crear';
if($_SESSION['curso']['curso']['operacion'] === 'update'){
    $msj = 'Modificar';
}
$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$msj.'[Datos]',
        $msj.'[Horario]',
        $msj.'[Maestro]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
        array('label'=>'Ver Progreso', 'url'=>array('progreso')),
);
?>

<?php $this->renderPartial('_formMaestro',array('model'=>$model)); ?>