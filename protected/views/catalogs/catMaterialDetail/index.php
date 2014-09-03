<?php
/* @var $this CatMaterialDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Material Details',
);

$this->menu=array(
	array('label'=>'Create CatMaterialDetail', 'url'=>array('create')),
	array('label'=>'Manage CatMaterialDetail', 'url'=>array('admin')),
);
?>

<h1>Cat Material Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
