<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */
/* @var $form CActiveForm */
/* @var $modelTbl CatDetail */

Yii::app()->clientScript->registerScript('script',
        $model->getEstatusValidacion() === FALSE ? '$("#form").hide();' : '$("#nuevo").hide();',
        CClientScript::POS_READY);
?>
<script>
    function nuevo(){
        $("#nuevo").hide();
        $("#CatDetail_desc_cat_detail_es").val('');
        $("#CatDetail_desc_cat_detail_en").val('');
        $("#CatDetail_status").val('');
        $("#form").show('slow');
    }
    
    function cancelar(){
        $("#nuevo").show();
        $("#form").hide('slow');
    }
</script>
<div class="form" id="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <th class="zebra_th" style="text-align: center" colspan="4"><?= $model->isNewRecord ? 'Nuevo ' : 'Editar ' ?>C&aacute;talogo Detalle</th>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'fk_cat_master'); ?></td>
		<td><?php echo $form->dropDownList($model,'fk_cat_master', CatMaster::model()->getCatMaster(), array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        "disabled"=>true )); ?>
		<?php echo $form->error($model,'fk_cat_master'); ?></td>
            <td><?php echo $form->labelEx($model,'desc_cat_detail_es'); ?></td>
		<td width="240px"><?php echo $form->textField($model,'desc_cat_detail_es',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'desc_cat_detail_es'); ?></td>
            
        </tr>
        
        <tr>
            <td><?php echo $form->labelEx($model,'desc_cat_detail_en'); ?></td>
		<td><?php echo $form->textField($model,'desc_cat_detail_en',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'desc_cat_detail_en'); ?></td>
                
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'status'); ?></td>

            
        </tr>
        
        <tr>
	<div class="row buttons">
            <td><?php echo CHtml::submitButton('Guardar'); ?></td>
            <td><div class="boton" id="cancelar" onclick="cancelar()">Cancelar</div></td>
            <td></td>
            <td></td>
	</div>
        </tr>

<?php $this->endWidget(); ?>
</table>
</div><!-- form -->

<div class="boton" id="nuevo" onclick="nuevo()">Crear Nuevo</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$modelTbl->search(),
	//'filter'=>$model,
        'columns'=> array(
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
                'buttons'=>array(
                    'update' => array(
                        'url'=>'Yii::app()->createUrl("catalogs/catDetail/updateByMaster", array("id"=>$data->pk_cat_detail))',
                    ),
                ),
            ),
        ),
));