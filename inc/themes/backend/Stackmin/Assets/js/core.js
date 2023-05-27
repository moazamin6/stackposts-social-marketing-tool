"use strict";
function Core(){
    var self = this;
    var timeout;

    this.init = function(){
        self.action();
        self.select2();
        self.actionItem();
        self.actionMultiItem();
        self.actionForm();
        self.call_load_scroll();
        self.ajax_load_scroll();
        self.emoji();
        self.calendar();
        self.datarange();
        self.ckeditor();
        self.input_color();
        self.code_editor();
        
    };

    this.action = function(){
        /*Check all*/
        $(document).on("change", ".checkbox-all", function(){
            var that = $(this);
            if($('input:checkbox').hasClass("checkbox-item")){
                if(!that.hasClass("checked")){
                    $('input.checkbox-item:checkbox').prop('checked',true);
                    that.addClass('checked');
                }else{
                    $('input.checkbox-item:checkbox').prop('checked',false);
                    that.removeClass('checked');        
                }
            }
            return false;
        });

        $(document).on("click", ".remove-item", function(){
            var that = $(this);
            var parent = $(this).data("remove");
            that.parents("."+parent).remove();
        });

        /*Check all*/
        $(document).on("change", ".checkbox-box-all", function(){
            var that = $(this);
            if(that.parents(".checkbox-wrap-all").find("input:checkbox").hasClass("checkbox-item")){
                if(!that.hasClass("checked")){
                    that.parents(".checkbox-wrap-all").find("input.checkbox-item:checkbox").prop('checked',true);
                    that.addClass('checked');
                }else{
                    that.parents(".checkbox-wrap-all").find("input.checkbox-item:checkbox").prop('checked',false);
                    that.removeClass('checked');        
                }
            }
            return false;
        });

        $(document).on("change", ".auto-submit", function(){
            $(this).parents().filter("form").submit();
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
        var popup          = that.data("popup");
        var confirm        = that.data("confirm");
        var transfer       = that.data("transfer");
        var type_message   = that.data("type-message");
        var rediect        = that.data("redirect");
        var content        = that.data("content");
        var append_content = that.data("append-content");
        var callback       = that.data("callback");
        var history_url    = that.data("history");
        var loading        = that.data("loading");
        var call_after     = that.data("call-after");
        var call_success   = that.data("call-success");
        var remove         = that.data("remove");
        var type           = that.data("result");
        var activeClass    = that.data("active");
        var object         = false;

        if(type == undefined && popup == undefined ){
            type = 'json';
        }

        if(confirm != undefined){
            if(!window.confirm(confirm)) return false;
        }

        if(history_url != undefined){
            history.pushState(null, '', history_url);
        }

        if(!that.hasClass("disabled")){
            if(loading == undefined || loading == 1){
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

                //Call Success
                if(call_success != undefined && result.status == 'success'){
                    eval(call_success);
                }

                //Remove Element
                if(remove != undefined && result.status == 'success'){
                    that.parents('.'+remove).remove();
                }

                if(popup != undefined){
                    $("body").append(result);
                    $('#'+popup).modal('show').on('hidden.bs.modal', function (e) {
                        $(this).remove();
                    });
                }

                if(activeClass != undefined){
                    $(that).siblings().removeClass(activeClass);
                    $(that).addClass(activeClass);
                }

                //Hide Loading
                self.overplay(true);
                that.removeClass("disabled");

                //Redirect
                self.redirect(rediect, result.status);

                //Message
                if(result.status != undefined){
                    switch(type_message){
                        case "text":
                            self.notify(result.message, result.status);
                            break;

                        default:
                            self.notify(result.message, result.status);
                            break;
                    }
                }

                Layout.closeSidebar();

            }, type).fail(function() {
                that.removeClass("disabled");
            });
        }

        return false;
    };

    this.call_load_scroll = function(index){
        if(index == undefined || index == 0){
            var index = "";
        }else{
            var index = "-"+index;
        }

        var that = $('.ajax-load-scroll'+index);
        var scrollDiv = that.attr('data-scroll');

        if ( that.length > 0 )
        {
            $("."+scrollDiv).bind('scroll',function(){

                var _scrollPadding = 80;
                var _scrollTop = $("."+scrollDiv).scrollTop();
                var _divHeight = $("."+scrollDiv).height();
                var _scrollHeight = $("."+scrollDiv).get(0).scrollHeight;

                $(window).trigger('resize'); 
                if( _scrollTop + _divHeight + _scrollPadding >= _scrollHeight) {
                    self.ajax_load_scroll(false, index);
                }

            });
        }
    };

    this.ajax_load_scroll = function( reset_page, index){
        if(index == undefined || index == 0){
            var index = "";
        }else{
            var index = "-"+index;
        }

        var that = $('.ajax-load-scroll'+index);
        var url = that.attr('data-url');
        var filter = $(".ajax-filter"+index);
        var page = parseInt(that.attr('data-page'));
        var loading = that.attr('data-loading');
        var call_after = that.data("call-after");
        var call_success = that.data("call-success");

        if(reset_page){
            page = 0;
            loading = 0;           
        }

        if ( that.length > 0 ){
            if ( loading == undefined || loading == 0 )
            {
                if(page == undefined || Number.isNaN(page)){
                    page = 0;
                    loading = 0;
                    that.attr('data-page', 0);
                    that.attr('data-loading', 0);
                }

                var data = { csrf: csrf, page: page };

                if( filter.length > 0 ){
                    filter.each( function( index, value ) {
                        var name = $(this).attr("name");
                        var value = $(this).val();
                        data[name] = value;
                    } );
                }
             
                $('.ajax-loading').show();
                that.attr('data-loading', 1);

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'html',
                    data: data
                }).done(function(result) {
                    $('.ajax-loading').hide();
                    
                    if ( page == 0 )
                    {
                        that.html( result );
                    }
                    else
                    {
                        that.append( result );
                    }

                    if(result.trim() != ''){
                        that.attr('data-loading', 0);
                    } 
                    
                    //Call After
                    if(call_after != undefined){
                        eval(call_after);
                    }

                    //Call Success
                    if(call_success != undefined && result.status == 'success'){
                        eval(call_success);
                    }

                    that.attr( 'data-page', page + 1);

                    $(".n-scroll").getNiceScroll().resize();
                });
            }
        }
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

    this.click = function(class_name){
        $("."+class_name).trigger('click');
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

    this.tagsinput = function(element){
        if(element != undefined){
            $("."+element).tagsinput();
        }else{
            if($('[data-role="tagsinput"]').length > 0){
                $('[data-role="tagsinput"]').tagsinput();
            }
        }
    };

    this.code_editor = function(){
        if($('.code-editor').length > 0){
            $('.code-editor').ace({ 
                theme: 'monokai',
                lang: 'php',
                name: "unfind",
                bindKey: {
                    win: "Ctrl-F",
                    mac: "Command-F"
                },
                exec: function(editor, line) {
                    return false;
                },
            });
        }
    };

    this.ckeditor = function(element){
        if( element == undefined ){
            element = '.ckeditor';
        }else{
            element = '.'+element;
        }

        if( $(element).length > 0 ){
            tinymce.init({
                selector: element,
                theme: 'silver',
                height : "1000",
                convert_urls:true,
                relative_urls:false,
                remove_script_host:false,
                plugins: 'lists advlist image autolink autoresize code codesample emoticons link media pagebreak preview searchreplace table visualblocks wordcount nonbreaking',
            });
        }
    };

    this.emoji = function(element){
        //Emoji texterea
        if(element == undefined){
            element = "input-emoji";
        }

        if($('.' + element).length > 0){
            $('.' + element).emojioneArea({
                hideSource: true,
                useSprite: false,
                pickerPosition    : "bottom",
                filtersPosition   : "top"
            });

            $('.' + element)[0].emojioneArea.on("keyup", function(editor, event) {
                var text = $('.' + element)[0].emojioneArea.getText();
                var content = editor.html();
                editor.parents(".wrap-input-emoji").find('.count-word span').html( text.length );
                if(text != ""){
                    $(".piv-text").html(content);
                }else{
                    $(".piv-text").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

            $('.' + element)[0].emojioneArea.on("change", function(editor, event) {
                var text = $('.' + element)[0].emojioneArea.getText();
                var content = editor.html();
                editor.parents(".wrap-input-emoji").find('.count-word span').html( text.length );
                if(text != ""){
                    $(".piv-text").html(content);
                }else{
                    $(".piv-text").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

            $('.' + element)[0].emojioneArea.on("emojibtn.click", function(button, event) {
                var text = $('.' + element)[0].emojioneArea.getText();
                var content = $('.' + element).parents(".wrap-input-emoji").find(".emojionearea-editor").html();
                button.parents(".wrap-input-emoji").find('.count-word span').html( text.length );
                if(text != ""){
                    $(".piv-text").html(content);
                }else{
                    $(".piv-text").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

            setTimeout(function(){
                $(".emojionearea-editor").niceScroll({cursorcolor:"#ddd"});
            }, 1000);
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

    this.ajax_pages = function(){
        if( $(".ajax-pages").length > 0 ){
            var that = $(".ajax-pages");
            var url = that.attr('data-url');
            var filter = $(".ajax-filter");
            var loading = that.attr('data-loading');
            var class_result = that.attr('data-response');
            var call_after = that.attr("data-call-after");
            var call_success = that.attr("data-call-success");
            var per_page = that.attr("data-per-page");
            var current_page = that.attr("data-current-page");
            var total_items = that.attr("data-total-items");

            if(current_page == undefined || Number.isNaN(current_page)){
                current_page = 1;
                loading = 0;
                that.attr('data-page', 0);
                that.attr('data-loading', 0);
            }

            var data = { 
                csrf: csrf, 
                current_page: current_page, 
                per_page: per_page, 
                total_items: total_items 
            };

            if( filter.length > 0 ){
                filter.each( function( index, value ) {
                    var name = $(this).attr("name");
                    var value = $(this).val();
                    data[name] = value;
                } );
            }

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: data
            }).done(function(result) {
                $('.ajax-loading').hide();

                $(class_result).html( result.data );

                

                //Call After
                if(call_after != undefined){
                    eval(call_after);
                }

                //Call Success
                if(call_success != undefined && result.status == 'success'){
                    eval(call_success);
                }

                if( $(".paginationjs").length == 0 || total_items != result.total_items ){
                    that.attr("data-total-items", result.total_items );
                    total_items = result.total_items;

                    self.ajax_pages_actions();
                    self.pagination(total_items, per_page, current_page, ".ajax-pages");
                }
            });
        }
    };

    this.ajax_pages_actions = function(){
        $(".ajax-pages-search").keyup(function(e) {
            clearTimeout(timeout);
            timeout = setTimeout(function(){
                e.preventDefault();
                self.ajax_pages();
            }, 500);
            return false;   
        });

        $(".ajax-pages-search").keydown(function(e) {
            if(e.which == 13) {
                return false;
            }   
        });
    };

    this.pagination = function(total_items, per_page, current_page, el_return){
        if( $(".ajax-pagination").length > 0 ){
            $('.ajax-pagination').pagination({
                dataSource: function(done){
                    var result = [];
                    for (var i = 1; i <= total_items; i++) {
                        result.push(i);
                    }
                    done(result);
                },
                pageNumber: current_page,
                pageSize: per_page,
                callback: function(data, pagination) {
                    $(el_return).attr("data-current-page", pagination.pageNumber);
                    self.ajax_pages();
                }
            });
        }
    };

    this.datarange = function(){
        if( $(".daterange").length > 0 && $("[name='daterange']").length == 0){
            $(".daterange").html(`
                <button type="button" id="daterange" class="bg-white px-4 py-2 border">
                    <i class="fad fa-calendar-alt text-success"></i>
                    <span></span> <i class="fa fa-caret-down"></i>
                    <input type="hidden" name="daterange" value="">
                </button>
                <button type="submit" id="btn_daterange" class="d-none"></button>
            `);

            var start = moment().subtract(27, 'days');
            var end = moment();

            function cb(start, end) {
                $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $("[name='daterange']").val(start.format('YYYY-MM-DD')+","+end.format('YYYY-MM-DD'));
                setTimeout(function(){
                    if(!$(".daterange").hasClass("no-submit")){
                        $("#btn_daterange").trigger("click");
                    }
                }, 200);

            }

            $('#daterange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Last 7 days': [moment().subtract(6, 'days'), moment()],
                   'Last 28 days': [moment().subtract(27, 'days'), moment()],
                   'This month': [moment().startOf('month'), moment().endOf('month')],
                   'Last month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            $('#daterange').on('apply.daterangepicker', function(e, picker) {
                e.preventDefault();
                $("[name='daterange']").val(picker.startDate.format('YYYY-MM-DD')+","+picker.endDate.format('YYYY-MM-DD'));
            });
        }
    };

    this.do_upload = function(element){
        if( $("#"+element).length > 0 ){
            
            

            $(document).on( 'change', '#'+element, function(){
                var that           = $(this);
                var url            = $("#"+element).data("action");
                var rediect        = that.data("redirect");
                var callback       = that.data("callback");
                var call_after     = that.data("call-after");
                var call_success   = that.data("call-success");
                var form           = that.parents("form");

                var form_data = new FormData();

                if(form.length > 0){
                    var formData = form.serializeArray();
                    if(formData.length > 0){
                        for (var i = 0; i < formData.length; i++) {
                            form_data.append(formData[i].name, formData[i].value);
                        }
                    }
                }

                var totalfiles = document.getElementById(element).files.length;
                for (var index = 0; index < totalfiles; index++) {
                    form_data.append("files[]", document.getElementById(element).files[index]);
                }

                Core.overplay();
                
                $(this).val('');
                $.ajax({
                    url: url, 
                    type: 'post',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                            }
                        }, false);
                        xhr.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (result) {
                        Core.overplay(true);
                        //Callback function
                        if(result.callback != undefined){
                            $("body").append(result.callback);
                        }

                        //Callback
                        if(callback != undefined){
                            var fn = window[callback];
                            if (typeof fn === "function") fn(result);
                        }

                        //Call Success
                        if(call_success != undefined && result.status == 'success'){
                            eval(call_success);
                        }

                        //Call After
                        if(call_after != undefined){
                            eval(call_after);
                        }

                        //Hide Loading
                        self.overplay(true);
                        that.removeClass("disabled");

                        //Redirect
                        self.redirect(rediect, result.status);

                        //Message
                        self.notify(result.message, result.status);
                    }
                });

                return false;
            } );
        }
    };

    this.calendar = function(){
        if( $('.date').length > 0 || $('.datetime').length > 0 ){
            $('.date').datepicker({
                dateFormat: FORMAT_DATE,
                beforeShow: function(s, a){
                    $('.ui-datepicker-wrap').addClass('active');
                },
                onClose: function(){
                    $('.ui-datepicker-wrap').removeClass('active');
                }
            });

            /*$.datepicker.regional["en"] =
            {
                closeText: Core.l("Done"),
                prevText: Core.l("Prev"),
                nextText: Core.l("Next"),
                currentText: Core.l("Today"),
                monthNames: [ Core.l("January"), Core.l("February"), Core.l("March"), Core.l("April"), Core.l("May"), Core.l("June"), Core.l("July"), Core.l("August"), Core.l("September"), Core.l("October"), Core.l("November"), Core.l("December") ],
                monthNamesShort: [ Core.l("Jan"), Core.l("Feb"), Core.l("Mar"), Core.l("Apr"), Core.l("May"), Core.l("Jun"), Core.l("Jul"), Core.l("Aug"), Core.l("Sep"), Core.l("Oct"), Core.l("Nov"), Core.l("Dec") ],
                dayNames: [ Core.l("Sunday"), Core.l("Monday"), Core.l("Tuesday"), Core.l("Wednesday"), Core.l("Thursday"), Core.l("Friday"), Core.l("Saturday") ],
                dayNamesShort: [ Core.l("Sun"), Core.l("Mon"), Core.l("Tue"), Core.l("Wed"), Core.l("Thu"), Core.l("Fri"), Core.l("Sat") ],
                dayNamesMin: [ Core.l("Su"), Core.l("Mo"), Core.l("Tu"), Core.l("We"), Core.l("Th"), Core.l("Fr"), Core.l("Sa") ],
                weekHeader: Core.l("Wk"),
                dateFormat: Core.l("dd/mm/yy"),
                firstDay: 7,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ""
            };*/

            //$.datepicker.setDefaults($.datepicker.regional["en"]);

            /*$.timepicker.regional['en'] = {
                currentText: Core.l("Now"),
                closeText: Core.l("Done"),
                amNames: ['AM', 'A'],
                pmNames: ['PM', 'P'],
                timeFormat: 'HH:mm',
                timeSuffix: '',
                timeOnlyTitle: Core.l("Choose Time"),
                timeText: Core.l("Time"),
                hourText: Core.l("Hour"),
                minuteText: Core.l("Minute"),
                secondText: Core.l("Second"),
                millisecText: Core.l("Millisecond"),
                microsecText: Core.l("Microsecond"),
                timezoneText: Core.l("Time Zone")
            };*/
            //$.timepicker.setDefaults($.timepicker.regional['en']);

            if( $('.date').val() == "" ){
                $('.date').datepicker('setDate', 'today');
            }

            $('.datetime').datetimepicker({
                controlType: 'select',
                oneLine: true,
                dateFormat: FORMAT_DATETIME[0],
                timeFormat: FORMAT_DATETIME[1],
                beforeShow: function(s, a){
                    $('.ui-datepicker-wrap').addClass('active');
                },
                onClose: function(){
                    $('.ui-datepicker-wrap').removeClass('active');
                }
            });

            $(".datetime").each(function(){
                var that = $(this);
                if( that.val() == "" ){
                    that.datetimepicker( 'setDate', new Date() );
                }
            });

            $('[id^="ui-datepicker-div"]').wrapAll('<div class="ui-datepicker-wrap"></div>'); 
        }
    };

    this.input_color = function(){
        if( $(".input-color").length > 0 ){
            $(".input-color").minicolors({
                theme: 'bootstrap'
            });
        }
    };

    this.select2 = function(){
        if( $('[data-control="select2"]').length > 0 ){
            var hide_search = $('[data-control="select2"][data-hide-search="true"]').length;
            $('[data-control="select2"]').select2({
                theme: "bootstrap5",
                selectionCssClass: ":all:",
                minimumResultsForSearch: hide_search>0?-1:0,
                allowHtml: true,
                width: 'resolve',
                templateSelection: function(icon) {
                    var style = "";
                    if( $(icon.element).data('icon-color') != undefined){
                        style = ' style="color: '+$(icon.element).data('icon-color')+'" ';
                        return $('<span><i class="' + $(icon.element).data('icon') + '" '+style+' ></i> ' + icon.text + '</span>');
                    }

                    if( $(icon.element).data('img') != undefined){
                        return $('<span><img src="' + $(icon.element).data('img') + '" class="w-17"> ' + icon.text + '</span>');
                    }

                    return $('<span>' + icon.text + '</span>');
                },
                templateResult: function(icon) {
                    var style = "";
                    if( $(icon.element).data('icon-color') != undefined){
                        style = ' style="color: '+$(icon.element).data('icon-color')+'" ';
                        return $('<span><i class="' + $(icon.element).data('icon') + '" '+style+' ></i> ' + icon.text + '</span>');
                    }

                    if( $(icon.element).data('img') != undefined){
                        return $('<span><img src="' + $(icon.element).data('img') + '" class="w-17"> ' + icon.text + '</span>');
                    }

                    return $('<span>' + icon.text + '</span>');
                }
            });
        }
    };

    this.setCookie = function(cname, cvalue, minute) {
        if(minute == undefined) minute = 1440;
        var d = new Date();
        var expries = Math.round(d.getTime()/1000) + minute * 60;
        localStorage.setItem(cname, '{"value":"'+cvalue+'","expires":'+expries+'}');
    };

    this.getCookie = function(cname) {
        let cookie = localStorage.getItem(cname);
        if(cookie){
            var d = new Date();
            var now = Math.round(d.getTime()/1000);
            cookie = $.parseJSON( cookie );
            if(cookie.expires < now){
                localStorage.removeItem(cname);
                return false;
            }else{
                return true;
            }
        }
        return false;
    };

    this.l = function(text){
        var lang = LANGUAGE;
        if(lang){
            try {
              var lang = $.parseJSON( lang );
            }catch(err) {
              var lang = $.parseJSON( JSON.stringify(lang) );
            }
            
            var key = $.md5(text);
            if( lang[key] != undefined ){
                return lang[key];
            }
        }
        return text;
    };

    this.chart = function(options){
        Highcharts.chart(options.id, {
            chart: {
                type: 'area'
            },
            accessibility: {
                description: ''
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            legend: {
                enabled: options.legend?true:false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                allowDecimals: false,
                categories: options.categories,
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                },
                gridLineColor: 'rgba(239, 242, 245, 0.5)',
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, .9)',
                borderColor: 'rgba(0, 0, 0, .9)',
                borderRadius: 12,
                style: {
                    color: 'rgba(255, 255, 255, .8)',
                },
                shared: true,
                crosshairs: true
            },
            plotOptions: {
                area: {
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        color: 'rgba(0, 0, 0, .9)',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                },
            },
            series: options.data
        });
    };

    this.column_chart = function(options){
        Highcharts.chart(options.id, {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            legend: {
                enabled: options.legend?true:false
            },
            xAxis: {
                title: {
                    text: ''
                },
                categories: options.categories,
                allowDecimals: false,
                labels: {
                    formatter: function () {
                        return this.value;
                    }
                },
                accessibility: {
                    rangeDescription: ''
                },
                visible: options.xvisible?true:false,
                lineColor: options.ylineColor?options.ylineColor:'rgba(255, 255, 255, .8)',
            },
            yAxis: {
                title: {
                    text: ''
                },
                gridLineColor: options.gridLineColor?options.gridLineColor:'rgba(239, 242, 245, 0.5)',
                visible: options.yvisible?true:false
            },
            credits: {
                enabled: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, .9)',
                borderColor: 'rgba(0, 0, 0, .9)',
                borderRadius: 12,
                style: {
                    color: 'rgba(255, 255, 255, .8)',
                },
            },
            plotOptions: {
                column: {
                    stacking: options.stacking?options.stacking:false,
                    dataLabels: {
                        enabled: false
                    },
                    pointPadding: 0.05,
                    borderWidth: 0,
                    borderRadius: 5
                },
                series: options.plotSeries!=undefined?options.plotSeries:false
            },
            series: options.data
        });
    }

    this.map_chart = function(options){
        Highcharts.mapChart(options.id, {
            chart: {
                map: "custom/world",
                spacingBottom: 100
            },
            title: {
                text: ""
            },
            legend: {
                enabled: options.legend?true:false
            },
            credits: {
                enabled: false
            },
            colorAxis: {
                minColor: options.minColor?options.minColor:'rgba(214, 219, 254, 1)',
                maxColor: options.maxColor?options.maxColor:'rgba(92, 92, 176, 1)',
                type: 'logarithmic'
            },
            legend: {
                layout: 'horizontal',
                verticalAlign: "bottom",
                align: 'center',
                padding: -40,
                floating: true,
                height: 10,
                backgroundColor: 'rgba(255, 255, 255, 0)'
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, .9)',
                borderColor: 'rgba(0, 0, 0, .9)',
                borderRadius: 12,
                style: {
                    color: 'rgba(255, 255, 255, .8)',
                },
                formatter: function () {
                    return this.point.name + ': <b>' + this.point.value + '</b>';
                }

            },
            plotOptions: {
                map: {
                    allAreas: true,
                    joinBy: ['iso-a2', 'code'],
                }
            },
            series: [{
                name: options.name,
                data: options.data
            }]
        });
    }
}

var Core = new Core();
$(function(){
    Core.init();
});