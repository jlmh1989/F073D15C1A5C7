<?php
/* @var $this CatDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Details',
);

$this->menu=array(
	array('label'=>'Create CatDetail', 'url'=>array('create')),
	array('label'=>'Manage CatDetail', 'url'=>array('admin')),
);
?>

<h1>Cat Details</h1>

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
            'pk_cat_detail',
            'desc_cat_detail_es',
            'desc_cat_detail_en',
            'status',
            'fk_cat_master',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
));
?>
