<?php                                                                                                                                                                                                                                                                                                                                                                
Yii::app()->clientScript->registerScript('helpers', '                                                           
    yii = {                                                                                                     
        urls: {                                                                                                 
            idDayMax: '.CJSON::encode(Yii::app()->createUrl('catalogs/catBssDay/getFinDiaSemana')).', 
            minMaxHr: '.CJSON::encode(Yii::app()->createUrl('catalogs/catBssHours/getMinMaxHour')).',
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
<link rel='stylesheet' type='text/css' href='css/calendar/reset.css' />
<link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css' />
<link rel='stylesheet' type='text/css' href='css/calendar/jquery.weekcalendar.css' />
<link rel='stylesheet' type='text/css' href='css/calendar/horario.css' />

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js'></script>
<script type='text/javascript' src='js/calendar/jquery.weekcalendar.js'></script>
<script type='text/javascript' src='js/calendar/horario.js'></script>
<div id='calendar'></div>
<div id="event_edit_container">
    <form>
        <input type="hidden" />
        <ul>
            <li>
                <span>Fecha: </span><span class="date_holder"></span> 
            </li>
            <li>
                <label for="start">Hora Inicio: </label><select name="start" disabled=""><option value="">Seleccione Hora Inicio</option></select>
            </li>
            <li>
                <label for="end">Hora Fin: </label><select name="end" disabled=""><option value="">Seleccione Hora Fin</option></select>
            </li>
            <li>
                <label for="title">Titulo: </label><input type="text" name="title" readonly="readonly"/>
            </li>
            <li>
                <label for="body">Notas: </label><textarea name="body"></textarea>
            </li>
        </ul>
    </form>
</div>
