<?php  
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile($baseUrl.'/css/calendar/themes/base/ui.all.css');
$cs->registerCssFile($baseUrl.'/css/calendar/reset.css');
$cs->registerCssFile($baseUrl.'/css/calendar/jquery.weekcalendar.css');
$cs->registerCssFile($baseUrl.'/css/calendar/horario.css');
$cs->registerCssFile($baseUrl.'/js/jsNotifications/ext/jboesch-Gritter/css/jquery.gritter.css');

$cs->registerScriptFile($baseUrl.'/js/jsHorario/jquery.min.js'); //1.3.2
$cs->registerScriptFile($baseUrl.'/js/jsHorario/jquery-ui.min.js'); //1.7.2
$cs->registerScriptFile($baseUrl.'/js/jsHorario/ui.core.js'); //1.7.2
$cs->registerScriptFile($baseUrl.'/js/jsHorario/ui.tabs.js'); //1.7.2
$cs->registerScriptFile($baseUrl.'/js/calendar/jquery.weekcalendar.js');
$cs->registerScriptFile($baseUrl.'/js/calendar/horario.js');
$cs->registerScriptFile($baseUrl.'/js/jsNotifications/ext/jboesch-Gritter/js/jquery.gritter.min.js');
$cs->registerScriptFile($baseUrl.'/js/jsNotifications/jsNotifications.js');

