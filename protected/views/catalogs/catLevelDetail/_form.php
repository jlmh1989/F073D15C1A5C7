<?php
/* @var $this CatLevelDetailController */
/* @var $model CatLevelDetail */
/* @var $modelTbl CatLevelDetail */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/js/jsNotifications/ext/jboesch-Gritter/css/jquery.gritter.css');
$cs->registerScriptFile($baseUrl.'/js/jsNotifications/ext/jboesch-Gritter/js/jquery.gritter.min.js');
$cs->registerScriptFile($baseUrl.'/js/jsNotifications/jsNotifications.js');

Yii::app()->clientScript->registerScript('script',
        $model->getEstatusValidacion() === FALSE ? '$("#form").hide();' : '$("#nuevo").hide();',
        CClientScript::POS_READY);
?>
<script>
    function nuevo(){
        $("#nuevo").hide();
        $("#CatLevelDetail_duration").val('');
        $("#CatLevelDetail_topics").val('');
        $("#CatLevelDetail_unit").val('');
        $("#CatLevelDetail_pages").val('');
        $("#CatLevelDetail_is_exam").val('');
        $("#CatLevelDetail_status").val('');
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
	'id'=>'cat-level-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <th colspan="4" class="zebra_th" style="text-align: center"><?= $model->isNewRecord ? 'Nuevo Detalle Nivel' : 'Editar Detalle Nivel' ?></th>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'fk_level'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_level', CatLevels::model()->getCatLevels(),array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        "disabled"=>true
                    ));?>
            <?php echo $form->error($model,'fk_level'); ?></td>

            <td><?php echo $form->labelEx($model,'topics'); ?></td>
            <td><?php echo $form->textArea($model,'topics',array('rows'=>4, 'maxlength'=>100, 'style' => 'resize: none')); ?>
            <?php echo $form->error($model,'topics'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'duration'); ?></td>
            <td><?php $this->widget('CMaskedTextField', array(
                                'model'=>$model,
                                'attribute'=>'duration',
                                'value' => '00:00',
                                'mask' => '99:99',
                                'htmlOptions' => array('size' => 5)
                                )
                            ); ?>
            <?php echo $form->error($model,'duration'); ?></td>

            <td><?php echo $form->labelEx($model,'unit'); ?></td>
            <td><?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'unit'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'pages'); ?></td>
            <td><?php echo $form->textField($model,'pages',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'pages'); ?></td>
        
            <td><?php echo $form->labelEx($model,'is_exam'); ?></td>
            <td><?php echo $form->dropDownList($model,'is_exam', constantes::getOpcionSiNo(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'is_exam'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'status'); ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><?php echo CHtml::submitButton('Guardar'); ?></td>
            <td><div class="boton" id="cancelar" onclick="cancelar()">Cancelar</div></td>
            <td></td>
            <td></td>
        </tr>
<?php $this->endWidget(); ?>
    </table>
</div><!-- form -->
<div class="boton" id="nuevo" onclick="nuevo()">Crear Nuevo</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$modelTbl->search(),
	//'filter'=>$model,
	'columns'=> array(
            'topics',
            'duration',
            'unit',
            'pages',
            array('name'=>'is_exam',
                'header'=>'Es examen',
                'type'=>'raw',
                'value'=>'constantes::$opcion_si_no[$data->is_exam]'),
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
));?>