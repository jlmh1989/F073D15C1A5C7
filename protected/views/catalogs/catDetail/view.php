<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */

$this->breadcrumbs=array(
	'Cat Details'=>array('index'),
	$model->pk_cat_detail,
);

$this->menu=array(
	array('label'=>'List CatDetail', 'url'=>array('index')),
	array('label'=>'Create CatDetail', 'url'=>array('create')),
	array('label'=>'Update CatDetail', 'url'=>array('update', 'id'=>$model->pk_cat_detail)),
	array('label'=>'Delete CatDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_cat_detail),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatDetail', 'url'=>array('admin')),
);
?>

<h1>View CatDetail #<?php echo $model->pk_cat_detail; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_cat_detail',
		'desc_cat_detail_es',
		'desc_cat_detail_en',
		'status',
		'fk_cat_master',
	),
)); ?>
