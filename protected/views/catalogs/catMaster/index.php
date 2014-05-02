<?php
/* @var $this CatMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Masters',
);

$this->menu=array(
	array('label'=>'Create CatMaster', 'url'=>array('create')),
	array('label'=>'Manage CatMaster', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Maestro</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=> array(
            'pk_cat_master',
            'desc_cat_master',
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
));
?>
