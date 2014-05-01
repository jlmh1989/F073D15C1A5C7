<?php
/* @var $this CatMaterialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Materials',
);

$this->menu=array(
	array('label'=>'Create CatMaterial', 'url'=>array('create')),
	array('label'=>'Manage CatMaterial', 'url'=>array('admin')),
);
?>

<h1>Cat Materials</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
