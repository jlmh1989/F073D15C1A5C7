<?php
/* @var $this MaterialsViewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catálogo Material',
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
            'pk_material',
            'desc_material',
            'desc_cat_detail_es',
            'total_stock',
            'actual_stock',
            'desc_level',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update} {detalle}',             
                'buttons'=>array(
                    'detalle' => array(
                        'label'=>'Ver Detalle',
                        'url'=>'Yii::app()->createUrl("catalogs/catMaterial/updateDetail", array("id"=>$data->pk_material))',
                        'imageUrl'=>Yii::app()->baseUrl.'/images/detail.png',
                    ),
                ),                
		),
        ),
)); ?>
