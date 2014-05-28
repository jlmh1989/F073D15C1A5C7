<?php
/* @var $this CatBssHoursController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Bss Hours',
);
$this->menu=array(
	array('label'=>'Crear Hora Laboral', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Hora Laboral', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'Create CatBssHours', 'url'=>array('create')),
	array('label'=>'Manage CatBssHours', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Horas Laborales</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> array(
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
