<?php
/* @var $this ClientsController */
/* @var $model Clients */
/* @var $form CActiveForm */
$idClienteWebLabel = "client_web";
$idClienteWebInput = "Clients_client_web";
$idNombreClienteLabel = "client_name";
$idExtension = "Clients_contact_phone_ext";
$idCelular = "Clients_contact_cellphone";
$idExtensionLabel = "contact_phone_ext";
$idCelularLabel = "contact_cellphone";
$classDatosFacutarion = "facturar";
$idFacturarCombo = "Clients_billing_data";
?>

<?php
    Yii::app()->clientScript->registerScript('script',
        'if(parseInt($("#'.$idFacturarCombo.'").val()) !== '.constantes::SI.'){
            $(".'.$classDatosFacutarion.'").hide();
        }
        $("#user_th").click(function() {
            if($(".user").is(":visible")){
                $(".user").hide();
            }else{
                $(".user").show();
            }
        });
        
        $("#datos_cliente_th").click(function() {
            if($(".datos_cliente_td").is(":visible")){
                $(".datos_cliente_td").hide();
            }else{
                $(".datos_cliente_td").show();
            }
        });
        
        $("#contacto_th").click(function() {
            if($(".contacto_td").is(":visible")){
                $(".contacto_td").hide();
            }else{
                $(".contacto_td").show();
            }
        });
        
        $("#dir_clase_th").click(function() {
            if($(".dir_clase_td").is(":visible")){
                $(".dir_clase_td").hide();
            }else{
                $(".dir_clase_td").show();
            }
        });
        
        $("#fiscales_th").click(function() {
            if($(".fiscales_td").is(":visible")){
                $(".fiscales_td").hide();
            }else{
                $(".fiscales_td").show();
            }
        });
        ',
        CClientScript::POS_READY);
?>

<script>
    
    function tipoCliente(value){
        if(parseInt(value) === <?php echo constantes::CLIENTE_EMPRESA;?>){
            $("#<?php echo $idClienteWebInput; ?>").show();
            $("#<?php echo $idClienteWebLabel; ?>").show();
            $('#<?php echo $idNombreClienteLabel ?>').html('Nombre de la Empresa <span class="required">*</span>');
        }else if(parseInt(value) === <?php echo constantes::CLIENTE_PARTICULAR;?>){
            $("#<?php echo $idClienteWebInput; ?>").hide();
            $("#<?php echo $idClienteWebLabel; ?>").hide();
            $('#<?php echo $idNombreClienteLabel ?>').html('Nombre del Cliente <span class="required">*</span>');
        }
    }
    
    function datosFiscales(value){
        if(parseInt(value) === <?php echo constantes::SI ?>){
            $(".<?php echo $classDatosFacutarion ?>").show();
        }else if(parseInt(value) === <?php echo constantes::NO ?>){
            $(".<?php echo $classDatosFacutarion ?>").hide();
        }
    }
</script>



