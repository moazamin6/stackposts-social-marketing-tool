"use strict";
function Core(){
    var self = this;
    this.init = function(){
        self.actionItem();
        self.actionMultiItem();
        self.actionForm();
        self.setTimezone();
        self.Payment();
    };

    this.Payment = function(){
        $(document).on("change", ".plan_by", function(){
            if($(this).is(":checked")){
                $(".by_monthly").addClass("d-none");
                $(".by_annually").removeClass("d-none");
            }else{
                $(".by_monthly").removeClass("d-none");
                $(".by_annually").addClass("d-none");
            }
        });
    };

    this.setTimezone = function(){
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://api.ip.sb/geoip",
            "dataType": "jsonp",
            "method": "GET",
            "headers": {
                "Access-Control-Allow-Origin": "*"
            }
        }
        
        $.ajax(settings).done(function (response) {
            var timezone = response.timezone;
            $.post(PATH+"timezone", {csrf:csrf, timezone:timezone}, function(){}, 'json');
            $(".auto-select-timezone").val(timezone);
        });
    };

    this.actionItem= function(){
        $(document).on('click', ".actionItem", function(event) {
            event.preventDefault();    
            var that           = $(this);
            var action         = that.attr("href");
            var id             = that.data("id");
            var data           = $.param({csrf:csrf, id: id});

            self.ajax_post(that, action, data, null);
            return false;
        });
    };

    this.actionMultiItem= function(){
        $(document).on('click', ".actionMultiItem", function(event) {
            event.preventDefault();    
            var that           = $(this);
            var form           = that.closest("form");
            var action         = that.attr("href");
            var params         = that.data("params");
            var data           = form.serialize();
            var data           = data + '&' + $.param({csrf:csrf}) + "&" + params;
            self.ajax_post(that, action, data, null);
            return false;
        });
    };

    this.actionForm= function(){
        $(document).on('submit', ".actionForm", function(event) {
            event.preventDefault();    
            var that           = $(this);
            var action         = that.attr("action");
            var data           = that.serialize();
            var data           = data + '&' + $.param({csrf:csrf});
            
            self.ajax_post(that, action, data, null);
        });
    };

    this.ajax_post = function(that, action, data, _function){
        var confirm        = that.data("confirm");
        var transfer       = that.data("transfer");
        var type_message   = that.data("type-message");
        var rediect        = that.data("redirect");
        var content        = that.data("content");
        var append_content = that.data("append-content");
        var callback       = that.data("callback");
        var history_url    = that.data("history");
        var hide_overplay  = that.data("hide-overplay");
        var call_after     = that.data("call-after");
        var remove         = that.data("remove");
        var type           = that.data("result");
        var object         = false;

        if(type == undefined){
            type = 'json';
        }

        if(confirm != undefined){
            if(!window.confirm(confirm)) return false;
        }

        if(history_url != undefined){
            history.pushState(null, '', history_url);
        }

        if(!that.hasClass("disabled")){
            if(hide_overplay == undefined || hide_overplay == 1){
                self.overplay();
            }
            that.addClass("disabled");
            $.post(action, data, function(result){
                
                //Check is object
                if(typeof result != 'object'){
                    try {
                        result = $.parseJSON(result);
                        object = true;
                    } catch (e) {
                        object = false;
                    }
                }else{
                    object = true;
                }

                //Run function
                if(_function != null){
                    _function.apply(this, [result]);
                }

                //Callback function
                if(result.callback != undefined){
                    $("body").append(result.callback);
                }

                //Callback
                if(callback != undefined){
                    var fn = window[callback];
                    if (typeof fn === "function") fn(result);
                }

                //Using for update
                if(transfer != undefined){
                    that.removeClass("tag-success tag-danger").addClass(result.tag).text(result.text);
                }

                //Add content
                if(content != undefined && object == false){
                    if(append_content != undefined){
                        $("."+content).append(result);
                    }else{
                        $("."+content).html(result);
                    }
                }

                //Call After
                if(call_after != undefined){
                    eval(call_after);
                }

                //Remove Element
                if(remove != undefined){
                    that.parents('.'+remove).remove();
                }

                //Hide Loading
                self.overplay(true);
                that.removeClass("disabled");

                //Redirect
                self.redirect(rediect, result.status);

                //Message
                if(result.status != undefined){
                    if(result.status == "error"){
                        $(".show-message").removeClass("text-danger text-success").addClass("text-danger").html(result.message);
                    }else{
                        $(".show-message").removeClass("text-danger text-success").addClass("text-success").html(result.message);
                    }
                }

            }, type).fail(function() {
                that.removeClass("disabled");
            });
        }

        return false;
    };

    this.callbacks = function(_function){
        $("body").append(_function);
    };

    this.redirect = function(_rediect, _status){
        if(_rediect != undefined && _status == "success"){
            setTimeout(function(){
                window.location.assign(_rediect);
            }, 1500);
        }
    };

    this.overplay = function(status){
        if(status == undefined){
            $(".loading").show();
            if($(".modal").hasClass("in")){
                $(".loading").addClass("top");
            }else{
                $(".loading").removeClass("top");
            }
        }else{
            $(".loading").hide();
        }
    };

    this.notify = function(_message, _type){
        if(_message != undefined && _message != ""){
            switch(_type){
                case "success":
                    var backgroundColor = "#04c8c8";
                    break;

                case "error":
                    var backgroundColor = "#f1416c";
                    break;

                default:
                    var backgroundColor = "#ffc700";
                    break;
            }

            iziToast.show({
                theme: 'dark',
                icon: 'fad fa-bells',
                title: '',
                position: 'bottomCenter',
                message: _message,
                backgroundColor: backgroundColor,
                progressBarColor: 'rgb(255, 255, 255, 0.5)',
            });
        }
    };
}

var Core = new Core();
$(function(){
    Core.init();
});