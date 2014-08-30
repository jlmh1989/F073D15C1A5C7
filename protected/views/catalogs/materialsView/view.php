<?php
/* @var $this MaterialsViewController */
/* @var $model MaterialsView */

$this->breadcrumbs=array(
	'Materials Views'=>array('index'),
	$model->pk_material,
);

$this->menu=array(
	array('label'=>'List MaterialsView', 'url'=>array('index')),
	array('label'=>'Create MaterialsView', 'url'=>array('create')),
	array('label'=>'Update MaterialsView', 'url'=>array('update', 'id'=>$model->pk_material)),
	array('label'=>'Delete MaterialsView', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_material),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MaterialsView', 'url'=>array('admin')),
);
?>

<h1>View MaterialsView #<?php echo $model->pk_material; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_material',
		'desc_material',
		'fk_type_material',
		'desc_cat_detail_es',
		'total_stock',
		'actual_stock',
		'desc_level',
	),
)); ?>
