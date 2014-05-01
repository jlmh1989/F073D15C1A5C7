<?php
/* @var $this CatDocumentsController */
/* @var $model CatDocuments */

$this->breadcrumbs=array(
	'Cat Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatDocuments', 'url'=>array('index')),
	array('label'=>'Manage CatDocuments', 'url'=>array('admin')),
);
?>

<h1>Create CatDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>