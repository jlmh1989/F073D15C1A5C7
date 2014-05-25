<?php
/* @var $this CoursesController */
/* @var $model ClassroomAddress */
$msj = 'Crear';
if($_SESSION['curso']['curso']['operacion'] === 'update'){
    $msj = 'Modificar';
}
$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$msj.'[Datos]',
        $msj.'[Horario]',
        $msj.'[Maestro]',
        $msj.'[Direccion]',
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
?>

<?php $this->renderPartial('_formDireccion',array('model'=>$model)); ?>