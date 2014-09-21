<?php
/* @var $this CoursesController */
/* @var $model LoanMaterial */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('script',
        '
        $("#irAtras").click(function(){
            $(location).attr("href","'.Yii::app()->createUrl('courses/courses/asignarMaestro').'");
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
        'action' => Yii::app()->createUrl('courses/courses/asignarMaterial'),
)); ?>
        
        <tr>
            <th id="material_th" colspan="4" style="text-align: center; ">
                ASIGNAR MATERIAL
            </th>
        </tr>
        
        <tr>
            <td><?php echo $form->labelEx($model, 'fk_material_detail'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_material_detail', CatMaterialDetail::model()->getListMaterialDetail((isset($_SESSION['curso']['datos']['fk_level'])) ? $_SESSION['curso']['datos']['fk_level'] : '', $model->fk_material_detail), 
                        array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    );?>
            <?php echo $form->error($model,'fk_material_detail'); ?></td>
            <td><?php echo $form->labelEx($model, 'pick_date'); ?></td>
            <td><?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array('attribute'=>'pick_date',
                                  'name'=>'pick_date',
                                  'model'=>$model,
                                  'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=> constantes::FORMATO_FECHA,
                                        'showAnim' => 'slideDown',
                                        'minDate'=>0,
                                  ),
                                  'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                  ),
                            )); 
                ?>
		<?php echo $form->error($model,'pick_date'); ?></td>
        </tr>
        <tr>
            <td><?php //echo CHtml::label('Comentario Material','',array('id'=>'comentario')); ?></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $form->labelEx($model, 'comment'); ?></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $form->textArea($model, 'comment', array('rows'=>3, 'maxlength' => 300, 'style' => 'resize: none; width : 100%')); ?>
        <?php echo $form->error($model, 'comment'); ?></td>
        </tr>
        </table>
    <table>
        <tr>
            <td width="240px"><div class="boton" id="irAtras"><< Atr&aacute;s</div></td>
            <td width="240px"><?php echo $form->hiddenField($model,'fk_teacher');
                                    echo $form->hiddenField($model,'pk_loan_material');?></td>
            <td width="240px"></td>
            <div class="row buttons">
            <td><?php echo CHtml::submitButton('Siguiente >>'); ?></td>
        </div>
        </tr>

<?php $this->endWidget(); ?>
</table>
</div><!-- form -->
        
