<?php
/* @var $this CatRatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Rates',
);

$this->menu=array(
	array('label'=>'Crear Tarifa', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Tarifa', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo Tarifa</h1>
 
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> array(
            'pk_rate',
            'desc_tarifa',
            array('name'=>'rate',
                'header'=>'Tarifa',
                'type'=>'raw',
                'value'=>'$data->rate'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
)); ?>
