<?php
/* @var $this CatBssDayController */
/* @var $model CatBssDay */

$this->breadcrumbs=array(
	'Cat Bss Days'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatBssDay', 'url'=>array('index')),
	array('label'=>'Manage CatBssDay', 'url'=>array('admin')),
);
?>

<h1>Crear D&iacute;a Laboral</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>