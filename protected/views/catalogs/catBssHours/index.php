<?php
/* @var $this CatBssHoursController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Bss Hours',
);

$this->menu=array(
	array('label'=>'Create CatBssHours', 'url'=>array('create')),
	array('label'=>'Manage CatBssHours', 'url'=>array('admin')),
);
?>

<h1>Horas Laborales</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
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
                'template'=>'{view}',
		),
        ),
)); ?>
