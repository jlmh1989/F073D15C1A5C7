<?php
/* @var $this StudentsGroupController */
/* @var $model StudentsGroup */

$this->breadcrumbs=array(
	'Students Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentsGroup', 'url'=>array('index')),
	array('label'=>'Manage StudentsGroup', 'url'=>array('admin')),
);
?>

<h1>Create StudentsGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>