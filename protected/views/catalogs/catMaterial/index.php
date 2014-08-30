<?php
/* @var $this MaterialsViewController */
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
            'pk_material',
            'desc_material',
            'desc_cat_detail_es',
            'total_stock',
            'actual_stock',
            'desc_level',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
)); ?>
