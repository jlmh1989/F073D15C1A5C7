$(document).ready(function() {
   var $calendar = $('#calendar');
   
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
                       return calEvent.readOnly != true;
                    },
                    resizable : function(calEvent, $event) {
                       return calEvent.readOnly != true;
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
                       var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
                       var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
                       var titleField = $dialogContent.find("input[name='title']").val(calEvent.title);
                       var bodyField = $dialogContent.find("textarea[name='body']");
                       bodyField.val(calEvent.body);

                       $dialogContent.dialog({
                          modal: true,
                          title: "Editar - " + calEvent.title,
                          close: function() {
                             $dialogContent.dialog("destroy");
                             $dialogContent.hide();
                             $('#calendar').weekCalendar("removeUnsavedEvents");
                          },
                          buttons: {
                             guardar : function() {

                                calEvent.start = new Date(startField.val());
                                calEvent.end = new Date(endField.val());
                                calEvent.title = titleField.val();
                                calEvent.body = bodyField.val();

                                $calendar.weekCalendar("updateEvent", calEvent);
                                $dialogContent.dialog("close");
                             },
                             cancelar : function() {
                                $dialogContent.dialog("close");
                             }
                          }
                       }).show();

                       var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
                       var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
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
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
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