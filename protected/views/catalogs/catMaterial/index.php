<?php
/* @var $this CatMaterialController */
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
	'filter'=>$model,
	'columns'=> array(
            'pk_material',
            'desc_material',
            array('name'=>'fk_type_material',
                'header'=>'Tipo Material',
                'type'=>'raw',
                'value'=>'$data->fkTypeMaterial->desc_cat_detail_es'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
)); ?>
