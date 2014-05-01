<?php
/* @var $this CatLevelDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Level Details',
);

$this->menu=array(
	array('label'=>'Create CatLevelDetail', 'url'=>array('create')),
	array('label'=>'Manage CatLevelDetail', 'url'=>array('admin')),
);
?>

<h1>Cat Level Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
