$(document).ready(function() {
   var $calendar = $('#calendar');
   var notificacion=new jsNotifications({
        autoCloseTime : 4,
        showAlerts: true,
        title: "Portal English e24"
    });
    
    $.ajax({
        type: "POST",
        url: yii.urls.idDayMax,
        dataType: "text",
        success: function(idMaxDay) {
            $.getJSON(yii.urls.minMaxHr, function (json){
                $calendar.weekCalendar({
                    timeslotsPerHour : 4,
                    allowCalEventOverlap : true,
                    overlapEventsSeparate: true,
                    firstDayOfWeek : 1,
                    businessHours :{start: json.minHr, end: json.maxHr, limitDisplay: true },
                    daysToShow : idMaxDay,
                    height : function($calendar) {
                       return $(window).height() - $("h1").outerHeight() - 1;
                    },
                    eventRender : function(calEvent, $event) {
                       if (calEvent.end.getTime() < new Date().getTime()) {
                          $event.css("backgroundColor", "#aaa");
                          $event.find(".wc-time").css({
                             "backgroundColor" : "#999",
                             "border" : "1px solid #888"
                          });
                       }
                    },
                    draggable : function(calEvent, $event) {
                       return calEvent.readOnly !== true;
                    },
                    resizable : function(calEvent, $event) {
                       return calEvent.readOnly !== true;
                    },
                    eventNew : function(calEvent, $event) {
                    },
                    eventDrop : function(calEvent, $event) {
                    },
                    eventResize : function(calEvent, $event) {
                    },
                    eventClick : function(calEvent, $event) {

                       if (calEvent.readOnly) {
                          return;
                       }
                       
                       var $dialogContent = $("#event_edit_container");
                        resetForm($dialogContent);
                        $dialogContent.find("input[name='title']").val(calEvent.title);
                        var bodyField = $dialogContent.find("textarea[name='body']");

                        var dateI = new Date(calEvent.start);
                        var dateF = new Date(calEvent.end);
                        var exist;
                        var pkClassComment;

                        var fecha = dateI.getFullYear()+"-"+(dateI.getMonth()+1)+"-"+dateI.getDate();
                        var horaInicio = dateI.getHours()+":"+dateI.getMinutes()+":00";
                        var horaFin = dateF.getHours()+":"+dateF.getMinutes()+":00";

                        $.ajax({
                         type: "POST",
                         async:false,    
                         cache:false,
                         url: yii.urls.getClassComment,
                         dataType: "json",
                         data: { pkCurso: calEvent.pk_curso, 
                                 fecha : fecha,
                                 horaInicio : horaInicio,
                                 HoraFin : horaFin},
                         success: function(data) {
                             exist = data.exist;
                             pkClassComment = data.pkClassComment;
                             calEvent.body = data.comment;
                         }}); 


                        bodyField.val(calEvent.body);
                        
                        /* Establecer valores para captura de asistencia */
                        $.ajax({
                            type: "POST",
                            async:false,    
                            cache:false,
                            url: yii.urls.setDatosAsistencia,
                            data: { pkMaestro:calEvent.pk_maestro , 
                                    pkCurso:calEvent.pk_curso, 
                                    descCurso:calEvent.desc_curso, 
                                    pkCliente:calEvent.pk_cliente, 
                                    pkTipoCurso:calEvent.pk_tipoCurso, 
                                    pkNivel:calEvent.pk_nivel,
                                    fechaCurso: calEvent.start.getFullYear()+"-"+(calEvent.start.getMonth()+1)+"-"+calEvent.start.getDate()},
                            success: function(data) {
                                
                            },
                            error: function(data) {
                                notificacion.show('error','Error al establecer valores para capturar asistencia.');
                            }
                        });
                        
                        /* Validar asistencia al inicio */
                        
                        
                        $.ajax({
                            type: "POST",
                            async:false,
                            cache:false,
                            url: yii.urls.getListaEstatus,
                            dataType: "json",
                            success: function(data){
                                var html = '<option value="">Seleccione una opción</option>';
                                $.each(data, function(id, item){
                                   html += '<option value="'+item.id+'">'+item.valor+'</option>'; 
                                });
                                $("#estatusClase").html(html);
                            },
                            error : function(data){
                                notificacion.show('error','Error al cargar catalogo estatus de la clase.');
                            }
                        });
                        
                        $.ajax({
                            type: "POST",
                            async:false,
                            cache:false,
                            url: yii.urls.getListaDetalleNivel,
                            dataType: "json",
                            success: function(data){
                                var html = '<option value="">Seleccione una opción</option>';
                                $.each(data, function(id, item){
                                   html += '<option value="'+item.id+'">'+item.valor+'</option>'; 
                                });
                                $("#detalleNivel").html(html);
                            },
                            error : function(data){
                                notificacion.show('error','Error al cargar detalle nivel de la clase.');
                            }
                        });
                        
                        $.ajax({
                            type: "POST",
                            async:false,
                            cache:false,
                            url: yii.urls.getEstatusAsistencia,
                            dataType: "json",
                            success: function(data){
                                if(data.estatus){
                                    validaAsistenciaInicio(0,calEvent.start.getFullYear()+"-"+(calEvent.start.getMonth()+1)+"-"+calEvent.start.getDate(), data.pk_assistance, data.fk_status_class, data.reschedule_date, data.reschedule_time, data.cancellation_reason, data.fk_level_detail);
                                }else{
                                    validaAsistenciaInicio(1,calEvent.start.getFullYear()+"-"+(calEvent.start.getMonth()+1)+"-"+calEvent.start.getDate(),0,0,0,0,0,0);
                                }
                            },
                            error : function(data){
                                notificacion.show('error','Error al leer estatus de la clase.');
                            }
                        });
                        
                        var $dialogCaptura =  $("#dialogCaptura");
                        $dialogCaptura.dialog({
                            modal: true,
                            width: 800,
                            title: "Captura Información Clase",
                            close: function() {
                                $dialogCaptura.dialog("destroy");
                                $dialogCaptura.hide();
                            },
                            buttons: {
                               "Guardar" : function() {
                                   var $tabs = $('#dialogCaptura').tabs();
                                   var selected = $tabs.tabs('option', 'selected');
                                   if(selected == 0){ // 0 => Nota 
                                        calEvent.body = bodyField.val();
                                        $.ajax({
                                            type: "POST",
                                            async:false,    
                                            cache:false,
                                            url: yii.urls.setClassComment,
                                            dataType: "text",
                                            data: { pkCurso: calEvent.pk_curso, 
                                                    fecha : fecha,
                                                    horaInicio : horaInicio,
                                                    HoraFin : horaFin,
                                                    comment: calEvent.body,
                                                    exist: exist,
                                                    pkClassComment: pkClassComment},
                                            success: function(data) {
                                                notificacion.show('ok','Nota guardado correctamente.');
                                                $calendar.weekCalendar("updateEvent", calEvent);
                                                $dialogCaptura.dialog("close");
                                            },
                                            error: function (data){
                                                notificacion.show('error','Error al guardar la nota.');
                                            }}); 
                                   }else if(selected == 1){ // 1 => Asistencia
                                       if(guardarAssistencia()){
                                           $dialogCaptura.dialog("close");
                                       }
                                   }
                               },
                               "Cancelar" : function(){
                                   $dialogCaptura.dialog("close");
                               }
                            }
                       });
                       $(".ui-dialog-titlebar").hide();
                       
                        var startField = $dialogContent.find(".start");
                        var endField = $dialogContent.find(".end");
                        $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
                        setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
                        $(window).resize().resize();
                    },
                    eventMouseover : function(calEvent, $event) {
                    },
                    eventMouseout : function(calEvent, $event) {
                    },
                    noEvents : function() {

                    },
                    data : function(start, end, callback) {
                       callback(getEventData());
                    }
                 });
            });
        }
    });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }

   function getEventData() {
      var eventos = {events: []};
      $.ajax({
        type: "POST",
        async:false,    
        cache:false,
        url: yii.urls.horario,
        dataType: "json",
        success: function(data) {
            var dataTam = data.length;
            for(var i = 0; i < dataTam; i++){
                var event = data[i];
                eventos["events"].push({
                    "id":i + 1,
                    "pk_curso":event.pk_curso,
                    "pk_maestro":event.pk_maestro,
                    "pk_cliente":event.pk_cliente,
                    "pk_tipoCurso":event.pk_tipoCurso,
                    "pk_nivel":event.pk_nivel,
                    "des_curso":event.desc_curso,
                    "start": new Date(event.anio, event.mes - 1, event.dia, event.hora_inicio, event.minuto_inicio),
                    "end": new Date(event.anio, event.mes - 1, event.dia, event.hora_fin, event.minuto_fin),
                    "title":event.desc_curso
                });
            }
        }}); 
       return eventos;
   }

   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         if (startTime.getTime() === calEvent.start.getTime()) {
            $startTimeField.text(timeslotTimes[i].startFormatted);
         }
         
         if (endTime.getTime() === calEvent.end.getTime()) {
            $endTimeField.text(timeslotTimes[i].endFormatted);
         }
      }
      $endTimeOptions = $endTimeField.find("option");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");

   $("select[name='start']").change(function() {
      var startTime = $(this).find(":selected").val();
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $(this).val();
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });
});