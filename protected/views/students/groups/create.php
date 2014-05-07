<?php
/* @var $this GroupsController */
/* @var $model Groups */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Crear Grupo', 'url'=>array('create')),
	array('label'=>'Grupos Activos', 'url'=>array('index')),
        array('label'=>'Grupos Inactivos', 'url'=>array('inactivo')),
);
?>

<h1>Crear Grupo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>