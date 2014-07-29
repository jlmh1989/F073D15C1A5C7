<?php

$this->breadcrumbs = array(
    'Cursos' => array('teachers/teachers/cursos'),
    'Curso[' . $_SESSION['asistencia']['descCurso'] . ']',
    'Asistencia'
);
$this->menu = array(
    array('label' => 'Cursos', 'url' => Yii::app()->createUrl("teachers/teachers/cursos")),
);

Yii::app()->clientScript->registerScript('script',
        '
            $("#fechaFin").text("26 Feb 2014 ");
            $("#fechaInicio").text(" 24 Feb 2014");
        '
        ,CClientScript::POS_READY);
?>
<script>
    function atrasFecha(){
        alert("Atras");
    }
    
    function siguienteFecha(){
        alert("Siguiente");
    }
</script>
<table class="calendarioMes">
    <thead id="CalendarHead">
        <tr>
            <td style="text-align: left; "><span style="cursor: pointer" onclick="atrasFecha()">< ANTERIOR</span></td>
            <td style="text-align: center; font-weight: bold">AGOSTO 2014</td>
            <td style="text-align: right;"><span style=" cursor: pointer" onclick="siguienteFecha()">SIGUIENTE ></span></td>
        </tr>
    </thead>
</table>
<table class="MonthlyCalendar">
    <thead class="CalendarHead">
        <tr>
            <th class="DateHeader first">LUN</th>
            <th class="DateHeader">MAR</th>
            <th class="DateHeader">MI&Eacute;</th>
            <th class="DateHeader">JUE</th>
            <th class="DateHeader">VIE</th>
            <th class="DateHeader">S&Aacute;B</th>
            <th class="DateHeader last">DOM</th>
        </tr>
    </thead>
    <tbody class="CalendarBody">
        <?php
        for ($i = 0; $i < 5; $i++){
        ?>
        <tr class="WeekRow">
            <td>
                <div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal" style="cursor: pointer;">
                        <span class="EventText">Cancelada fuera de tiempo</span>
                    </div>
                </div>
            </td>
            <td>
                <div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal">
                        <span class="EventText"></span>
                    </div>
                </div>
            </td>
            <td><div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal">
                        <span class="EventText"></span>
                    </div>
                </div></td>
            <td><div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal">
                        <span class="EventText"></span>
                    </div>
                </div></td>
            <td><div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal">
                        <span class="EventText"></span>
                    </div>
                </div></td>
            <td><div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal">
                        <span class="EventText"></span>
                    </div>
                </div></td>
            <td><div style="position:relative;height:90px;background: #EFEFEF;border-radius: 10px;">
                    <div class="DateLabel">4 AGO 2014</div>
                    <div class="Event normal">
                        <span class="EventText"></span>
                    </div>
                </div></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php
$timestamp;
$dw = date( "w");
echo $dw;
?>
