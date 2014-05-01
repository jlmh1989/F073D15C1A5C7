<?php
/* @var $this DocumentsTeachersController */
/* @var $model DocumentsTeachers */

$this->breadcrumbs=array(
	'Documents Teachers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentsTeachers', 'url'=>array('index')),
	array('label'=>'Manage DocumentsTeachers', 'url'=>array('admin')),
);
?>

<h1>Create DocumentsTeachers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>