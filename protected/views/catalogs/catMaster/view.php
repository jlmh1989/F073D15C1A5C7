<?php
/* @var $this CatMasterController */
/* @var $model CatMaster */

$this->breadcrumbs=array(
	'Catálogo Maestro'=>array('index'),
	$model->desc_cat_master,
);

$this->menu=array(
	array('label'=>'List CatMaster', 'url'=>array('index')),
	array('label'=>'Create CatMaster', 'url'=>array('create')),
	array('label'=>'Update CatMaster', 'url'=>array('update', 'id'=>$model->pk_cat_master)),
	array('label'=>'Delete CatMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_cat_master),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatMaster', 'url'=>array('admin')),
);
?>

<h1>View CatMaster #<?php echo $model->pk_cat_master; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_cat_master',
		'desc_cat_master',
		'status',
	),
)); ?>
