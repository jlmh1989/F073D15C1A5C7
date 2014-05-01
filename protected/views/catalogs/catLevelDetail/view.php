<?php
/* @var $this CatLevelDetailController */
/* @var $model CatLevelDetail */

$this->breadcrumbs=array(
	'Cat Level Details'=>array('index'),
	$model->pk_level_detail,
);

$this->menu=array(
	array('label'=>'List CatLevelDetail', 'url'=>array('index')),
	array('label'=>'Create CatLevelDetail', 'url'=>array('create')),
	array('label'=>'Update CatLevelDetail', 'url'=>array('update', 'id'=>$model->pk_level_detail)),
	array('label'=>'Delete CatLevelDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_level_detail),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatLevelDetail', 'url'=>array('admin')),
);
?>

<h1>View CatLevelDetail #<?php echo $model->pk_level_detail; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_level_detail',
		'fk_level',
		'topics',
		'duration',
		'unit',
		'pages',
		'is_exam',
		'status',
	),
)); ?>