<div class="form">
    <table class="zebra">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clients-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
        <?php
        if($model->pk_client == null){
        ?>
        <tr>
            <th id="user_th" colspan="4" class="zebra_th"><div style="text-align: center">DATOS DE USUARIO</div></th>
        </tr>
        <tr>
            <div class="row">
                <td class="user"><?php echo $form->labelEx($modelUser,'username'); ?></td>
		<td class="user"><?php echo $form->textField($modelUser,'username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelUser,'username'); ?></td>
	</div>

	<div class="row">
            <td class="user"><?php echo $form->labelEx($modelUser,'password'); ?></td>
		<td class="user"><?php echo $form->passwordField($modelUser,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelUser,'password'); ?></td>
	</div>
        </tr>
        <?php
        }
        ?>
        <tr>
            <th id="datos_cliente_th" colspan="4" style="text-align: center">DATOS DEL CLIENTE</th>
        </tr>
        <tr>
	<div class="row">
            <td class="datos_cliente_td"><?php echo $form->labelEx($model,'fk_type_client'); ?></td>
            <td class="datos_cliente_td" width="270px"><?php echo $form->dropDownList($model,'fk_type_client',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::TIPO_CLIENTE,  constantes::LANG), 
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        'onChange' => 'tipoCliente(this.value)')
                    ); ?>
		<?php echo $form->error($model,'fk_type_client'); ?></td>
	</div>

	<div class="row">
            <td class="datos_cliente_td"><?php echo $form->labelEx($model,'client_name', array('id'=>$idNombreClienteLabel)); ?></td>
		<td class="datos_cliente_td"><?php echo $form->textField($model,'client_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'client_name'); ?></td>
	</div>
        </tr>
        
        <tr>
            <th id="contacto_th" colspan="4" style="text-align: center">CONTACTO ADMINISTRATIVO</th>
        </tr>
       <tr>
	<div class="row">
            <td class="contacto_td"><?php echo $form->labelEx($model,'contact_name'); ?></td>
		<td class="contacto_td"><?php echo $form->textField($model,'contact_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_name'); ?></td>
	</div>

	<div class="row">
            <td class="contacto_td"><?php echo $form->labelEx($model,'contact_mail'); ?></td>
		<td class="contacto_td"><?php echo $form->textField($model,'contact_mail',array('size'=>60,'maxlength'=>100, 'type'=>'email')); ?>
		<?php echo $form->error($model,'contact_mail'); ?></td>
	</div>
        </tr>
        
        <tr>
	<div class="row">
            <td class="contacto_td"><?php echo $form->labelEx($model,'contact_phone'); ?></td>
		<td class="contacto_td"><?php echo $form->textField($model,'contact_phone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'contact_phone'); ?></td>
	</div>

	<div class="row">
            <td class="contacto_td"><?php echo $form->labelEx($model,'contact_phone_ext', array('id'=>$idExtensionLabel)); ?></td>
		<td class="contacto_td"><?php echo $form->textField($model,'contact_phone_ext',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'contact_phone_ext'); ?></td>
	</div>
        </tr>
        
        <tr>
	<div class="row">
            <td class="contacto_td"><?php echo $form->labelEx($model,'billing_data'); ?></td>
            <td class="contacto_td"><?php echo $form->dropDownList($model,'billing_data', constantes::getOpcionSiNo(),
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        'onChange' => 'datosFiscales(this.value)')
                    ); ?>
		<?php echo $form->error($model,'billing_data'); ?></td>
	</div>

	<div class="row">
            <td class="contacto_td"><?php echo $form->labelEx($model,'contact_cellphone', array('id'=>$idCelularLabel)); ?></td>
		<td class="contacto_td"><?php echo $form->textField($model,'contact_cellphone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'contact_cellphone'); ?></td>
	</div>
        </tr>
        
        <tr>
	<div class="row">
            
            <td class="contacto_td"><?php echo $form->labelEx($model,'client_web', array('id'=>$idClienteWebLabel)); ?></td>
		<td class="contacto_td"><?php echo $form->textField($model,'client_web',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'client_web'); ?></td>
	</div>

	<div class="row">
            <td class="contacto_td"><?php //echo $form->labelEx($model,'status'); ?></td>
            <td class="contacto_td"><?php echo $form->hiddenField($model,'status', constantes::getOpcionStatus(),
                    array('options' => array(constantes::$opcion_status[1]=>array('selected'=>true)))
                    ); ?>
		<?php echo $form->error($model,'status'); ?></td>
	</div>
        </tr>
        <tr>
            <th id="dir_clase_th" colspan="4" style="text-align: center">DIRECCION PARA LA CLASE</th>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'street'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTECA,'street'); ?></td>
            </div>

            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'street_number'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'street_number'); ?>
		<?php echo $form->error($modelTECA,'street_number'); ?></td>
            </div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'street_number_int'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'street_number_int',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($modelTECA,'street_number_int'); ?></td>
            </div>

            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'neighborhood'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'neighborhood',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTECA,'neighborhood'); ?></td>
            </div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'county'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'county',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTECA,'county'); ?></td>
	</div>

	<div class="row">
            <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'fk_state_dir'); ?></td>
		<td class="dir_clase_td"><?php echo $form->dropDownList($modelTECA,'fk_state_dir', CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ESTADO,  constantes::LANG), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($modelTECA,'fk_state_dir'); ?></td>
	</div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'country'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTECA,'country'); ?></td>
            </div>

            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'zipcode'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'zipcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($modelTECA,'zipcode'); ?></td>
            </div>
        </tr>
        <tr>
            <div class="row">
                <td class="dir_clase_td"><?php echo $form->labelEx($modelTECA,'phone'); ?></td>
		<td class="dir_clase_td"><?php echo $form->textField($modelTECA,'phone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($modelTECA,'phone'); ?></td>
            </div>
            <div class="row">
                <td class="dir_clase_td"><?php //echo $form->labelEx($modelTECA,'status'); ?></td>
		<td class="dir_clase_td"><?php echo $form->hiddenField($modelTECA,'status', constantes::getOpcionStatus(),
                    array('options' => array(constantes::$opcion_status[1]=>array('selected'=>true)))
                    ); ?>
		<?php echo $form->error($modelTECA,'status'); ?></td>
            </div>
        </tr>
        
        <tr class="<?php echo $classDatosFacutarion; ?>">
            <th id="fiscales_th" colspan="4" style="text-align: center">DATOS FISCALES</th>
        </tr>
        
        <tr class="<?php echo $classDatosFacutarion; ?>">
                <div class="row">
                    <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'bussiness_name'); ?></td>
                    <td class="fiscales_td"><?php echo $form->textField($modelTEBD,'bussiness_name',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($modelTEBD,'bussiness_name'); ?></td>
                </div>
            
                <div class="row">
                    <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'street'); ?></td>
                    <td class="fiscales_td"><?php echo $form->textField($modelTEBD,'street',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($modelTEBD,'street'); ?></td>
                </div>
         </tr>
         
         <tr class="<?php echo $classDatosFacutarion; ?>">
             <div class="row">
                 <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'street_number'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'street_number'); ?>
		<?php echo $form->error($modelTEBD,'street_number'); ?></td>
            </div>

            <div class="row">
                <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'street_number_int'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'street_number_int',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($modelTEBD,'street_number_int'); ?></td>
            </div>
         </tr>
         
         <tr class="<?php echo $classDatosFacutarion; ?>">
             <div class="row">
                <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'neighborhood'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'neighborhood',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTEBD,'neighborhood'); ?></td>
            </div>
         
             <div class="row">
                 <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'county'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'county',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTEBD,'county'); ?></td>
            </div>
         
         </tr>
         
         <tr class="<?php echo $classDatosFacutarion; ?>">
             <div class="row">
                 <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'state'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTEBD,'state'); ?></td>
            </div>

            <div class="row">
                <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'country'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($modelTEBD,'country'); ?></td>
            </div>
         </tr>
        
         <tr class="<?php echo $classDatosFacutarion; ?>">
             <div class="row">
                 <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'zipcode'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'zipcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($modelTEBD,'zipcode'); ?></td>
            </div>

            <div class="row">
            <td class="fiscales_td"><?php echo $form->labelEx($modelTEBD,'rfc'); ?></td>
		<td class="fiscales_td"><?php echo $form->textField($modelTEBD,'rfc',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($modelTEBD,'rfc'); ?></td>
            </div>
         </tr>
    </table>
     
    <table class="zebra">
        <tr>
	<div class="row buttons">
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
	</div>
        </tr>
    </table>
<?php $this->endWidget(); ?> 
</div><!-- form -->
    