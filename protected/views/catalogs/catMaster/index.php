<?php
/* @var $this CatMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catálogo Maestro',
);

$this->menu=array(
	array('label'=>'Crear Catálogo General', 'url'=>array('create')),
	array('label'=>'Ver Catálogo General', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo General</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'columns'=> array(
            'pk_cat_master',
            'desc_cat_master',
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update} {detalle}',
                'buttons'=>array(
                    'detalle' => array(
                        'label'=>'Ver Detalle',
                        'url'=>'Yii::app()->createUrl("catalogs/catMaster/updateDetail", array("id"=>$data->pk_cat_master))',
                        'imageUrl'=>Yii::app()->baseUrl.'/images/detail.png',
                    ),
                ),
            ),
        ),
));
