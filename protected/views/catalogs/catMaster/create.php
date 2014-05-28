<?php
/* @var $this CatMasterController */
/* @var $model CatMaster */

$this->breadcrumbs=array(
	'Cat Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatMaster', 'url'=>array('index')),
	array('label'=>'Manage CatMaster', 'url'=>array('admin')),
);
?>

<h1>Crear Cat&aacute;logo Maestro</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>