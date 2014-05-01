<?php
/* @var $this CatDocumentsController */
/* @var $model CatDocuments */

$this->breadcrumbs=array(
	'Cat Documents'=>array('index'),
	$model->pk_document=>array('view','id'=>$model->pk_document),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatDocuments', 'url'=>array('index')),
	array('label'=>'Create CatDocuments', 'url'=>array('create')),
	array('label'=>'View CatDocuments', 'url'=>array('view', 'id'=>$model->pk_document)),
	array('label'=>'Manage CatDocuments', 'url'=>array('admin')),
);
?>

<h1>Update CatDocuments <?php echo $model->pk_document; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>