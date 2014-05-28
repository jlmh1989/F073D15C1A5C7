<?php
/* @var $this CatLevelDetailController */
/* @var $model CatLevelDetail */
/* @var $form CActiveForm */
?>

<div class="form">
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
            <td><?php echo $form->labelEx($model,'fk_level'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_level', CatLevels::model()->getCatLevels(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_level'); ?></td>

            <td><?php echo $form->labelEx($model,'topics'); ?></td>
            <td><?php echo $form->textField($model,'topics',array('size'=>60,'maxlength'=>100)); ?>
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
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<?php $this->endWidget(); ?>
    </table>
</div><!-- form -->