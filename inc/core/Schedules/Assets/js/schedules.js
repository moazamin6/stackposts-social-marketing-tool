"use strict";
function Schedules(){
    var self= this;
    var SCHEDULE_SIDEBAR = $(".sub-sidebar");
    var SCHEDULE_MAIN = $(".schedules-main");
    var SCHEDULE_LIST = $(".schedule-list");
    var SCHEDULE_CALENDAR = $("#schedule-calendar");

    this.init= function(){
        self.action();
    };

    this.action = function(){

        if( SCHEDULE_MAIN.length > 0 ){
            var type = SCHEDULE_SIDEBAR.find('[name="schedule_type"]:checked').val();
            var category = SCHEDULE_SIDEBAR.find("input[name='schedule_of']:checked").val();
            var time = SCHEDULE_SIDEBAR.find('[name="schedule_time"]').val();
            var d =new Date(time);

            SCHEDULE_CALENDAR.monthly({
                mode: 'event',
                dataType: 'json',
                jsonUrl: PATH+'schedules/get/'+type+'/'+category,
                eventList: false,
                setDate: d.getTime()/1000
            });
            
            SCHEDULE_MAIN.find(".monthly-day[data-time='"+time+"']").addClass("active");

            SCHEDULE_MAIN.on("click", ".monthly-day", function(){
                var that = SCHEDULE_CALENDAR;
                var time = $(this).data('time');
                var type = SCHEDULE_SIDEBAR.find('[name="schedule_type"]:checked').val();
                var category = SCHEDULE_SIDEBAR.find("input[name='schedule_of']:checked").val();
                var params = { token: csrf };
                var action = PATH + "schedules/index/" + type + "/" + category + "/" + time;

                SCHEDULE_MAIN.find(".monthly-day").removeClass("active");
                $(this).addClass("active");
                Core.ajax_post( that, action, params, function(result){
                    $(".schedules-main").addClass("active");
                    SCHEDULE_LIST.html(result);
                    Core.overplay("hide");
                    history.pushState(null, '', action);
                    SCHEDULE_SIDEBAR.find('[name="schedule_time"]').val(time);
                    Layout.carousel();
                });
            });

            SCHEDULE_MAIN.on("click", ".open-schedule-calendar", function(){
                $(".schedules-main").removeClass("active");
            });

           SCHEDULE_SIDEBAR.find(".schedule-type").on("click", function(){
                var time = SCHEDULE_SIDEBAR.find('[name="schedule_time"]').val();
                var url = $(this).attr("href") + "/" + time;
                location.assign( url );
                return false;
            });

            SCHEDULE_SIDEBAR.find("input[name='schedule_of']").on("change", function(){
                var type = SCHEDULE_SIDEBAR.find('[name="schedule_type"]:checked').val();
                var time = SCHEDULE_SIDEBAR.find('[name="schedule_time"]').val();
                var category = $(this).val();
                var url = PATH + "schedules/index/" + type + "/" + category + "/" + time;
                location.assign( url );
                Core.overplay();
            });
        }
    }
}

var Schedules = new Schedules();
$(function(){
    Schedules.init();
});