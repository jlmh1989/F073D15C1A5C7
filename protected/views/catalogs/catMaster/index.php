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

<h1>Cat Masters</h1>

<?php 
/*
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=> array(
            'pk_cat_master',
            'desc_cat_master',
            'status',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
));
?>
