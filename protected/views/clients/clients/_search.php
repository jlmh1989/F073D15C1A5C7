<?php
/* @var $this ClientsController */
/* @var $model Clients */
/* @var $form CActiveForm */
?>

<div class="form">
<table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <tr>
        <th colspan="4" style="text-align: center">Filtrar resultado</th>
    </tr>
    <tr>
        
            <div class="row">
            <td width="120px"><?php echo $form->label($model,'fk_type_client'); ?></td>
            <td width="250px"><?php echo $form->dropDownList($model,'fk_type_client',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::TIPO_CLIENTE,  constantes::LANG), 
                array(
                    "tabindex" => "0",
                    "empty" => 'Todos'
                    )); ?></td>
	</div>
    
	<div class="row buttons">
            <td><?php echo CHtml::submitButton('Buscar'); ?></td>
            <td><?php //echo CHtml::submitButton('Exportar PDF', array('submit' => array('crearPdf'), 'target'=>'_blank'));?></td>
	</div>

<?php $this->endWidget(); ?>
    </tr>
</table>
</div><!-- search-form -->