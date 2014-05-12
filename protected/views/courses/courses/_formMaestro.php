<?php
/* @var $this CoursesController */
/* @var $model CursoMaestro */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('script',
        '
        $("#irAtras").click(function(){
            $(location).attr("href","'.Yii::app()->createUrl('courses/courses/createHorario').'");
        });
        
        '); 
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'action' => Yii::app()->createUrl('courses/courses/asignarMaestro'),
)); ?>

        <tr>
            <th id="direccion_th" colspan="4" style="text-align: center">
                ASIGNAR MAESTRO
            </th>
        </tr>
        
        <tr>
            <td class="datos_td" width="240px"></td>
		<td class="datos_td" width="150px" style="text-align: center"><?php echo $form->labelEx($model,'fk_teacher'); ?></td>
                <td width="240px"><?php echo $form->dropDownList($model,'fk_teacher', Teachers::model()->getTeachers(), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_teacher'); ?></td>
                <td width="240px"></td>
        </tr>
        </table>
    <hr>
    <table>
        <tr>
            <td width="240px"><div class="boton" id="irAtras"><< Atr&aacute;s</div></td>
            <td width="240px"></td>
            <td width="240px"></td>
            <div class="row buttons">
            <td><?php echo CHtml::submitButton('Siguiente >>'); ?></td>
        </div>
        </tr>
<?php $this->endWidget(); ?>
</table>
</div><!-- form -->