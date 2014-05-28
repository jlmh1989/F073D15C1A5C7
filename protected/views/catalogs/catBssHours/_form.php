<?php
/* @var $this CatBssHoursController */
/* @var $model CatBssHours */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-bss-hours-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <td><?php echo $form->labelEx($model,'initial_hour'); ?></td>
            <td width="250px"><?php $this->widget('CMaskedTextField', array(
                                'model'=>$model,
                                'attribute'=>'initial_hour',
                                'value' => '00:00',
                                'mask' => '99:99',
                                'htmlOptions' => array('size' => 5)
                                )
                            ); ?>
            <?php echo $form->error($model,'initial_hour'); ?></td>

            <td><?php echo $form->labelEx($model,'final_hour'); ?></td>
            <td><?php $this->widget('CMaskedTextField', array(
                                'model'=>$model,
                                'attribute'=>'final_hour',
                                'value' => '00:00',
                                'mask' => '99:99',
                                'htmlOptions' => array('size' => 5)
                                )
                            ); ?>
            <?php echo $form->error($model,'final_hour'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'range_time'); ?></td>
            <td><?php $this->widget('CMaskedTextField', array(
                                'model'=>$model,
                                'attribute'=>'range_time',
                                'value' => '00:00',
                                'mask' => '99:99',
                                'htmlOptions' => array('size' => 5)
                                )
                            ); ?>
            <?php echo $form->error($model,'range_time'); ?></td>

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