<?php
/* @var $this CatMaterialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Materials',
);

$this->menu=array(
	array('label'=>'Crear Material', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Material', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo Materiales</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=> array(
            array('name'=>'fkCatLevels',
                'header'=>'Nivel',
                'type'=>'raw',
                'value'=>'$data->fkCatLevels->desc_level'),
            array('name'=>'fkCatMaterial',
                'header'=>'Material',
                'type'=>'raw',
                'value'=>'$data->fkCatMaterial->desc_material'),
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
)); ?>
