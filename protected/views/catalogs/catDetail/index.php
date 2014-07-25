<?php
/* @var $this CatDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catálogo Detalle',
);

$this->menu=array(
	array('label'=>'Crear Catálogo Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Detalle', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo Detalle</h1>

<?php 
/*
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'columns'=> array(
            'pk_cat_detail',
            'desc_cat_detail_es',
            'desc_cat_detail_en',
            array('name'=>'fk_cat_master',
                'header'=>'Cat&aacute;logo Maestro',
                'type'=>'raw',
                'filter'=>CHtml::listData(CatMaster::model()->findAll(), 'pk_cat_master' , 'desc_cat_master'),
                'value'=>'CatMaster::model()->findByPk($data->fk_cat_master)->desc_cat_master'),
                //'value'=>'$data->fkCatMaster->desc_cat_master'),
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
));
?>
