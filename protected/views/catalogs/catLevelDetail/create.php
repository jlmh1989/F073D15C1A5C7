<?php
/* @var $this CatLevelDetailController */
/* @var $model CatLevelDetail */

$this->breadcrumbs=array(
	'Cat Level Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatLevelDetail', 'url'=>array('index')),
	array('label'=>'Manage CatLevelDetail', 'url'=>array('admin')),
);
?>

<h1>Crear Detalle Nivel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>