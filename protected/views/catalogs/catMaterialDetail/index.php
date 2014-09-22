<?php
/* @var $this CatMaterialDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Catálogo Material'=>array("catalogs/catMaterial/index"),
	'Material Detalle',
);

$this->menu=array(
	array('label'=>'Crear Material Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Material', 'url'=>Yii::app()->createUrl("catalogs/catMaterial/index")),
);
?>

<h2>Detalle de Materiales - <?= $_SESSION['CatMaterial']['desc_material'] ?></h2>

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
		array('name'=>'availability',
                    'type'=>'raw',
                    'value'=>'constantes::$opcion_estado_material[$data->availability]'),
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update} {delete}',  	
		),
	),
)); ?>