<?php
/* @var $this MaterialsViewController */
/* @var $model MaterialsView */

$this->breadcrumbs=array(
	'Materials Views'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MaterialsView', 'url'=>array('index')),
	array('label'=>'Manage MaterialsView', 'url'=>array('admin')),
);
?>

<h1>Create MaterialsView</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>