Yii::app()->clientScript->registerScript('helpers', '                                                           
    yii = {                                                                                                     
        urls: {                                                                                                 
            idDayMax: '.CJSON::encode(Yii::app()->createUrl('catalogs/catBssDay/getFinDiaSemana')).', 
            minMaxHr: '.CJSON::encode(Yii::app()->createUrl('catalogs/catBssHours/getMinMaxHour')).',
            horario: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/jsonHorario')).',
            getClassComment: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/getClassComment')).',
            setClassComment: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/setClassComment')).',
            setDatosAsistencia: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/setDatosAsistencia')).',
            asistencia: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/asistencia')).',
            getEstatusAsistencia: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/getEstatusAsistencia')).',
            getListaEstatus: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/getListaEstatus')).',
            getListaDetalleNivel: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/getListaDetalleNivel')).',
            getHtmlEstudiantes: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/getHtmlEstudiantesCurso')).',
            base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
        }                                                                                                       
    };                                                                                                          
    ',CClientScript::POS_HEAD);

$this->breadcrumbs = array(
    'Cursos'=>array('cursos'),
    'Horario'
);

$this->menu = array(
    array('label' => 'Cursos', 'url' => array('cursos')),
);
?>
<script>
    var notificacion=new jsNotifications({
        autoCloseTime : 4,
        showAlerts: true,
        title: "Portal English e24"
    });
    /*  Script ejecucion inicio carga pagina */
    $(function() {
        validarInicio();
        
        $("#dialogCaptura").tabs({ selected: 0 });
        
        $("#fechaRecalendarizar").change(function(){
            validarFecha();
        });
        
        $("#horaRecalendarizar").change(function(){
            validarHora();
        });
    });
    
    function validarInicio(){
        $("#trRecalendarizar").hide();
        $("#trCancelacionLbl").hide();
        $("#trCancelacionTxt").hide();
        
        $("#estatusClase").change(function() {
            if(validarRecalendarizarEstatus(this.value)){
                $("#trRecalendarizar").show();
            }else{
                $("#trRecalendarizar").hide();
            }
            if(validarCancelacionEstatus(this.value)){
                $("#trCancelacionLbl").show();
                $("#trCancelacionTxt").show();
            }else{
                $("#trCancelacionLbl").hide();
                $("#trCancelacionTxt").hide();
            }
        });
    }
    
    function validarFecha(){
        var fkStatusClase = parseInt($("#estatusClase").val());
        if(validarRecalendarizarEstatus(fkStatusClase)){
            var fechaVal = $("#fechaRecalendarizar").val();
            if(!isDate(fechaVal)){
                $("#fechaRecalendarizar").focus();
                notificacion.show('error','La fecha no es válida.');
                return false;
            }

            if(Date.parse($("#fechaRecalendarizar").val()) < Date.parse(new Date())){
                notificacion.show('error','La fecha no puede ser menor que la fecha actual.');
                return false;
            }
        }
        return true;
    }
    
    function validarHora(){
        var fkStatusClase = parseInt($("#estatusClase").val());
        if(validarRecalendarizarEstatus(fkStatusClase)){
            var horaVal = $("#horaRecalendarizar").val();
            if(!isHour(horaVal)){
                $("#horaRecalendarizar").focus();
                notificacion.show('error','La hora no es válida.');
                return false;
            }
        }
        return true;
    }
    
    function isHour(txtHour){
        var currVal = txtHour;
        if(currVal == '' || currVal == '00:00')
          return false;
      
        var RegExPattern = /^(0[1-9]|1\d|2[0-3]):([0-5]\d)$/;
        if ((currVal.match(RegExPattern))) {
            return true;
        } else {
            return false;
        } 
    }
    
    function isDate(txtDate)
    {
        var currVal = txtDate;
        if(currVal == '')
          return false;

        var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/; 
        var dtArray = currVal.match(rxDatePattern);

        if (dtArray == null)
           return false;

        dtDay= dtArray[8];
        dtMonth = dtArray[5];
        dtYear = dtArray[1];

        if (dtMonth < 1 || dtMonth > 12)
            return false;
        else if (dtDay < 1 || dtDay> 31)
            return false;
        else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
            return false;
        else if (dtMonth == 2)
        {
           var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
           if (dtDay> 29 || (dtDay ==29 && !isleap))
                return false;
        }
        return true;
    }
    
    function validaAsistenciaInicio(esNuevo, fechaClase, pkAsistencia, fkStatusClase, fechaRecandelarizado, horaRecalendarizado, razonCancelacion, fkNivelDetalle){
        $("#trRecalendarizar").hide();
        $("#trCancelacionLbl").hide();
        $("#trCancelacionTxt").hide();
        $("#pkAsistencia").val("");
        $("#fechaClase").val(fechaClase);
        
        if(esNuevo === 1){
            $("#estatusClase").val(0);
            $("#detalleNivel").val(0);
            $("#razonCancelacion").val("");
            $("#fechaRecalendarizar").val("");
            $("#horaRecalendarizar").val("");
        }else{
            $("#estatusClase").val(fkStatusClase);
            $("#detalleNivel").val(fkNivelDetalle);
            $("#razonCancelacion").val(razonCancelacion);
            $("#fechaRecalendarizar").val(fechaRecandelarizado);
            $("#horaRecalendarizar").val(horaRecalendarizado);
            $("#pkAsistencia").val(pkAsistencia);
            if(validarCancelacionEstatus(fkStatusClase)){
                $("#trCancelacionLbl").show();
                $("#trCancelacionTxt").show();
            }

            if(validarRecalendarizarEstatus(fkStatusClase)){
                $("#trRecalendarizar").show();
            }
        }
    }
    
    function validarTipoEstatus(value){
        if(validarCancelacionEstatus(value)){
            $("#listaEstudiantes").hide();
        }else{
            $("#listaEstudiantes").show();
        }
    }
    
    function validarCancelacionEstatus(value){
        if((value == <?=  constantes::CLASE_CANCELADA_GRP ?>) || 
           (value == <?=  constantes::CLASE_CANCELADA_IND ?>) ||
           (value == <?=  constantes::CLASE_CANCELADA_A_TIEMPO_IDN ?>) || 
           (value == <?=  constantes::CLASE_CANCELADA_F_TIEMPO_IDN ?>) ||
           (value == <?=  constantes::CLASE_CANCELADA_A_TIEMPO_GRP ?>) || 
           (value == <?=  constantes::CLASE_CANCELADA_A_TIEMPO_GRP ?>) ||
           (value == <?=  constantes::CLASE_RECALENDARIZADO_GRP ?>) ||
           (value == <?=  constantes::CLASE_RECALENDARIZADO_IND ?>)){
            return true;
        }
        return false;
    }
    
    function validarRecalendarizarEstatus(value){
       if((value == <?= constantes::CLASE_RECALENDARIZADO_GRP ?>) || 
          (value == <?= constantes::CLASE_RECALENDARIZADO_IND ?>)){
            return true;
        }
        return false;
    }
    
    function guardarAssistencia(){
        var fkStatusClase = parseInt($("#estatusClase").val());
        if($("#estatusClase").val() === ""){
            notificacion.show('error','Seleccionar estatus de la clase.');
            return false;
        }
        if(validarCancelacionEstatus(fkStatusClase)){
            if($("#razonCancelacion").val().trim().length <= 0){
                notificacion.show('error','Capturar razón de cancelación.');
                return false;
            }
        }else if(validarRecalendarizarEstatus(fkStatusClase)){
            if(!validarFecha()){
                return false;
            }
            if(!validarHora()){
                return false;
            }
        }

        var esNuevo = 0;
        if($("#pkAsistencia").val() === ""){
            esNuevo = 1;
        }
        var exito = false;
        var asisAlumno = [];
        var validaAsisAlumno = true;
        if(!validarCancelacionEstatus(fkStatusClase) && !(validarRecalendarizarEstatus(fkStatusClase))){
            $("#listaEstudiantes tbody tr").each(function(index, element){
                var elemento = $(this).find('select');
                elemento = elemento[0];
                var statusClase = elemento.options[elemento.selectedIndex].value;
                var pkAlumno = elemento.id;
                if(statusClase == ""){
                    notificacion.show('error','Seleccione asistencia para alumno.');
                    validaAsisAlumno = false;
                    return false;
                }
                asisAlumno.push({pkEstudiante: pkAlumno, pkEstatus: statusClase});
            });
        }
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('teachers/teachers/guardarAsistenciaClase'); ?>", 
            dataType: "text",
            async:false,    
            cache:false,
            data: { esNuevo: esNuevo, 
                    nivelClase: 1,
                    pkAsistencia : $("#pkAsistencia").val(), 
                    fechaClase : $("#fechaClase").val(),
                    fkStatusClase : fkStatusClase,
                    fechaRecalendar : $("#fechaRecalendarizar").val(),
                    horaRecalendar : $("#horaRecalendarizar").val(),
                    razonCancelacion : $("#razonCancelacion").val(),
                    fkLevelDetalle : $("#detalleNivel").val()
                },
            success: function(data) {
                if(!validarCancelacionEstatus(fkStatusClase) && !(validarRecalendarizarEstatus(fkStatusClase))){
                    if(validaAsisAlumno){
                        for(i = 0; i < asisAlumno.length; i++){
                            $.ajax({
                                type: "POST",
                                url: "<?= Yii::app()->createUrl('teachers/teachers/guardarAsistenciaClase'); ?>", 
                                dataType: "text",
                                async:false,    
                                cache:false,
                                data: { esNuevo: 1, 
                                        nivelClase: 0,
                                        pkAsistencia : 0, 
                                        fechaClase : $("#fechaClase").val(),
                                        fkStatusClase : asisAlumno[i].pkEstatus,
                                        fkEstudiante: asisAlumno[i].pkEstudiante,
                                        fechaRecalendar : $("#fechaRecalendarizar").val(),
                                        horaRecalendar : $("#horaRecalendarizar").val(),
                                        razonCancelacion : $("#razonCancelacion").val(),
                                        fkLevelDetalle : $("#detalleNivel").val()
                                    },
                                success: function(data) {
                                    },
                                error: function(data){
                                    notificacion.show('error','Error al guardar asistencia de alumnos.');
                                    return false;
                                }
                            });
                        }
                    }
                }
                notificacion.show('ok','Asistencia guardado correctamente.');
                exito = true;
            },
            error: function(data){
                notificacion.show('error','Error al guardar asistencia.');
            }
        });
        
        return exito;
    }
