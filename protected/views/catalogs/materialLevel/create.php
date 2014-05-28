<?php
/* @var $this MaterialLevelController */
/* @var $model MaterialLevel */

$this->breadcrumbs=array(
	'Material Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MaterialLevel', 'url'=>array('index')),
	array('label'=>'Manage MaterialLevel', 'url'=>array('admin')),
);
?>

<h1>Crear Material por Nivel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>