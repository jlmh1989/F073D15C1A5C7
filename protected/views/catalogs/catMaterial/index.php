<?php
/* @var $this CatMaterialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Materials',
);

$this->menu=array(
	array('label'=>'Create CatMaterial', 'url'=>array('create')),
	array('label'=>'Manage CatMaterial', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Materiales</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=> array(
            'pk_material',
            'desc_material',
            array('name'=>'fk_type_material',
                'header'=>'Tipo Material',
                'type'=>'raw',
                'value'=>'$data->fkTypeMaterial->desc_cat_detail_es'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
)); ?>
