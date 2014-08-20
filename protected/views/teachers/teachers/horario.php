<?php        
Yii::app()->clientScript->registerScript('helpers', '                                                           
    yii = {                                                                                                     
        urls: {                                                                                                 
            idDayMax: '.CJSON::encode(Yii::app()->createUrl('catalogs/catBssDay/getFinDiaSemana')).', 
            minMaxHr: '.CJSON::encode(Yii::app()->createUrl('catalogs/catBssHours/getMinMaxHour')).',
            horario: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/jsonHorario')).',
            getClassComment: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/getClassComment')).',
            setClassComment: '.CJSON::encode(Yii::app()->createUrl('teachers/teachers/setClassComment')).',
            base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
        }                                                                                                       
    };                                                                                                          
',CClientScript::POS_HEAD);                                                                                                             

Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().
        '/jui/css/base/jquery-ui.css'
);

$this->breadcrumbs = array(
    'Cursos'=>array('cursos'),
    'Horario'
);

$this->menu = array(
    array('label' => 'Cursos', 'url' => array('cursos')),
);
?>
<link rel='stylesheet' type='text/css' href='css/calendar/reset.css' />
<!--<link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css' />-->
<link rel='stylesheet' type='text/css' href='css/calendar/jquery.weekcalendar.css' />
<link rel='stylesheet' type='text/css' href='css/calendar/horario.css' />

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js'></script>
<script type='text/javascript' src='js/calendar/jquery.weekcalendar.js'></script>
<script type='text/javascript' src='js/calendar/horario.js'></script>
<div id='calendar'></div>
<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>
<div id="event_edit_container">
    <form>
        <input type="hidden" />
        <table>
            <tr>
                <td style="font-weight: bold">Fecha:</td>
                <td><span class="date_holder"></span> </td>
            </tr>
            <tr>
                <td style="font-weight: bold">Hora Inicio:</td>
                <td><span class="start"></span></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Hora Fin:</td>
                <td><span class="end"></span></td>
            </tr>
            <tr>
                <td style="font-weight: bold" colspan="2">Notas:</td>
            </tr>
            <tr>
                <td colspan="2"><textarea name="body" maxlength="250" rows="4"></textarea></td>
            </tr>
        </table>
    </form>
</div>
<div id="dialogOpcion">
    <span>Seleccione lo que desea capturar.</span>
</div>
<div id="dialogAsistencia" class="ui-widget">
    <input type="hidden" id="pkAsistencia">
    <input type="hidden" id="fechaClase">
    <table class="ui-widget ui-widget-content">
        <tr class="ui-widget-header ">
          <th colspan="4" style="text-align:center">Asistencia Clase</th>
        </tr>
      <tr>
        <td>Estatus</td>
        <td><?php echo CHtml::dropDownList('estatusClase', '', CatStatusClass::model()->getCatStatusClassListData(isset($_SESSION['asistencia']['pkTipoCurso']) ? $_SESSION['asistencia']['pkTipoCurso'] : 0), 
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    ); ?></td>
        <td>Detalle Nivel</td>
        <td><?php echo CHtml::dropDownList('detalleNivel', '', CatLevelDetail::model()->getCatLevelDetailsListData(isset($_SESSION['asistencia']['pkNivel']) ? $_SESSION['asistencia']['pkNivel'] : 0), 
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    ); ?></td>
      </tr>
      <tr id="trRecalendarizar">
         <td>fecha</td>
        <td><?php
                  $this->widget('zii.widgets.jui.CJuiDatePicker',
                          array('attribute'=>'initial_date',
                                'name'=>'fechaRecalendarizar',
                                'options' => array(
                                      'mode'=>'focus',
                                      'dateFormat'=> constantes::FORMATO_FECHA,
                                      'showAnim' => 'slideDown',
                                      'minDate'=>0,
                                ),
                                'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                ),
                          )); 
              ?></td>
        <td>Hora</td>
        <td><?php  $this->widget('CMaskedTextField', array(
                              'name'=>'horaRecalendarizar',
                              'value' => '00:00',
                              'mask' => '99:99',
                              'htmlOptions' => array('size' => 5)
                              )
                          ); ?></td>
      </tr>
      <tr id="trCancelacionLbl">
          <td colspan="4">Raz&oacute;n cancelaci&oacute;n</td>
      </tr>
      <tr id="trCancelacionTxt">
          <td colspan="4"><?php echo CHtml::textArea('razonCancelacion','',array('rows'=>2,'maxlength'=>100, 'style' => 'resize: none; width : 100%')); ?></td>
      </tr>
    </table>
    
    <table class="ui-widget ui-widget-content" id="tablaAlumnos">
        <tr class="ui-widget-header ">
          <th colspan="4" style="text-align:center">Asistencia Alumnos</th>
        </tr>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
