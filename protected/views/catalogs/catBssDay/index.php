<?php
/* @var $this CatBssDayController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Bss Days',
);

$this->menu=array(
        array('label'=>'Ver Catálogo Día Laboral', 'url'=>array('index')),
	array('label'=>'Crear Día Laboral', 'url'=>array('create')),
);
/*
$this->menu=array(
	array('label'=>'Create CatBssDay', 'url'=>array('create')),
	array('label'=>'Manage CatBssDay', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>D&iacute;as Laborales</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> array(
            'desc_day',
            'initial_hour',
            'final_hour',
            'range_time',
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
