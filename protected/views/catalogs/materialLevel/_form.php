<?php
/* @var $this MaterialLevelController */
/* @var $model MaterialLevel */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'material-level-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <td><?php echo $form->labelEx($model,'fk_level'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_level', CatLevels::model()->getCatLevels(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_level'); ?></td>

            <td><?php echo $form->labelEx($model,'fk_material'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_material', CatMaterial::model()->getCatMaterial(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_material'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'status'); ?></td>
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