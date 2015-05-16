<?php
/* @var $this CatLevelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Niveles',
);

$this->menu=array(
	array('label'=>'Crear Nivel', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Nivel', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo Niveles</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'columns'=> array(
            'desc_level',
            /*
            array('name'=>'fk_associated_book',
                'header'=>'Libro Asociado',
                'type'=>'raw',
                'value'=>'$data->fkCatMaterial->desc_material'),
            */
            'total_hours',
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
                        'url'=>'Yii::app()->createUrl("catalogs/catLevels/updateDetail", array("id"=>$data->pk_level))',
                        'imageUrl'=>Yii::app()->baseUrl.'/images/detail.png',
                    ),
                ),
            ),
        ),
)); ?>
