<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */

$this->breadcrumbs=array(
	'Cat Status Classes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatStatusClass', 'url'=>array('index')),
	array('label'=>'Manage CatStatusClass', 'url'=>array('admin')),
);
?>

<h1>Crear Estatus de Clase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>