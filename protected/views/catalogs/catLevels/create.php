<?php
/* @var $this CatLevelsController */
/* @var $model CatLevels */

$this->breadcrumbs=array(
	'Cat Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatLevels', 'url'=>array('index')),
	array('label'=>'Manage CatLevels', 'url'=>array('admin')),
);
?>

<h1>Create CatLevels</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>