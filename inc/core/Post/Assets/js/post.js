"use strict";
function Post(){
    var self = this;
    var timeout;
    var preview_tmp = {};

    this.init = function(){
        self.preview();

        $(document).on("click", ".post-main .post-type label", function(e){
            var that = $(this);
            if(!that.find("input").is(":checked")){
                var id = that.find("input").val();
                File_manager.unselectAllFiles();
                $(".post-type-box").addClass("d-none");
                $(".post-type-box input").val("");
                switch(id){
                    case "link":
                        $(".post-type-box[data-type='link']").removeClass("d-none");
                        $(".post-type-box[data-type='media']").removeClass("d-none");
                        break;

                    case "media":
                        $(".post-type-box[data-type='media']").removeClass("d-none");
                        break;

                    default:
                         $(".post-type-box[data-type='text']").removeClass("d-none");
                        break;
                }
                
                that.addClass("bg-primary text-light-primary");
                that.siblings().removeClass("bg-primary text-light-primary");
            }
        });

        $(document).on("click", ".preview-menu .item a", function(){
            var that = $(this);
            var id = that.attr("href");
            $(".preview-menu .item a").removeClass("active");
            that.addClass("active");
            $('.post-preview-wrap').animate({
                scrollTop: $(id).offset().top
            }, 0);

            return false;
        });

        $(".post-preview-wrap").scroll(function() {
            var scrollDistance = $(".post-preview-wrap").scrollTop();
            var outTop = $(".post-preview-wrap").position().top;
            $('.post-preview-wrap .post-preview').each(function(i) {
                var position = $(this).position().top - outTop;
                if (position <= scrollDistance ) {
                    $('.preview-menu .item a').removeClass('active').blur();
                    $('.preview-menu .item a').eq(i).addClass('active');
                }
            });
        }).scroll();

        $(document).on("change", ".post-main select[name='post_by']", function(){
            var that = $(this);
            var type = $(this).val();
            $(".post-main .post-by").addClass("d-none");
            $(".post-main .post-by[data-by='"+type+"']").removeClass("d-none").show();

            if(type == 1){
                $(".btnPostNow").removeClass("d-none");
                $(".btnSchedulePost").addClass("d-none");
                $(".btnSaveDraft").addClass("d-none");
            }else if(type == 4){
                $(".btnPostNow").addClass("d-none");
                $(".btnSchedulePost").addClass("d-none");
                $(".btnSaveDraft").removeClass("d-none");
            }else{
                $(".btnPostNow").addClass("d-none");
                $(".btnSchedulePost").removeClass("d-none");
                $(".btnSaveDraft").addClass("d-none");
            }
        });

        $(document).on("click", ".post-main .addSpecificDays", function(){
            var that = $(this);
            var item = $(".tempPostByDays").find(".item"); 
            var c = item.clone();
            c.find("input").attr("name", "time_posts[]").addClass("datetime").val("");
            $(".listPostByDays").append(c);
            Core.calendar();

            if( $(".post-main .listPostByDays .remove").length > 1 ){
                $(".post-main .listPostByDays .remove").removeClass("disabled");
            }

            return false;
        });

        $(document).on("click", ".post-main .listPostByDays .remove:not(.disabled)", function(){
            var that = $(this);
            that.parents(".item").remove();

            if( $(".post-main .listPostByDays .remove").length < 2 ){
                $(".post-main .listPostByDays .remove").addClass("disabled");
            }
        });

        //Mobile
        $(document).on("click", ".post-main .btn-preview", function(){
            $(".post-main .post-tab").addClass("d-sm-none d-xs-none d-none");
            $(".post-main .preview-tab").removeClass("d-sm-none d-xs-none d-none");
        });

        $(document).on("click", ".post-main .btn-close-preview, .post-main .btn-close-filemanager", function(){
            $(".post-main .post-tab").addClass("d-sm-none d-xs-none d-none");
            $(".post-main .post-content-tab").removeClass("d-sm-none d-xs-none d-none");
        });

        $(document).on("click", ".post-main .btn-open-filemanager", function(){
            $(".post-main .post-tab").addClass("d-sm-none d-xs-none d-none");
            $(".post-main .filemanager-tab").removeClass("d-sm-none d-xs-none d-none");
        });
    },

    this.openAdvanceOptions = function(){
        var networks = [];
        $(".am-selected-list .am-selected-item").each(function(){
            var that = $(this);
            var network = that.attr("data-network");
            if(!networks.includes(network)){
                networks.push( network );
            }
        });

        $(".advance-options").find(".nav .nav-item").each(function(){
            var that = $(this);
            var network = that.attr("data-network");
            if( !networks.includes(network) ){
                that.addClass("d-none");
                that.find("a").removeClass("active");
            }else{
                that.removeClass("d-none");
                that.find("a").addClass("active");
                that.siblings().find("a").removeClass("active");
            }
        });

        $(".advance-options").find(".tab-content .tab-pane").each(function(){
            var that = $(this);
            var network = that.attr("data-network");
            if( !networks.includes(network) ){
                that.addClass("d-none").removeClass("active show");
            }else{
                that.removeClass("d-none").addClass("active show");
                that.siblings().removeClass("active show");
            }
        });

        if( $(".advance-options .nav .nav-item a.active").length == 0 ){
            $(".advance-options").addClass("d-none");
        }else{
            $(".advance-options").removeClass("d-none");
        } 
    }

    this.preview = function(){
        $(document).on('DOMNodeInserted DOMNodeRemoved', '.fm-selected-media .items', function(event) {
            $(".fm-selected-media .items .fm-list-item").each(function(name, value){
                var that = $(this);
                var is_image = that.data("is-image");
                var file = that.data("file");
                if(is_image){
                    $(".post-main").find(".piv-img").html('<img class="pv-img w-100" src="'+file+'">');
                    $(".piv-link-img").html('<img class="pv-img w-100" src="'+file+'">');
                }else{}
            });
        });

        $(document).on("change", ".post-schedule input[name='link']", function(e){
            var url = $(this).val();
            clearTimeout(timeout);
            timeout = setTimeout(function(){
                e.preventDefault();
                $.post( PATH + "post/url_info", { url: url }, function(result){
                    if(result.data.image != ""){
                        File_manager.saveFile(result.data.image);
                        $(".piv-link-img").html('<img class="pv-img w-100 h-100" src="'+result.data.image+'">');
                    }
                    $(".piv-web").html(result.data.host);
                    $(".piv-title").html(result.data.title);
                    $(".piv-desc").html(result.data.description);
                }, 'json');
            }, 500);
            return false;   
        });

        $(document).on("click", ".post-main .post-type label", function(e){
            var that = $(this);
            if(!that.find("input").is(":checked")){
                var id = that.find("input").val();
                switch(id){
                    case "link":
                        $(".piv-img").addClass("d-none");
                        $(".piv-link").removeClass("d-none");
                        break;

                    case "media":
                        $(".piv-img").removeClass("d-none");
                        $(".piv-link").addClass("d-none");
                        break;

                    default:
                        $(".piv-img").addClass("d-none");
                        $(".piv-link").addClass("d-none");
                        break;
                }

                $(".pv-body").each(function(){
                    var type = $(this).data("support-type");
                    if(type != undefined){
                        type = type.split(",");
                        if(type.indexOf(id) == -1){
                            $(this).find(".preview-item").addClass("d-none");
                            $(this).find(".piv-not-support").removeClass("d-none");
                        }else{
                            $(this).find(".preview-item").removeClass("d-none");
                            $(this).find(".piv-not-support").addClass("d-none");
                        }
                    }
                });
                
                that.addClass("bg-primary text-light-primary");
                that.siblings().removeClass("bg-primary text-light-primary");
            }
        });

        $(document).on("keyup", ".advance-options input", function(){
            var name = $(this).attr("name");
            var value = $(this).val();
            name = name.replace("advance_options[", "");
            name = name.replace("]", "");

            if( preview_tmp[name] == undefined ){
                preview_tmp[name] = $("."+name).html();
            }

            if(value == ""){
                console.log(preview_tmp[name]);
                $("."+name).html(preview_tmp[name]);
            }else{
                $("."+name).html(value);
            }
        })

        $(document).on("change", ".advance-options input", function(){
            var name = $(this).attr("name");
            var value = $(this).val();
            name = name.replace("advance_options[", "");
            name = name.replace("]", "");

            console.log(value);

            if( preview_tmp[name] != undefined ){
                preview_tmp[name] = $("."+name).html();
            }

            console.log(name);

            if(value == ""){
                $("."+name).html(preview_tmp[name]);
            }else{
                $("."+name).html(value);
            }
        })



        /*if($("[name='caption']").length > 0){
            $("[name='caption']").data("emojioneArea").on("keyup", function(editor) {
                console.log(editor);
                var data = editor.html();
                var caption = editor.parents(".wrap-input-emoji").find('textarea').val();
                var caption = $("[name='caption']")[0].emojioneArea.getText();
                console.log(caption);
                editor.parents(".wrap-input-emoji").find('.count-word span').html( caption.length );
                if(data != ""){
                    $(".piv-text").html(caption);
                }else{
                    $(".piv-text").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

            $("[name='caption']").data("emojioneArea").on("emojibtn.click", function(editor) {
                var data = editor.html();

                var caption = $(this)[0].emojioneArea.getText();

                var caption = editor.parents(".wrap-input-emoji").find('textarea').val();
                editor.parents(".wrap-input-emoji").find('.count-word span').html( caption.length );
                if(data != ""){
                    $(".piv-text").html(caption);
                }else{
                    $(".piv-text").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

        }*/
    },

    this.edit = function(post){
        var data = $.parseJSON(post.data);
        var advanceOptions = data.advance_options;

        $('[name="caption"]').val(data.caption);
        $('input#am_'+post.account_id).prop('checked',true).trigger("change");
        Account_manager.CheckAndSelect(  $('input#am_'+post.account_id).parents(".am-choice-item") );
        File_manager.loadSelectedFiles(data.medias);

        if(post.status == 0){
             $(".post-main select[name='post_by']").val(4);
                $(".post-main .post-by").addClass("d-none");
        }else{
            $(".post-main select[name='post_by']").val(2);
            $(".post-main .post-by").addClass("d-none");
            $(".post-main .post-by[data-by='2']").removeClass("d-none").show();
        }
        self.openAdvanceOptions();

        $.each( advanceOptions, function( key, value ) {
            $("[type='radio'][name='advance_options["+key+"]'][value='" + value + "']").prop('checked',true);
            $("[type='checkbox'][name='advance_options["+key+"]'][value='" + value + "']").prop('checked',true);
            $("textarea[name='advance_options["+key+"]']").val( value );
            $("input[type='text'][name='advance_options["+key+"]']").val( value );
            $("input[type='number'][name='advance_options["+key+"]']").val( value );
            $("select[name='advance_options["+key+"]']").val( value ).change();
        });
    },

    this.confirm = function(result){
        switch(result.status) {
            case "warning":
                $('.data-post-confirm').html(result.errors);
                $('.post-modal').modal('show');
                break;
        }
    },

    this.closeConfirmPostModal = function(){
        $('#post-modal').modal('hide');
    },

    this.countChar = function(str){
        return Array.from(str.split(/[\ufe00-\ufe0f]/).join("")).length;
    }
}

var Post = new Post();
$(function(){
    Post.init();
});