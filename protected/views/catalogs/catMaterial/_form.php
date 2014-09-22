<?php

/* @var $this CatMaterialController */
/* @var $model CatMaterial */
/* @var $modelML CatMaterial */
/* @var $dataProviderMD CatMaterialDetail */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-material-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <th class="zebra_th" style="text-align: center" colspan="4">
            <?= $model->isNewRecord ? 'CREAR MATERIAL' : 'ACTUALIZAR MATERIAL' ?>   
            </th>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($modelML,'fk_level'); ?></td>
            <td><?php echo $form->dropDownList($modelML,'fk_level', CatLevels::model()->getCatLevels(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($modelML,'fk_level'); ?></td>
            
            <td><?php echo $form->labelEx($model,'desc_material'); ?></td>
            <td width="250"><?php echo $form->textField($model,'desc_material',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'desc_material'); ?></td>

        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'fk_type_material'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_type_material', CatDetail::model()->getCatDetailsOptions(constantesCatalogos::TIPOS_MATERIAL, constantes::LANG), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_type_material'); ?></td>
            
            <td><?php echo $form->labelEx($modelML,'status'); ?></td>
            <td><?php echo $form->dropDownList($modelML,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($modelML,'status'); ?></td>
        </tr>
        <tr>
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<?php $this->endWidget(); ?>
    </table>
</div><!-- form -->

<?php 
if(!$model->isNewRecord){
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'cat-material-detail-grid',
        'dataProvider'=>$dataProviderMD,
        //'filter'=>$modelMD,
        'columns'=>array(
                'pk_material_detail',
                'material_code',
                'comment',
                'availability',
                'fk_cat_material',
                //array(
                //        'class'=>'CButtonColumn',
                //),
        ),
    ));
}