</script>

<div id='calendar'></div>
<div id="dialogCaptura">
    <ul>
        <li><a href="#event_edit_container">Capturar Nota</a></li>
        <li><a href="#asistencia">Capturar Asistencia</a></li>
    </ul>
    <div id="event_edit_container">
        <form>
            <input type="hidden" />
            <table>
                <tr>
                    <td style="font-weight: bold">Fecha:</td>
                    <td><span class="date_holder"></span> </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">Hora Inicio:</td>
                    <td><span class="start"></span></td>
                    <td style="font-weight: bold">Hora Fin:</td>
                    <td><span class="end"></span></td>
                </tr>
                <tr>
                    <td style="font-weight: bold" colspan="4">Notas:</td>
                </tr>
                <tr>
                    <td colspan="4"><textarea name="body" maxlength="250" rows="2" style="width: 100%; resize: none"></textarea></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="asistencia">
        <input type="hidden" id="pkAsistencia">
        <input type="hidden" id="fechaClase">
        <table class="zebra">
            <tr>
                <th colspan="4" style="text-align:center"  class="zebra_th"><b>Asistencia por Clase</b></th>
            </tr>
            <tr class="odd_">
                <td style="font-size: smaller"><b>Estatus</b></td>
                <td style="padding-left: 5px;"><select tabindex="0" name="estatusClase" id="estatusClase" onchange="validarTipoEstatus(this.value)"></select></td>
                <td style="padding-left: 25px;font-size: smaller"><b>Detalle Nivel</b></td>
                <td style="padding-left: 5px"><select tabindex="0" name="detalleNivel" id="detalleNivel"></select></td>
            </tr>
            <tr id="trRecalendarizar" class="even_">
             <td>Fecha</td>
             <td style="padding-left: 5px"><input type="text" id="fechaRecalendarizar" maxlength="10" placeholder="yyyy-mm-dd"/></td>
             <td style="padding-left: 25px;font-size: smaller"><b>Hora</b></td>
            <td style="padding-left: 5px"><input type="text" id="horaRecalendarizar" maxlength="5" placeholder="hh:mm"/></td>
          </tr>
          <tr id="trCancelacionLbl" class="even_">
              <td colspan="4" style="font-size: smaller"><b>Raz&oacute;n cancelaci&oacute;n</b></td>
          </tr>
          <tr id="trCancelacionTxt" class="even_">
              <td colspan="4"><?php echo CHtml::textArea('razonCancelacion','',array('rows'=>2,'maxlength'=>100, 'style' => 'resize: none; width : 100%')); ?></td>
          </tr>
        </table>
        <br>
        <div id="listaEstudiantes">
            <table id="tablaAlumnos" class="zebra">
                <thead>
                <tr>
                    <th colspan="4" style="text-align:center" class="zebra_th"><b>Asistencia por Alumno</b></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>