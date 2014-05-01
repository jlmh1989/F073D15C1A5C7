<?php
/* @var $this CatDocumentsController */
/* @var $model CatDocuments */

$this->breadcrumbs=array(
	'Cat Documents'=>array('index'),
	$model->pk_document,
);

$this->menu=array(
	array('label'=>'List CatDocuments', 'url'=>array('index')),
	array('label'=>'Create CatDocuments', 'url'=>array('create')),
	array('label'=>'Update CatDocuments', 'url'=>array('update', 'id'=>$model->pk_document)),
	array('label'=>'Delete CatDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_document),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatDocuments', 'url'=>array('admin')),
);
?>

<h1>View CatDocuments #<?php echo $model->pk_document; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_document',
		'desc_document',
		'status',
	),
)); ?>
