<?php
/* @var $this CatMaterialController */
/* @var $model CatMaterial */
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
            <td><?php echo $form->labelEx($model,'desc_material'); ?></td>
            <td width="250"><?php echo $form->textField($model,'desc_material',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'desc_material'); ?></td>

            <td><?php echo $form->labelEx($model,'fk_type_material'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_type_material', CatDetail::model()->getCatDetailsOptions(constantesCatalogos::TIPOS_MATERIAL, constantes::LANG), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_type_material'); ?></td>
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