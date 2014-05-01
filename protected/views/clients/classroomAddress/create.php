<?php
/* @var $this ClassroomAddressController */
/* @var $model ClassroomAddress */

$this->breadcrumbs=array(
	'Classroom Addresses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClassroomAddress', 'url'=>array('index')),
	array('label'=>'Manage ClassroomAddress', 'url'=>array('admin')),
);
?>

<h1>Create ClassroomAddress</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>