<?php
/* @var $this CatBssHoursController */
/* @var $model CatBssHours */

$this->breadcrumbs=array(
	'Cat Bss Hours'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatBssHours', 'url'=>array('index')),
	array('label'=>'Manage CatBssHours', 'url'=>array('admin')),
);
?>

<h1>Create CatBssHours</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>