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

<h1>Detalle de Materiales</h1>

<!-- ?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ? -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cat-material-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pk_material_detail',
		'material_code',
		'comment',
		'availability',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>